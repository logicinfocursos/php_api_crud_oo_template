<?php
abstract class Controllers
{
    protected $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function getAll($page = 1, $perPage = 10)
    {
        try {

            $items = $this->repository->getAllPaginated($page, $perPage);
            return ['data' => $items, 'status' => 200];

        } catch (PDOException $e) {

            return ['error' => 'Error fetching data: ' . $e->getMessage(), 'status' => 500];
        }
    }

    public function getById($id)
    {
        try {
            $item = $this->repository->getById($id);

            if ($item) {
                return ['data' => $item, 'status' => 200];
            } else {
                return ['error' => 'Record not found', 'status' => 404];
            }
        } catch (PDOException $e) {
            return ['error' => 'Error fetching data: ' . $e->getMessage(), 'status' => 500];
        }
    }

    public function add($data)
    {
        try {
            $result = $this->repository->add($data);
            return ['data' => $result, 'status' => 201];
        } catch (PDOException $e) {
            return ['error' => 'Error adding data: ' . $e->getMessage(), 'status' => 500];
        }
    }

    public function update($id, $data)
    {
        try {
            $result = $this->repository->update($id, $data);
            if ($result) {
                return ['data' => $result, 'status' => 200];
            } else {
                return ['error' => 'Record not found', 'status' => 404];
            }
        } catch (PDOException $e) {
            return ['error' => 'Error updating data: ' . $e->getMessage(), 'status' => 500];
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->repository->delete($id);
            if ($result) {
                return ['data' => ['id' => $id, 'message' => 'Deleted successfully'], 'status' => 200];
            } else {
                return ['error' => 'Record not found', 'status' => 404];
            }
        } catch (PDOException $e) {
            return ['error' => 'Error deleting data: ' . $e->getMessage(), 'status' => 500];
        }
    }

    public function getListByKey($key, $value, $page = 1, $perPage = 10)
    {
        try {
            $items = $this->repository->getListByKey($key, $value, $page, $perPage);
            return ['data' => $items, 'status' => 200];
        } catch (PDOException $e) {
            return ['error' => 'Error fetching data: ' . $e->getMessage(), 'status' => 500];
        }
    }

    public function getItemByKey($key, $value)
    {
        try {
            $item = $this->repository->getItemByKey($key, $value);
            return ['data' => $item, 'status' => 200];
        } catch (PDOException $e) {
            return ['error' => 'Error fetching data: ' . $e->getMessage(), 'status' => 500];
        }
    }
}
