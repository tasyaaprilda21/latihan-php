<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Todo</title>
    <link href="/assets/vendor/bootstrap-5.3.8-dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 30px 0;
        }
        .btn-back {
            background: white;
            color: #667eea;
            font-weight: 700;
            padding: 14px 30px;
            border-radius: 50px;
            border: none;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            transition: all 0.3s;
        }
        .btn-back:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.3);
            color: #667eea;
        }
        .detail-card {
            background: white;
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            animation: slideUp 0.6s ease;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px;
            border: none;
        }
        .card-header h3 {
            margin: 0;
            color: white;
            font-weight: 800;
            font-size: 2rem;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .info-section {
            padding: 35px 40px;
            border-bottom: 2px solid #f0f4f8;
        }
        .info-section:last-of-type {
            border-bottom: none;
        }
        .info-label {
            font-weight: 700;
            color: #667eea;
            margin-bottom: 15px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .info-value {
            font-size: 1.2rem;
            color: #2d3748;
            line-height: 1.8;
        }
        .todo-title-big {
            font-size: 2rem;
            font-weight: 800;
            color: #2d3748;
            margin: 0;
        }
        .status-badge-big {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 15px 35px;
            border-radius: 50px;
            font-weight: 800;
            font-size: 1.2rem;
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }
        .status-finished {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
        }
        .status-unfinished {
            background: linear-gradient(135deg, #fa8e53 0%, #feb47b 100%);
            color: white;
        }
        .date-box {
            background: linear-gradient(135deg, #f5f7fa 0%, #e8eef5 100%);
            padding: 20px 30px;
            border-radius: 20px;
            display: inline-block;
            font-weight: 600;
            color: #4a5568;
        }
        .date-box i {
            color: #667eea;
            font-size: 1.3rem;
            margin-right: 10px;
        }
        .action-section {
            background: linear-gradient(135deg, #f8f9fc 0%, #ffffff 100%);
            padding: 40px;
        }
        .btn-action-big {
            padding: 16px 40px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            border: none;
            transition: all 0.3s;
        }
        .btn-edit-big {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            color: #2d3748;
            box-shadow: 0 8px 20px rgba(168,237,234,0.4);
        }
        .btn-edit-big:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(168,237,234,0.6);
            color: #2d3748;
        }
        .btn-delete-big {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
            color: white;
            box-shadow: 0 8px 20px rgba(255,107,107,0.4);
        }
        .btn-delete-big:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(255,107,107,0.6);
            color: white;
        }
        .empty-desc {
            color: #a0aec0;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-9 col-xl-8">
                <div class="mb-4">
                    <a href="index.php" class="btn btn-back">
                        <i class="bi bi-arrow-left-circle me-2"></i>Kembali
                    </a>
                </div>

                <div class="card detail-card">
                    <div class="card-header">
                        <h3>
                            <i class="bi bi-file-text-fill"></i>
                            <span>Detail Todo</span>
                        </h3>
                    </div>

                    <div class="card-body p-0">
                        <div class="info-section">
                            <div class="info-label">
                                <i class="bi bi-bookmark-fill"></i>
                                JUDUL TODO
                            </div>
                            <div class="info-value">
                                <h2 class="todo-title-big"><?= htmlspecialchars($todo['title']) ?></h2>
                            </div>
                        </div>

                        <div class="info-section">
                            <div class="info-label">
                                <i class="bi bi-text-left"></i>
                                DESKRIPSI
                            </div>
                            <div class="info-value">
                                <?php if (!empty($todo['description'])): ?>
                                    <?= nl2br(htmlspecialchars($todo['description'])) ?>
                                <?php else: ?>
                                    <span class="empty-desc">
                                        <i class="bi bi-inbox me-2"></i>Tidak ada deskripsi
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="info-section">
                            <div class="info-label">
                                <i class="bi bi-check-circle-fill"></i>
                                STATUS
                            </div>
                            <div class="info-value">
                                <?php if ($todo['is_finished'] == 't' || $todo['is_finished'] == '1'): ?>
                                    <span class="status-badge-big status-finished">
                                        <i class="bi bi-check-circle-fill"></i>
                                        Selesai
                                    </span>
                                <?php else: ?>
                                    <span class="status-badge-big status-unfinished">
                                        <i class="bi bi-clock-fill"></i>
                                        Belum Selesai
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="info-section">
                            <div class="info-label">
                                <i class="bi bi-calendar-plus"></i>
                                TANGGAL DIBUAT
                            </div>
                            <div class="info-value">
                                <div class="date-box">
                                    <i class="bi bi-calendar3"></i>
                                    <?= date('d F Y, H:i:s', strtotime($todo['created_at'])) ?> WIB
                                </div>
                            </div>
                        </div>

                        <div class="info-section">
                            <div class="info-label">
                                <i class="bi bi-arrow-repeat"></i>
                                TERAKHIR DIUPDATE
                            </div>
                            <div class="info-value">
                                <div class="date-box">
                                    <i class="bi bi-clock-history"></i>
                                    <?= date('d F Y, H:i:s', strtotime($todo['updated_at'])) ?> WIB
                                </div>
                            </div>
                        </div>

                        <div class="action-section">
                            <div class="d-flex flex-wrap gap-3 justify-content-center">
                                <button class="btn btn-action-big btn-edit-big" onclick="editTodo()">
                                    <i class="bi bi-pencil-square me-2"></i>Edit Todo
                                </button>
                                <button class="btn btn-action-big btn-delete-big" onclick="deleteTodo()">
                                    <i class="bi bi-trash3 me-2"></i>Hapus Todo
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/vendor/bootstrap-5.3.8-dist/js/bootstrap.min.js"></script>
    <script>
        function editTodo() {
            window.location.href = 'index.php#edit-<?= $todo['id'] ?>';
        }

        function deleteTodo() {
            if (confirm('Yakin ingin menghapus todo "<?= htmlspecialchars(addslashes($todo['title'])) ?>"?')) {
                window.location.href = '?page=delete&id=<?= $todo['id'] ?>';
            }
        }
    </script>
</body>
</html>



