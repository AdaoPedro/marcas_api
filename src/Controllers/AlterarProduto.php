<?php
    namespace App\Controllers;

    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use App\Storage\Produto as StorageProduto;
    use App\JsonResponse;

    class AlterarProduto {

        public function __construct (private StorageProduto $storage) {}

        function __invoke (Request $request, Response $response, array $args): Response {
           
            $idProduto = $args["id"];

            $dados = (array) json_decode($request->getBody()->getContents());

            $nome = $dados["nome"];
            $preco = (float) $dados["preco"];
            $idCategoria = (int) $dados["id_categoria"];

            try {
                if (!$this->storage->pegarPorId($idProduto)) return JsonResponse::notFound($response);

                $this->storage->alterar($nome, $preco, $idCategoria, $idProduto);

                return JsonResponse::noContent($response);
            } catch (PDOException $ex) {
                return JsonResponse::ServerError($response, ["erro" => $ex->getMessage()]);
            }
            
        }



    }