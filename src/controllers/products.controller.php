<?php
require_once 'src/controllers/controllers.php';

class ProductsController extends Controllers
{
    public function __construct($repository)
    {
        parent::__construct($repository);
    }
}

