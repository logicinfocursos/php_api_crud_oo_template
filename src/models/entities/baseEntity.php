<?php
class BaseEntity {
    protected $created_at;
    protected $created_by;

    public function __construct($created_at, $created_by) {
        $this->created_at = $created_at;
        $this->created_by = $created_by;
    }
}
