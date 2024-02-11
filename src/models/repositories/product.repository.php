<?php

require_once 'src/models/repositories/repositories.php';

class ProductRepository extends Repositories
{
    public function __construct($db)
    {
        parent::__construct($db, 'products');
    }
}