<?php
    namespace App\Controllers;

    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use App\Storage\Produto as StorageProduto;
    use App\JsonResponse;
    
    class ExcluirProduto {

        private StorageProduto $storage;

        public function __construct (StorageProduto $storage) {
            $this->storage = $storage;
        }

        public function __invoke (Request $request, Response $response, array $args) {
            $idProduto = (int) $args["id"];

            try {

                if (!$this->storage->pegarPorId($idProduto)) return JsonResponse::notFound($response);
                
                $this->storage->excluir($idProduto);
               
                return JsonResponse::noContent($response);
          
            } catch (PDOException $ex) {
                return JsonResponse::ServerError($response, ["erro" => $ex->getMessage()]);
            }
            
    
        }

    }