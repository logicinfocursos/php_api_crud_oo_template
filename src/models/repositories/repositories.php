<?php
// src/repositories/Repositories.php

abstract class Repositories
{
    protected $db;
    protected $table;

    public function __construct($db, $table)
    {
        $this->db = $db;
        $this->table = $table;
    }

    protected function fetchData($query, $params = [])
    {
        try {
            $statement = $this->db->prepare($query);
            $statement->execute($params);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException('Error fetching data: ' . $e->getMessage());
        }
    }

    protected function executeQuery($query, $params = [])
    {
        try {
            $statement = $this->db->prepare($query);
            $statement->execute($params);
            return $statement->rowCount();
        } catch (PDOException $e) {
            throw new PDOException('Error executing query: ' . $e->getMessage());
        }
    }

    public function getAllPaginated($page, $perPage)
    {
        // Calcular o índice inicial com base na página e itens por página
        $startIndex = ($page - 1) * $perPage;

        // Modificar a consulta para incluir a cláusula LIMIT
        $query = "SELECT * FROM $this->table LIMIT $startIndex, $perPage";
        
        return $this->fetchData($query);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $params = [':id' => $id];
        return $this->fetchData($query, $params);
    }

    public function add($data)
    {
        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));

        $query = "INSERT INTO $this->table ($columns) VALUES ($values)";
        $this->executeQuery($query, $data);
        return $this->getById($this->db->lastInsertId());
    }

    public function update($id, $data)
    {
        $columns = "";
        foreach ($data as $key => $value) {
            $columns .= "$key=:$key, ";
        }
        $columns = rtrim($columns, ", ");

        $query = "UPDATE $this->table SET $columns WHERE id = :id";
        $data[':id'] = $id;
        $this->executeQuery($query, $data);
        return $this->getById($id);
    }

    public function delete($id)
    {
        $query = "DELETE FROM $this->table WHERE id = :id";
        
        $params = [':id' => $id];

        $this->executeQuery($query, $params);
        return ['message' => 'Deleted successfully'];
    }
    public function getListByKey($key, $value, $page, $perPage)
    {
        $startIndex = ($page - 1) * $perPage;
        $query = "SELECT * FROM $this->table WHERE $key = :value LIMIT $startIndex, $perPage";
        $params = [':value' => $value];

        return $this->fetchData($query, $params);
    }

    public function getItemByKey($key, $value)
    {
        $query = "SELECT * FROM $this->table WHERE $key = :value";
        $params = [':value' => $value];

        return $this->fetchData($query, $params);
    }
}
