<?php
    namespace App\Controllers;

    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use App\Storage\Produto as StorageProduto;
    use App\JsonResponse;

    class PegarProdutoPorId {

        private StorageProduto $storage;

        public function __construct (StorageProduto $storage) {
            $this->storage = $storage;
        }

        function __invoke (Request $request, Response $response, array $args): Response {
           
            $idProduto = (int) $args["id"];
        
            try { 
                    $produto = $this->storage->pegarPorId($idProduto);

                    if (!$produto) if (!$produto) return JsonResponse::notFound($response);

                    return JsonResponse::Ok($response, $produto);
            } catch (\Exception $ex) {
                return JsonResponse::ServerError($response, ["erro" => $ex->getMessage()]);
            }

        }

    }