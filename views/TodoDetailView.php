<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📄 Detail Todo - My Todo List</title>
    <link href="/assets/vendor/bootstrap-5.3.8-dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 30px 0;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
        }

        .detail-container {
            position: relative;
            z-index: 1;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-back {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            color: #667eea;
            font-weight: 700;
            padding: 14px 30px;
            border-radius: 50px;
            border: none;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 1.05rem;
        }

        .btn-back:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.3);
            color: #667eea;
        }

        .detail-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            border: none;
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 250px;
            height: 250px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .card-header h3 {
            margin: 0;
            color: white;
            font-weight: 800;
            font-size: 2rem;
            display: flex;
            align-items: center;
            gap: 15px;
            position: relative;
            z-index: 2;
            text-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .card-header h3 i {
            font-size: 2.5rem;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .info-section {
            padding: 35px 40px;
            border-bottom: 2px solid #f0f4f8;
            transition: all 0.3s ease;
        }

        .info-section:hover {
            background: linear-gradient(135deg, #f8f9fc 0%, #ffffff 100%);
            transform: translateX(5px);
        }

        .info-section:last-child {
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

        .info-label i {
            font-size: 1.3rem;
        }

        .info-value {
            font-size: 1.2rem;
            color: #2d3748;
            line-height: 1.8;
            font-weight: 500;
        }

        .todo-title-detail {
            font-size: 2rem;
            font-weight: 800;
            color: #2d3748;
            margin: 0;
            line-height: 1.4;
        }

        .todo-desc-detail {
            color: #4a5568;
            white-space: pre-wrap;
            line-height: 1.8;
        }

        .empty-desc {
            color: #a0aec0;
            font-style: italic;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .status-badge-detail {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 15px 35px;
            border-radius: 50px;
            font-weight: 800;
            font-size: 1.2rem;
            letter-spacing: 0.5px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            animation: bounceIn 0.6s ease-out;
        }

        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .status-finished {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
        }

        .status-unfinished {
            background: linear-gradient(135deg, #fa8e53 0%, #feb47b 100%);
            color: white;
        }

        .date-card {
            background: linear-gradient(135deg, #f5f7fa 0%, #e8eef5 100%);
            padding: 20px 30px;
            border-radius: 20px;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            font-weight: 600;
            color: #4a5568;
            transition: all 0.3s ease;
        }

        .date-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .date-card i {
            color: #667eea;
            font-size: 1.3rem;
            margin-right: 10px;
        }

        .action-section {
            background: linear-gradient(135deg, #f8f9fc 0%, #ffffff 100%);
            padding: 40px;
        }

        .btn-action-large {
            padding: 16px 40px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            border: none;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: inline-flex;
            align-items: center;
            gap: 12px;
            position: relative;
            overflow: hidden;
        }

        .btn-action-large::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-action-large:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-action-large:hover {
            transform: translateY(-5px);
        }

        .btn-edit-large {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            color: #2d3748;
            box-shadow: 0 8px 25px rgba(168, 237, 234, 0.4);
        }

        .btn-edit-large:hover {
            box-shadow: 0 12px 35px rgba(168, 237, 234, 0.6);
            color: #2d3748;
        }

        .btn-delete-large {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
            color: white;
            box-shadow: 0 8px 25px rgba(255, 107, 107, 0.4);
        }

        .btn-delete-large:hover {
            box-shadow: 0 12px 35px rgba(255, 107, 107, 0.6);
            color: white;
        }

        .divider {
            height: 2px;
            background: linear-gradient(90deg, transparent, #667eea, transparent);
            margin: 35px 0;
        }

        @media (max-width: 768px) {
            .info-section {
                padding: 25px 20px;
            }

            .todo-title-detail {
                font-size: 1.5rem;
            }

            .btn-action-large {
                padding: 14px 30px;
                font-size: 1rem;
            }

            .action-section {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid detail-container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-9 col-xl-8">
                <!-- Back Button -->
                <div class="mb-4">
                    <a href="index.php" class="btn btn-back">
                        <i class="bi bi-arrow-left-circle-fill"></i>
                        <span>Kembali ke Daftar</span>
                    </a>
                </div>

                <!-- Detail Card -->
                <div class="card detail-card">
                    <div class="card-header">
                        <h3>
                            <i class="bi bi-file-earmark-text-fill"></i>
                            <span>Detail Todo</span>
                        </h3>
                    </div>

                    <div class="card-body p-0">
                        <!-- Judul -->
                        <div class="info-section">
                            <div class="info-label">
                                <i class="bi bi-bookmark-fill"></i>
                                JUDUL TODO
                            </div>
                            <div class="info-value">
                                <h2 class="todo-title-detail"><?= htmlspecialchars($todo['title']) ?></h2>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="info-section">
                            <div class="info-label">
                                <i class="bi bi-text-left"></i>
                                DESKRIPSI LENGKAP
                            </div>
                            <div class="info-value">
                                <?php if (!empty($todo['description'])): ?>
                                    <div class="todo-desc-detail"><?= nl2br(htmlspecialchars($todo['description'])) ?></div>
                                <?php else: ?>
                                    <div class="empty-desc">
                                        <i class="bi bi-inbox"></i>
                                        <span>Tidak ada deskripsi untuk todo ini</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="info-section">
                            <div class="info-label">
                                <i class="bi bi-check-circle-fill"></i>
                                STATUS PENYELESAIAN
                            </div>
                            <div class="info-value">
                                <?php if ($todo['is_finished'] == 't' || $todo['is_finished'] == '1'): ?>
                                    <span class="status-badge-detail status-finished">
                                        <i class="bi bi-check-circle-fill"></i>
                                        <span>Sudah Selesai</span>
                                    </span>
                                <?php else: ?>
                                    <span class="status-badge-detail status-unfinished">
                                        <i class="bi bi-clock-history"></i>
                                        <span>Belum Selesai</span>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="divider mx-4"></div>

                        <!-- Tanggal Dibuat -->
                        <div class="info-section">
                            <div class="info-label">
                                <i class="bi bi-calendar-plus-fill"></i>
                                TANGGAL DIBUAT
                            </div>
                            <div class="info-value">
                                <div class="date-card">
                                    <i class="bi bi-calendar3"></i>
                                    <?= date('l, d F Y - H:i:s', strtotime($todo['created_at'])) ?> WIB
                                </div>
                            </div>
                        </div>

                        <!-- Tanggal Update -->
                        <div class="info-section">
                            <div class="info-label">
                                <i class="bi bi-arrow-repeat"></i>
                                TERAKHIR DIPERBARUI
                            </div>
                            <div class="info-value">
                                <div class="date-card">
                                    <i class="bi bi-clock-history"></i>
                                    <?= date('l, d F Y - H:i:s', strtotime($todo['updated_at'])) ?> WIB
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-section">
                            <div class="d-flex flex-wrap gap-3 justify-content-center">
                                <button class="btn btn-action-large btn-edit-large" onclick="editTodo()">
                                    <i class="bi bi-pencil-square"></i>
                                    <span>Edit Todo Ini</span>
                                </button>
                                <button class="btn btn-action-large btn-delete-large" onclick="deleteTodo()">
                                    <i class="bi bi-trash3-fill"></i>
                                    <span>Hapus Todo Ini</span>
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
            if (confirm('⚠️ Yakin ingin menghapus todo "<?= htmlspecialchars(addslashes($todo['title'])) ?>"?\n\nTindakan ini tidak dapat dibatalkan!')) {
                window.location.href = '?page=delete&id=<?= $todo['id'] ?>';
            }
        }
    </script>
</body>
</html>