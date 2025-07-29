<?php

/**
 * Example Products Model
 * 
 * This demonstrates how to create a data model using the framework
 */

class Products extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create($name, $description, $category, $price, $stock_quantity, $sku)
    {
        $sql = "INSERT INTO products (name, description, category, price, stock_quantity, sku, status, created_at) 
                VALUES (:name, :description, :category, :price, :stock_quantity, :sku, 1, NOW())";
        
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':stock_quantity', $stock_quantity, PDO::PARAM_INT);
        $stmt->bindParam(':sku', $sku, PDO::PARAM_STR);
        
        try {
            $stmt->execute();
            return $this->getConnection()->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Error creating product: " . $e->getMessage());
        }
    }

    public function update($id, $name, $description, $category, $price, $stock_quantity, $sku)
    {
        $sql = "UPDATE products SET 
                name = :name, 
                description = :description, 
                category = :category, 
                price = :price, 
                stock_quantity = :stock_quantity, 
                sku = :sku,
                updated_at = NOW()
                WHERE id = :id";
        
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':stock_quantity', $stock_quantity, PDO::PARAM_INT);
        $stmt->bindParam(':sku', $sku, PDO::PARAM_STR);
        
        return $stmt->execute();
    }

    public function delete($id)
    {
        $sql = "UPDATE products SET status = 0, updated_at = NOW() WHERE id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getById($id)
    {
        $sql = 'SELECT * FROM products WHERE id = :id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getAll()
    {
        $sql = 'SELECT id, name, description, category, price, stock_quantity, sku, status 
                FROM products 
                ORDER BY name ASC';
        $stmt = $this->getConnection()->query($sql);
        return $stmt->fetchAll();
    }

    public function getAllActive()
    {
        $sql = 'SELECT id, name, description, category, price, stock_quantity, sku 
                FROM products 
                WHERE status = 1 
                ORDER BY name ASC';
        $stmt = $this->getConnection()->query($sql);
        return $stmt->fetchAll();
    }

    public function getByCategory($category)
    {
        $sql = 'SELECT id, name, description, category, price, stock_quantity, sku 
                FROM products 
                WHERE category = :category AND status = 1 
                ORDER BY name ASC';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateStock($id, $quantity)
    {
        $sql = "UPDATE products SET stock_quantity = :quantity, updated_at = NOW() WHERE id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function search($term)
    {
        $sql = 'SELECT id, name, description, category, price, stock_quantity, sku 
                FROM products 
                WHERE (name LIKE :term OR description LIKE :term OR sku LIKE :term) 
                AND status = 1 
                ORDER BY name ASC';
        $stmt = $this->getConnection()->prepare($sql);
        $searchTerm = '%' . $term . '%';
        $stmt->bindParam(':term', $searchTerm, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}