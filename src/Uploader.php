<?php
    namespace App;

    use Psr\Http\Message\ServerRequestInterface as Request;

    final class Uploader {
        public function __construct ( private string $diretorio ) {}

        public function upload (Request $request) {
            $imagem = $request->getUploadedFiles()["imagem"];
            
            if ($imagem->getError()) {
                throw new \Exception("Erro no arquivo");
            }
          
            $config = require __DIR__ . "/../config.php";
            $nomeFicheiro = uniqid("prod") . "." . str_replace("image/", "", $imagem->getClientMediaType());
            $diretorio = $this->diretorio . "/" . $nomeFicheiro;

            file_put_contents($diretorio, $imagem->getStream());

            return $nomeFicheiro;
        }
    }