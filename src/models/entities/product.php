<?php
require_once 'src/mdels/entities/baseEntity.php';
class Product extends BaseEntity {
    public $id;
    public $name;
    public $price;
    public $categoryId;

    public function __construct($id, $name, $price, $categoryId, $created_at, $created_by) {
        parent::__construct($created_at, $created_by);
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->categoryId = $categoryId;
    }
}
