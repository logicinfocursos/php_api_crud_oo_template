<?php
require_once 'src/controllers/products.controller.php';
require_once 'src/controllers/categories.controller.php';
require_once 'src/models/repositories/product.repository.php';
require_once 'src/models/repositories/category.repository.php';
require_once 'src/models/utils/database.php';

// Cria a conexão com o banco de dados
$db = Database::getConnection();

// Define o cabeçalho para JSON
header('Content-Type: application/json');

// Obtém a URL da requisição
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Rotas para ProductsController
$productsController = new ProductsController(new ProductRepository($db));
$categoriesController = new CategoriesController(new CategoryRepository($db));

// Tratar as rotas de Products
if (strpos($url, '/products') === 0) {
    handleRoutes($url, $productsController);
}

// Tratar as rotas de Categories
if (strpos($url, '/categories') === 0) {
    handleRoutes($url, $categoriesController);
}

function handleRoutes($url, $controller)
{
    $urlParts = explode('/', $url);

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            // Se houver um ID na URL, executa o getById
            if (isset($urlParts[2]) && is_numeric($urlParts[2])) {
                $id = $urlParts[2];
                echo json_encode($controller->getById($id));

            } elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET)) {
                // Se houver parâmetros de consulta, executa o getListByKey
                echo json_encode($controller->getListByKey($_GET));
            } 
            else {
                // Senão, executa o getAll
                echo json_encode($controller->getAll());
            }
            break;

        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);
            echo json_encode($controller->add($data));
            break;

        case 'PUT':
            $id = $urlParts[2];
            $data = json_decode(file_get_contents('php://input'), true);
            echo json_encode($controller->update($id, $data));
            break;

        case 'DELETE':
            $id = $urlParts[2];
            echo json_encode($controller->delete($id));
            break;
    }
}
