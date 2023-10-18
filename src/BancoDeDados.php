<?php
    namespace App;

    use PDO;
    use PDOException;
    use PDOStatement;

    abstract class BancoDeDados {

        static function abrirConeccao() {

            $config = require(__DIR__ . "/../config.php");

            $servidor = $config["servidor"];
            $bancoDeDados = $config["banco_de_dados"];
            $usuario = $config["usuario"];
            $palavraPasse = $config["palavra_passe"];

            $dataSourceName = "mysql:host=$servidor;dbname=$bancoDeDados;charset=UTF8";

            return new PDO($dataSourceName, $usuario, $palavraPasse);
        }
    }