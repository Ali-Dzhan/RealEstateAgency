<?php
class User extends BaseModel {

    // CREATE
    public function create($username, $password, $role) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password_hash, role) VALUES (
            '$username', '$hash', '$role'
        )";
        return $this->execute($sql);
    }

    // READ
    public function getById($id) {
        return $this->fetchOne("SELECT * FROM users WHERE id = $id");
    }

    public function getByUsername($username) {
        return $this->fetchOne("SELECT * FROM users WHERE username = '$username'");
    }

    public function getAll() {
        return $this->fetchAll("SELECT * FROM users");
    }

    // UPDATE
    public function update($id, $username=null, $password=null, $role=null) {
        $fields = [];
        if ($username !== null) $fields[] = "username = '$username'";
        if ($password !== null) $fields[] = "password_hash ='" . password_hash($password, PASSWORD_DEFAULT) . "'";
        if ($role !== null) $fields[] = "role = '$role'";
        if (empty($fields)) return false;

        $sql = "UPDATE users SET " . implode(', ', $fields) . " WHERE id = $id";
        return $this->execute($sql);
    }

    // DELETE
    public function delete($id) {
        return $this->execute("DELETE FROM users WHERE id = $id");
    }
}
?>