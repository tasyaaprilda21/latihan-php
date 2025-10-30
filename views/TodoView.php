<!DOCTYPE html>
<html>
<head>
    <title>PHP - Aplikasi Todolist</title>
    <link href="/assets/vendor/bootstrap-5.3.8-dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .todo-item {
            cursor: move;
            transition: background-color 0.2s;
        }
        .todo-item:hover {
            background-color: #f8f9fa;
        }
        .todo-item.sortable-ghost {
            opacity: 0.4;
            background-color: #e9ecef;
        }
        .badge-status {
            min-width: 100px;
        }
        .search-filter-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-5">
        <div class="card">
            <div class="card-body">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>Todo List</h1>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTodo">
                        <i class="bi bi-plus-circle"></i> Tambah Data
                    </button>
                </div>

                <!-- Alert Messages -->
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $_SESSION['success'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $_SESSION['error'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <!-- Search and Filter Section -->
                <div class="search-filter-section">
                    <form method="GET" action="index.php" class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Pencarian</label>
                            <input type="text" name="search" class="form-control" placeholder="Cari todo berdasarkan judul atau deskripsi..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Filter Status</label>
                            <select name="filter" class="form-select">
                                <option value="all" <?= (!isset($_GET['filter']) || $_GET['filter'] == 'all') ? 'selected' : '' ?>>Semua</option>
                                <option value="unfinished" <?= (isset($_GET['filter']) && $_GET['filter'] == 'unfinished') ? 'selected' : '' ?>>Belum Selesai</option>
                                <option value="finished" <?= (isset($_GET['filter']) && $_GET['filter'] == 'finished') ? 'selected' : '' ?>>Selesai</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Cari</button>
                        </div>
                    </form>
                </div>

                <hr />

                <!-- Todo Table -->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 50px;">#</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col" style="width: 120px;">Status</th>
                                <th scope="col" style="width: 180px;">Tanggal Dibuat</th>
                                <th scope="col" style="width: 250px;">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody id="todoTableBody">
                            <?php if (!empty($todos)): ?>
                                <?php foreach ($todos as $i => $todo): ?>
                                    <tr class="todo-item" data-id="<?= $todo['id'] ?>">
                                        <td><?= $i + 1 ?></td>
                                        <td><strong><?= htmlspecialchars($todo['title']) ?></strong></td>
                                        <td><?= htmlspecialchars(substr($todo['description'], 0, 50)) ?><?= strlen($todo['description']) > 50 ? '...' : '' ?></td>
                                        <td>
                                            <?php if ($todo['is_finished'] == 't' || $todo['is_finished'] == '1'): ?>
                                                <span class="badge bg-success badge-status">Selesai</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger badge-status">Belum Selesai</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= date('d F Y - H:i', strtotime($todo['created_at'])) ?></td>
                                        <td>
                                            <a href="?page=detail&id=<?= $todo['id'] ?>" class="btn btn-sm btn-info">Detail</a>
                                            <button class="btn btn-sm btn-warning" onclick="showModalEditTodo(<?= $todo['id'] ?>, '<?= htmlspecialchars(addslashes($todo['title'])) ?>', '<?= htmlspecialchars(addslashes($todo['description'])) ?>', '<?= $todo['is_finished'] == 't' || $todo['is_finished'] == '1' ? '1' : '0' ?>')">
                                                Ubah
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="showModalDeleteTodo(<?= $todo['id'] ?>, '<?= htmlspecialchars(addslashes($todo['title'])) ?>')">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted">
                                        <?php if (isset($_GET['search']) && !empty($_GET['search'])): ?>
                                            Tidak ada todo yang ditemukan untuk pencarian "<?= htmlspecialchars($_GET['search']) ?>"
                                        <?php else: ?>
                                            Belum ada data tersedia!
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL ADD TODO -->
    <div class="modal fade" id="addTodo" tabindex="-1" aria-labelledby="addTodoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTodoLabel">Tambah Data Todo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="?page=create" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="inputTitle" class="form-label">Judul <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Contoh: Belajar PHP" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputDescription" class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control" id="inputDescription" rows="3" placeholder="Contoh: Belajar membuat aplikasi website sederhana menggunakan PHP"></textarea>
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

    <!-- MODAL EDIT TODO -->
    <div class="modal fade" id="editTodo" tabindex="-1" aria-labelledby="editTodoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTodoLabel">Ubah Data Todo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="?page=update" method="POST">
                    <input name="id" type="hidden" id="inputEditTodoId">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="inputEditTitle" class="form-label">Judul <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" id="inputEditTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputEditDescription" class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control" id="inputEditDescription" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="selectEditStatus" class="form-label">Status</label>
                            <select class="form-select" name="is_finished" id="selectEditStatus">
                                <option value="0">Belum Selesai</option>
                                <option value="1">Selesai</option>
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

    <!-- MODAL DELETE TODO -->
    <div class="modal fade" id="deleteTodo" tabindex="-1" aria-labelledby="deleteTodoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteTodoLabel">Hapus Data Todo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        Kamu akan menghapus todo <strong class="text-danger" id="deleteTodoTitle"></strong>.
                        Apakah kamu yakin?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a id="btnDeleteTodo" class="btn btn-danger">Ya, Tetap Hapus</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="/assets/vendor/bootstrap-5.3.8-dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    
    <script>
        // Fungsi untuk menampilkan modal edit
        function showModalEditTodo(todoId, title, description, status) {
            document.getElementById("inputEditTodoId").value = todoId;
            document.getElementById("inputEditTitle").value = title;
            document.getElementById("inputEditDescription").value = description;
            document.getElementById("selectEditStatus").value = status;
            
            var myModal = new bootstrap.Modal(document.getElementById("editTodo"));
            myModal.show();
        }

        // Fungsi untuk menampilkan modal delete
        function showModalDeleteTodo(todoId, title) {
            document.getElementById("deleteTodoTitle").innerText = title;
            document.getElementById("btnDeleteTodo").setAttribute("href", `?page=delete&id=${todoId}`);
            
            var myModal = new bootstrap.Modal(document.getElementById("deleteTodo"));
            myModal.show();
        }

        // Inisialisasi Sortable.js untuk drag and drop
        var todoTableBody = document.getElementById('todoTableBody');
        
        if (todoTableBody && todoTableBody.children.length > 1) {
            var sortable = Sortable.create(todoTableBody, {
                animation: 150,
                handle: '.todo-item',
                ghostClass: 'sortable-ghost',
                onEnd: function(evt) {
                    // Ambil urutan baru setelah drag and drop
                    var order = [];
                    var items = todoTableBody.getElementsByClassName('todo-item');
                    
                    for (var i = 0; i < items.length; i++) {
                        order.push(items[i].getAttribute('data-id'));
                    }
                    
                    // Kirim ke server untuk disimpan
                    fetch('?page=update-sort', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ order: order })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Sort order updated successfully');
                            // Update nomor urut di kolom pertama
                            for (var i = 0; i < items.length; i++) {
                                items[i].querySelector('td:first-child').textContent = i + 1;
                            }
                        } else {
                            console.error('Failed to update sort order');
                            alert('Gagal menyimpan urutan. Silakan refresh halaman.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menyimpan urutan.');
                    });
                }
            });
        }

        // Auto-open modal edit jika ada hash #edit-{id} dari halaman detail
        window.addEventListener('DOMContentLoaded', function() {
            var hash = window.location.hash;
            if (hash.startsWith('#edit-')) {
                var todoId = hash.replace('#edit-', '');
                
                // Cari todo berdasarkan ID dan buka modal edit
                <?php foreach ($todos as $todo): ?>
                if (<?= $todo['id'] ?> == todoId) {
                    showModalEditTodo(
                        <?= $todo['id'] ?>,
                        '<?= htmlspecialchars(addslashes($todo['title'])) ?>',
                        '<?= htmlspecialchars(addslashes($todo['description'])) ?>',
                        '<?= $todo['is_finished'] == 't' || $todo['is_finished'] == '1' ? '1' : '0' ?>'
                    );
                    // Hapus hash dari URL setelah modal dibuka
                    history.replaceState(null, null, ' ');
                }
                <?php endforeach; ?>
            }
        });
    </script>
</body>
</html>