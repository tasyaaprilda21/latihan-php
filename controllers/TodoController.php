<?php
require_once(__DIR__ . '/../models/TodoModel.php');

class TodoController
{
    public function index()
    {
        $todoModel = new TodoModel();
        
        // Ambil parameter filter dan search dari GET
        $filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        
        $todos = $todoModel->getAllTodos($filter, $search);
        
        include(__DIR__ . '/../views/TodoView.php');
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            
            $todoModel = new TodoModel();
            
            // Validasi judul tidak boleh kosong
            if (empty($title)) {
                $_SESSION['error'] = 'Judul tidak boleh kosong!';
                header('Location: index.php');
                exit;
            }
            
            // Coba buat todo
            $result = $todoModel->createTodo($title, $description);
            
            if (!$result) {
                $_SESSION['error'] = 'Todo dengan judul yang sama sudah ada!';
            } else {
                $_SESSION['success'] = 'Todo berhasil ditambahkan!';
            }
        }
        
        header('Location: index.php');
        exit;
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $isFinished = isset($_POST['is_finished']) ? $_POST['is_finished'] : '0';
            
            $todoModel = new TodoModel();
            
            // Validasi judul tidak boleh kosong
            if (empty($title)) {
                $_SESSION['error'] = 'Judul tidak boleh kosong!';
                header('Location: index.php');
                exit;
            }
            
            // Coba update todo
            $result = $todoModel->updateTodo($id, $title, $description, $isFinished);
            
            if (!$result) {
                $_SESSION['error'] = 'Todo dengan judul yang sama sudah ada!';
            } else {
                $_SESSION['success'] = 'Todo berhasil diubah!';
            }
        }
        
        header('Location: index.php');
        exit;
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $id = $_GET['id'];
            
            $todoModel = new TodoModel();
            $result = $todoModel->deleteTodo($id);
            
            if ($result) {
                $_SESSION['success'] = 'Todo berhasil dihapus!';
            } else {
                $_SESSION['error'] = 'Gagal menghapus todo!';
            }
        }
        
        header('Location: index.php');
        exit;
    }

    public function detail()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            $todoModel = new TodoModel();
            $todo = $todoModel->getTodoById($id);
            
            if ($todo) {
                include(__DIR__ . '/../views/TodoDetailView.php');
            } else {
                $_SESSION['error'] = 'Todo tidak ditemukan!';
                header('Location: index.php');
                exit;
            }
        } else {
            header('Location: index.php');
            exit;
        }
    }

    public function updateSortOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (isset($data['order']) && is_array($data['order'])) {
                $todoModel = new TodoModel();
                $result = $todoModel->updateSortOrder($data['order']);
                
                header('Content-Type: application/json');
                echo json_encode(['success' => $result]);
                exit;
            }
        }
        
        header('Content-Type: application/json');
        echo json_encode(['success' => false]);
        exit;
    }
}