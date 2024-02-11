<?php

require_once 'src/models/repositories/repositories.php';

class CategoryRepository extends Repositories
{
    public function __construct($db)
    {
        parent::__construct($db, 'categories');
    }
}