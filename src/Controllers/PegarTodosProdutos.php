<?php
    namespace App\Controllers;

    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use App\Storage\Produto as StorageProduto;
    use App\JsonResponse;

    class PegarTodosProdutos {

        private StorageProduto $storage;

        public function __construct (StorageProduto $storage) {
            $this->storage = $storage;
        }

        function __invoke (Request $request, Response $response): Response {
            try {
                $produtos = $this->storage->pegarTodos();

                return JsonResponse::Ok($response, $produtos);
            } catch (\Exception $ex) {
                return JsonResponse::ServerError($response, ["erro" => $ex->getMessage()]);
            }

        }

    }