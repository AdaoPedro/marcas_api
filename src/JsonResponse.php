<?php
    namespace App;

    use Psr\Http\Message\ResponseInterface as Response;

    abstract class JsonResponse {

        static function ok (Response $response, array $dados = []) {
                $dados = json_encode($dados);

                $response->getBody()->write($dados);
                $response = $response->withHeader("Content-Type", "application/json")->withStatus(200);

                return $response;
        }

        static function serverError (Response $response, array $dados = []) {
            $dados = json_encode($dados);

            $response->getBody()->write($dados);
            $response = $response->withHeader("Content-Type", "application/json")->withStatus(500);

            return $response;
        }

        static function created (Response $response, array $dados = []) {
            $dados = json_encode($dados);

            $response->getBody()->write($dados);
            $response = $response->withHeader("Content-Type", "application/json")->withStatus(201);

            return $response;
        }

        static function noContent (Response $response) {
            $response = $response->withHeader("Content-Type", "application/json")->withStatus(204);

            return $response;
        }

        static function notFound (Response $response) {
            $response = $response->withHeader("Content-Type", "application/json")->withStatus(404);

            return $response;
        }

    }