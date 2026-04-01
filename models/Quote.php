<?php

class Quote {
    private $conn;
    private $table = 'quotes';

    public $id;
    public $quote;
    public $author_id;
    public $category_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all quotes — optional filters: author_id, category_id
    public function read() {
        $query = 'SELECT q.id, q.quote, a.author, c.category, q.author_id, q.category_id
                  FROM '   . $this->table . ' q
                  LEFT JOIN authors    a ON q.author_id   = a.id
                  LEFT JOIN categories c ON q.category_id = c.id
                  WHERE 1=1';

        $params = [];

        if (!empty($this->author_id)) {
            $query   .= ' AND q.author_id = :author_id';
            $params[':author_id'] = $this->author_id;
        }

        if (!empty($this->category_id)) {
            $query   .= ' AND q.category_id = :category_id';
            $params[':category_id'] = $this->category_id;
        }

        $query .= ' ORDER BY q.id ASC';

        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }

    // Get a single quote by id
    public function read_single() {
        $query = 'SELECT q.id, q.quote, a.author, c.category
                  FROM '   . $this->table . ' q
                  LEFT JOIN authors    a ON q.author_id   = a.id
                  LEFT JOIN categories c ON q.category_id = c.id
                  WHERE q.id = :id LIMIT 1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->id          = $row['id'];
            $this->quote       = $row['quote'];
            $this->author_id   = $row['author'];   // return name for response
            $this->category_id = $row['category']; // return name for response
            return true;
        }
        return false;
    }

    // Create a new quote
    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (quote, author_id, category_id)
                  VALUES (:quote, :author_id, :category_id) RETURNING id';
        $stmt = $this->conn->prepare($query);
        $this->quote       = htmlspecialchars(strip_tags($this->quote));
        $this->author_id   = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $stmt->bindParam(':quote',       $this->quote);
        $stmt->bindParam(':author_id',   $this->author_id);
        $stmt->bindParam(':category_id', $this->category_id);

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

    // Update a quote
    public function update() {
        $query = 'UPDATE ' . $this->table . '
                  SET quote = :quote, author_id = :author_id, category_id = :category_id
                  WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $this->quote       = htmlspecialchars(strip_tags($this->quote));
        $this->author_id   = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id          = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':quote',       $this->quote);
        $stmt->bindParam(':author_id',   $this->author_id);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id',          $this->id);

        try {
            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            return false;
        }
        return false;
    }

    // Delete a quote
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
