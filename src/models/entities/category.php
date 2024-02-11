<?php

require_once 'src/mdels/entities/baseEntity.php';
class Category extends BaseEntity {
    public $id;
    public $name;

    public function __construct($id, $name, $created_at, $created_by) {
        parent::__construct($created_at, $created_by);
        $this->id = $id;
        $this->name = $name;
    }
}
