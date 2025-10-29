<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Todo List</title>
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
            padding: 20px 0;
        }
        .main-card {
            background: white;
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            animation: slideUp 0.6s ease;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .header-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px;
            color: white;
        }
        .header-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .header-icon {
            font-size: 3rem;
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .btn-add {
            background: white;
            color: #667eea;
            font-weight: 700;
            padding: 14px 30px;
            border-radius: 50px;
            border: none;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            transition: all 0.3s;
        }
        .btn-add:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.3);
            color: #667eea;
        }
        .stats-section {
            background: linear-gradient(135deg, #f5f7fa 0%, #e8eef5 100%);
            padding: 25px 40px;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }
        .stat-item {
            text-align: center;
            padding: 15px 25px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            min-width: 150px;
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .stat-label {
            font-size: 0.95rem;
            color: #718096;
            font-weight: 600;
        }
        .content-section {
            padding: 35px 40px;
        }
        .search-filter-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fc 100%);
            padding: 30px;
            border-radius: 25px;
            margin-bottom: 30px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        }
        .form-control, .form-select {
            border-radius: 15px;
            border: 2px solid #e2e8f0;
            padding: 14px 20px;
            transition: all 0.3s;
        }
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102,126,234,0.15);
        }
        .btn-search {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 15px;
            padding: 14px 25px;
            font-weight: 700;
            color: white;
        }
        .btn-search:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102,126,234,0.4);
        }
        .table-container {
            background: white;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        }
        .table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .table thead th {
            color: white;
            border: none;
            padding: 20px 18px;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.85rem;
        }
        .todo-item {
            cursor: move;
            transition: all 0.3s;
            background: white;
        }
        .todo-item:hover {
            background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
            transform: translateX(5px);
        }
        .todo-item td {
            padding: 20px 18px;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
        }
        .todo-number {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }
        .status-badge {
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.9rem;
        }
        .status-finished {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
        }
        .status-unfinished {
            background: linear-gradient(135deg, #fa8e53 0%, #feb47b 100%);
            color: white;
        }
        .btn-action {
            border: none;
            border-radius: 12px;
            padding: 8px 18px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        .btn-detail {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }
        .btn-detail:hover {
            transform: translateY(-2px);
            color: white;
        }
        .btn-edit {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            color: #2d3748;
        }
        .btn-edit:hover {
            transform: translateY(-2px);
            color: #2d3748;
        }
        .btn-delete {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
            color: white;
        }
        .btn-delete:hover {
            transform: translateY(-2px);
            color: white;
        }
        .empty-state {
            text-align: center;
            padding: 80px 30px;
        }
        .empty-icon {
            font-size: 5rem;
            color: #cbd5e0;
            margin-bottom: 20px;
        }
        .modal-content {
            border-radius: 25px;
            border: none;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 25px 35px;
        }
        .modal-title {
            font-weight: 700;
            font-size: 1.5rem;
        }
        .modal-body {
            padding: 35px;
        }
        .alert {
            border-radius: 20px;
            border: none;
            padding: 18px 25px;
            font-weight: 500;
        }
        .alert-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
        }
        .alert-danger {
            background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
            color: white;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-11">
                <div class="card main-card">
                    <div class="header-section">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div>
                                <h1 class="header-title">
                                    <span class="header-icon">📝</span>
                                    <span>My Todo List</span>
                                </h1>
                                <p class="mb-0 mt-2" style="opacity: 0.9;">Kelola aktivitasmu dengan mudah!</p>
                            </div>
                            <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addTodo">
                                <i class="bi bi-plus-circle-fill me-2"></i>Tambah Todo
                            </button>
                        </div>
                    </div>

                    <div class="stats-section">
                        <?php
                        $totalTodos = count($todos);
                        $finishedTodos = count(array_filter($todos, function($todo) {
                            return $todo['is_finished'] == 't' || $todo['is_finished'] == '1';
                        }));
                        $unfinishedTodos = $totalTodos - $finishedTodos;
                        ?>
                        <div class="stat-item">
                            <div class="stat-number"><?= $totalTodos ?></div>
                            <div class="stat-label">📋 Total</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number"><?= $finishedTodos ?></div>
                            <div class="stat-label">✅ Selesai</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number"><?= $unfinishedTodos ?></div>
                            <div class="stat-label">⏳ Belum</div>
                        </div>
                    </div>

                    <div class="content-section">
                        <?php if (isset($_SESSION['success'])): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i><?= $_SESSION['success'] ?>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                            </div>
                            <?php unset($_SESSION['success']); ?>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i><?= $_SESSION['error'] ?>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                            </div>
                            <?php unset($_SESSION['error']); ?>
                        <?php endif; ?>

                        <div class="search-filter-card">
                            <form method="GET" action="index.php" class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-search me-2"></i>Pencarian
                                    </label>
                                    <input type="text" name="search" class="form-control" placeholder="Cari todo..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-filter me-2"></i>Filter
                                    </label>
                                    <select name="filter" class="form-select">
                                        <option value="all" <?= (!isset($_GET['filter']) || $_GET['filter'] == 'all') ? 'selected' : '' ?>>📋 Semua</option>
                                        <option value="unfinished" <?= (isset($_GET['filter']) && $_GET['filter'] == 'unfinished') ? 'selected' : '' ?>>⏳ Belum Selesai</option>
                                        <option value="finished" <?= (isset($_GET['filter']) && $_GET['filter'] == 'finished') ? 'selected' : '' ?>>✅ Selesai</option>
                                    </select>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-search w-100">
                                        <i class="bi bi-search me-2"></i>Cari
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="table-container">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 80px;">#</th>
                                            <th>Judul</th>
                                            <th>Deskripsi</th>
                                            <th style="width: 150px;">Status</th>
                                            <th style="width: 180px;">Tanggal</th>
                                            <th style="width: 300px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="todoTableBody">
                                        <?php if (!empty($todos)): ?>
                                            <?php foreach ($todos as $i => $todo): ?>
                                                <tr class="todo-item" data-id="<?= $todo['id'] ?>">
                                                    <td class="text-center">
                                                        <span class="todo-number"><?= $i + 1 ?></span>
                                                    </td>
                                                    <td>
                                                        <strong><?= htmlspecialchars($todo['title']) ?></strong>
                                                    </td>
                                                    <td>
                                                        <span style="color: #718096;">
                                                            <?= htmlspecialchars(substr($todo['description'], 0, 50)) ?><?= strlen($todo['description']) > 50 ? '...' : '' ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <?php if ($todo['is_finished'] == 't' || $todo['is_finished'] == '1'): ?>
                                                            <span class="status-badge status-finished">
                                                                <i class="bi bi-check-circle me-1"></i>Selesai
                                                            </span>
                                                        <?php else: ?>
                                                            <span class="status-badge status-unfinished">
                                                                <i class="bi bi-clock me-1"></i>Belum
                                                            </span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <small style="color: #718096;">
                                                            <i class="bi bi-calendar3 me-1"></i>
                                                            <?= date('d M Y', strtotime($todo['created_at'])) ?>
                                                        </small>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="?page=detail&id=<?= $todo['id'] ?>" class="btn btn-sm btn-action btn-detail">
                                                                <i class="bi bi-eye me-1"></i>Detail
                                                            </a>
                                                            <button class="btn btn-sm btn-action btn-edit" onclick="showModalEditTodo(<?= $todo['id'] ?>, '<?= htmlspecialchars(addslashes($todo['title'])) ?>', '<?= htmlspecialchars(addslashes($todo['description'])) ?>', '<?= $todo['is_finished'] == 't' || $todo['is_finished'] == '1' ? '1' : '0' ?>')">
                                                                <i class="bi bi-pencil me-1"></i>Ubah
                                                            </button>
                                                            <button class="btn btn-sm btn-action btn-delete" onclick="showModalDeleteTodo(<?= $todo['id'] ?>, '<?= htmlspecialchars(addslashes($todo['title'])) ?>')">
                                                                <i class="bi bi-trash me-1"></i>Hapus
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6">
                                                    <div class="empty-state">
                                                        <div class="empty-icon">
                                                            <i class="bi bi-inbox"></i>
                                                        </div>
                                                        <h5>
                                                            <?php if (isset($_GET['search']) && !empty($_GET['search'])): ?>
                                                                Tidak ada hasil untuk "<?= htmlspecialchars($_GET['search']) ?>"
                                                            <?php else: ?>
                                                                Belum ada todo. Mulai tambahkan!
                                                            <?php endif; ?>
                                                        </h5>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addTodo" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Todo
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="?page=create" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" placeholder="Contoh: Belajar PHP" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="4" placeholder="Jelaskan detail todo..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editTodo" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-pencil me-2"></i>Edit Todo
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="?page=update" method="POST">
                    <input name="id" type="hidden" id="inputEditTodoId">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" id="inputEditTitle" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi</label>
                            <textarea name="description" class="form-control" id="inputEditDescription" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <select class="form-select" name="is_finished" id="selectEditStatus">
                                <option value="0">⏳ Belum Selesai</option>
                                <option value="1">✅ Selesai</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteTodo" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title">
                        <i class="bi bi-trash me-2"></i>Hapus Todo
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <i class="bi bi-exclamation-triangle" style="font-size: 4rem; color: #fbbf24;"></i>
                    <h5 class="mt-3">Yakin ingin menghapus?</h5>
                    <p class="text-muted">Todo: <strong id="deleteTodoTitle"></strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a id="btnDeleteTodo" class="btn btn-danger">Ya, Hapus!</a>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/vendor/bootstrap-5.3.8-dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    
    <script>
        function showModalEditTodo(todoId, title, description, status) {
            document.getElementById("inputEditTodoId").value = todoId;
            document.getElementById("inputEditTitle").value = title;
            document.getElementById("inputEditDescription").value = description;
            document.getElementById("selectEditStatus").value = status;
            var myModal = new bootstrap.Modal(document.getElementById("editTodo"));
            myModal.show();
        }

        function showModalDeleteTodo(todoId, title) {
            document.getElementById("deleteTodoTitle").innerText = title;
            document.getElementById("btnDeleteTodo").setAttribute("href", `?page=delete&id=${todoId}`);
            var myModal = new bootstrap.Modal(document.getElementById("deleteTodo"));
            myModal.show();
        }

        var todoTableBody = document.getElementById('todoTableBody');
        if (todoTableBody && todoTableBody.children.length > 1) {
            var sortable = Sortable.create(todoTableBody, {
                animation: 150,
                handle: '.todo-item',
                onEnd: function(evt) {
                    var order = [];
                    var items = todoTableBody.getElementsByClassName('todo-item');
                    for (var i = 0; i < items.length; i++) {
                        order.push(items[i].getAttribute('data-id'));
                    }
                    fetch('?page=update-sort', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ order: order })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            for (var i = 0; i < items.length; i++) {
                                var num = items[i].querySelector('.todo-number');
                                if (num) num.textContent = i + 1;
                            }
                        }
                    });
                }
            });
        }

        window.addEventListener('DOMContentLoaded', function() {
            var hash = window.location.hash;
            if (hash.startsWith('#edit-')) {
                var todoId = hash.replace('#edit-', '');
                <?php foreach ($todos as $todo): ?>
                if (<?= $todo['id'] ?> == todoId) {
                    showModalEditTodo(<?= $todo['id'] ?>, '<?= htmlspecialchars(addslashes($todo['title'])) ?>', '<?= htmlspecialchars(addslashes($todo['description'])) ?>', '<?= $todo['is_finished'] == 't' || $todo['is_finished'] == '1' ? '1' : '0' ?>');
                    history.replaceState(null, null, ' ');
                }
                <?php endforeach; ?>
            }
        });
    </script>
</body>
</html>