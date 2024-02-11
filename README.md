# php_api_crud_oo_template
api genérica em php com CRUD completo

### paginação
ao chamar o método getAll, você pode passar os parâmetros opcionais $page e $perPage para implementar a paginação. Por exemplo:

$productsController = new ProductsController(new ProductRepository($db));
$result = $productsController->getAll(2, 5);
echo json_encode($result);

// Pesquisar todos os produtos com categoryId = 1, na segunda página, 5 itens por página
$resultList = $productsController->getListByKey('categoryId', 1, 2, 5);
echo json_encode($resultList);

