<?php
class BaseModel {
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // fetch a single row
    protected function fetchOne($sql) {
        $result = mysqli_query($this->conn, $sql);
        if (!$result) {
            die("MySQL error: " . mysqli_error($this->conn));
        }
        return mysqli_fetch_assoc($result);
    }

    // fetch all rows
    protected function fetchAll($sql) {
        $result = mysqli_query($this->conn, $sql);
        if (!$result) {
            die("MySQL error: " . mysqli_error($this->conn));
        }

        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    protected function execute($sql) {
        $result = mysqli_query($this->conn, $sql);
        if (!$result) die("MySQL error: " . mysqli_error($this->conn));
        return $result;
    }
}
?>