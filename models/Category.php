<?php

class Category {
    private $conn;
    private $table = 'categories';

    public $id;
    public $category;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all categories
    public function read() {
        $query = 'SELECT id, category FROM ' . $this->table . ' ORDER BY id ASC';
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Get a single category by id
    public function read_single() {
        $query = 'SELECT id, category FROM ' . $this->table . ' WHERE id = :id LIMIT 1';
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->id       = $row['id'];
            $this->category = $row['category'];
            return true;
        }
        return false;
    }

    // Create a new category
    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (category) VALUES (:category) RETURNING id';
        $stmt  = $this->conn->prepare($query);
        $this->category = htmlspecialchars(strip_tags($this->category));
        $stmt->bindParam(':category', $this->category);

        try {
            if ($stmt->execute()) {
                $row      = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->id = $row['id'];
                return true;
            }
        } catch (PDOException $e) {
            return false;
        }
        return false;
    }

    // Update a category
    public function update() {
        $query = 'UPDATE ' . $this->table . ' SET category = :category WHERE id = :id';
        $stmt  = $this->conn->prepare($query);
        $this->category = htmlspecialchars(strip_tags($this->category));
        $this->id       = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':id',       $this->id);

        try {
            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            return false;
        }
        return false;
    }

    // Delete a category
    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt  = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        try {
            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            return false;
        }
        return false;
    }
}
