<?php
require_once(__DIR__ . '/../config.php');

class TodoModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = pg_connect(
            'host=' . DB_HOST .
            ' port=' . DB_PORT .
            ' dbname=' . DB_NAME .
            ' user=' . DB_USER .
            ' password=' . DB_PASSWORD
        );

        if (!$this->conn) {
            die('Koneksi database gagal');
        }
    
    // 🔍 Tes koneksi untuk memastikan database aktif
    $result = pg_query($this->conn, "SELECT current_database() AS db, current_user AS user");
    $row = pg_fetch_assoc($result);
    error_log("✅ Koneksi aktif ke database: " . $row['db'] . " | user: " . $row['user']);
}

    // =========================
    // Ambil semua todo
    // =========================
    public function getAllTodos($filter = 'all', $search = '')
    {
        $query = 'SELECT * FROM todo WHERE 1=1';
        $params = [];

        if ($filter === 'finished') {
            $query .= ' AND is_finished = true';
        } elseif ($filter === 'unfinished') {
            $query .= ' AND is_finished = false';
        }

        if (!empty($search)) {
            $query .= ' AND (LOWER(title) LIKE $1 OR LOWER(description) LIKE $1)';
            $params[] = '%' . strtolower($search) . '%';
        }

        $query .= ' ORDER BY sort_order ASC, created_at DESC';
        $result = pg_query_params($this->conn, $query, $params);

        $todos = [];
        if ($result && pg_num_rows($result) > 0) {
            while ($row = pg_fetch_assoc($result)) {
                $todos[] = $row;
            }
        }

        return $todos;
    }

    // =========================
    // Ambil todo berdasarkan ID
    // =========================
    public function getTodoById($id)
    {
        $query = 'SELECT * FROM todo WHERE id = $1';
        $result = pg_query_params($this->conn, $query, [$id]);
        return $result && pg_num_rows($result) > 0 ? pg_fetch_assoc($result) : null;
    }

    // =========================
    // Cek apakah judul sudah ada
    // =========================
    // Cek apakah title sudah ada (untuk validasi)
    public function isTitleExists($title, $excludeId = null)
{
    if ($excludeId) {
        $query = 'SELECT COUNT(*) AS total FROM todo WHERE LOWER(title) = LOWER($1) AND id != $2';
        $params = [$title, $excludeId];
    } else {
        $query = 'SELECT COUNT(*) AS total FROM todo WHERE LOWER(title) = LOWER($1)';
        $params = [$title];
    }

    $result = pg_query_params($this->conn, $query, $params);

    if (!$result) {
        error_log('❌ Query cek duplikat gagal: ' . pg_last_error($this->conn));
        return false;
    }

    $row = pg_fetch_assoc($result);
    $count = isset($row['total']) ? intval($row['total']) : 0;

    // Tambahkan log debug
    error_log("🔍 DEBUG isTitleExists: title='{$title}' | total={$count}");

    return $count > 0;
}


// Membuat todo baru
public function createTodo($title, $description = '')
{
    // Cek duplikat judul
    if ($this->isTitleExists($title)) {
        error_log("Judul '$title' sudah ada, batalkan insert.");
        return false;
    }

    // Ambil urutan tertinggi
    $maxOrderQuery = 'SELECT COALESCE(MAX(sort_order), 0) + 1 AS next_order FROM todo';
    $maxOrderResult = pg_query($this->conn, $maxOrderQuery);
    $nextOrder = 0;

    if ($maxOrderResult) {
        $row = pg_fetch_assoc($maxOrderResult);
        $nextOrder = (int)$row['next_order'];
    }

    // Masukkan data baru
    $query = 'INSERT INTO todo (title, description, sort_order, created_at, updated_at)
              VALUES ($1, $2, $3, NOW(), NOW())';
    $result = pg_query_params($this->conn, $query, [$title, $description, $nextOrder]);

    if (!$result) {
        error_log('Gagal menambah todo: ' . pg_last_error($this->conn));
    }

    return $result !== false;
}

    // =========================
    // Update todo
    // =========================
    public function updateTodo($id, $title, $description, $isFinished)
    {
        if ($this->isTitleExists($title, $id)) {
            return false;
        }

        $query = 'UPDATE todo SET title=$1, description=$2, is_finished=$3, updated_at=NOW() WHERE id=$4';
        $result = pg_query_params($this->conn, $query, [$title, $description, $isFinished, $id]);

        if (!$result) {
            error_log('Gagal update todo: ' . pg_last_error($this->conn));
        }

        return $result !== false;
    }

    // =========================
    // Update urutan sort
    // =========================
    public function updateSortOrder($todoOrders)
    {
        pg_query($this->conn, 'BEGIN');
        try {
            foreach ($todoOrders as $order => $id) {
                $query = 'UPDATE todo SET sort_order = $1 WHERE id = $2';
                $result = pg_query_params($this->conn, $query, [$order, $id]);
                if (!$result) {
                    pg_query($this->conn, 'ROLLBACK');
                    return false;
                }
            }
            pg_query($this->conn, 'COMMIT');
            return true;
        } catch (Exception $e) {
            pg_query($this->conn, 'ROLLBACK');
            error_log('Gagal update urutan: ' . $e->getMessage());
            return false;
        }
    }

    // =========================
    // Hapus todo
    // =========================
    public function deleteTodo($id)
    {
        $query = 'DELETE FROM todo WHERE id=$1';
        $result = pg_query_params($this->conn, $query, [$id]);
        return $result !== false;
    }
}


