<?php
    namespace App\Controllers;

    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use App\Storage\Produto as StorageProduto;
    use App\JsonResponse;
    use App\Uploader;

    class InserirProduto {

        public function __construct (private StorageProduto $storage, private Uploader $uploader) {}

        function __invoke (Request $request, Response $response): Response {
            
            $urlDaImagem = $this->uploader->upload($request);

            $dados = $request->getParsedBody();

            $nome = $dados["nome"];
            $preco = (float) $dados["preco"];
            $idCategoria = (int) $dados["id_categoria"];

            try { 
                
                $idProduto = $this->storage->inserir($nome, $preco, $idCategoria, $urlDaImagem);

                return JsonResponse::created($response, ["id_produto" => $idProduto]);
                
            } catch (PDOException $ex) {
                return JsonResponse::ServerError($response, ["erro" => $ex->getMessage()]);
            }
            
        }

    }