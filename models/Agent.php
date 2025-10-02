<?php

class Agent extends User {

    // CREATE
    public function create($user_id, $first_name, $last_name, $phone, $email) {
        $sql = "INSERT INTO agents (user_id, first_name, last_name, phone, email) VALUES (
            $user_id, '$first_name', '$last_name', '$phone', '$email'
        )";
        return $this->execute($sql);
    }

    // READ
    public function getById($id) {
        return $this->fetchOne("SELECT * FROM agents WHERE id = $id");
    }

    public function getByUserId($user_id) {
        return $this->fetchOne("SELECT * FROM agents WHERE user_id = $user_id");
    }

    public function getAll() {
        return $this->fetchAll("SELECT * FROM agents");
    }

    // UPDATE
    public function update($id, $first_name=null, $last_name=null, $phone=null, $email=null) {
        $fields = [];
        if ($first_name !== null) $fields[] = "first_name = '$first_name'";
        if ($last_name !== null) $fields[] = "last_name = '$last_name'";
        if ($phone !== null) $fields[] = "phone = '$phone'";
        if ($email !== null) $fields[] = "email = '$email'";
        if (empty($fields)) return false;

        $sql = "UPDATE agents SET " . implode(', ', $fields) . " WHERE id = $id";
        return $this->execute($sql);
    }

    // DELETE
    public function delete($id) {
        return $this->execute("DELETE FROM agents WHERE id = $id");
    }
}
?>