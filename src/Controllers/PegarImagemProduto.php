<?php
    namespace App\Controllers;

    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use App\Storage\Produto as StorageProduto;
    use App\JsonResponse;

    class PegarImagemProduto {

        public function __construct (private StorageProduto $storage, private string $diretorioUploads) {}

        function __invoke (Request $request, Response $response, array $args): Response {
           
            $nomeFicheiro = $args["nome_ficheiro"];
        
            try { 

                $diretorioImagem = $this->diretorioUploads . DIRECTORY_SEPARATOR . $nomeFicheiro;

                if (
                    !file_exists($diretorioImagem)
                ) {
                    return JsonResponse::notFound($response);
                }

                $extensaoImagem = explode(".", $nomeFicheiro)[1];
                $tipoMidia = "image/$extensaoImagem";

                $imagem = file_get_contents($diretorioImagem);

                $response->getBody()->write($imagem);

                return $response->withHeader("Content-Type", $tipoMidia);
            } catch (\Exception $ex) {
                return JsonResponse::ServerError($response, ["erro" => $ex->getMessage()]);
            }

        }

    }