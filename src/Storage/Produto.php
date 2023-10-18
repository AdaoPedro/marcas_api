<?php
    namespace App\Storage;

    use PDO;

    class Produto {

        private PDO $bd;

        public function __construct (PDO $bd) {
            $this->bd = $bd;
        }

        public function pegarTodos () {
            $sql = "
                SELECT
                    produtos.id_produto, produtos.nome AS nome_produto, produtos.preco, produtos.descricao, produtos.url_image, categorias.nome AS categoria, produtos.data_criacao
                FROM
                    produtos INNER JOIN categorias
                ON
                    produtos.id_categoria = categorias.id_categoria
                ORDER BY
                    produtos.id_produto
            ";

            $pdoStatement = $this->bd->query($sql);
            $produtos = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

            return $produtos;
        }

        public function pegarPorId (int $idProduto) {
            $sql = "
                SELECT
                    produtos.id_produto, produtos.nome AS nome_produto,produtos.preco, produtos.descricao, produtos.url_image, categorias.nome AS categoria, produtos.data_criacao 
                FROM
                    produtos
                INNER JOIN
                    categorias ON produtos.id_categoria = categorias.id_categoria
                WHERE
                    produtos.id_produto = :id_produto
            ";

            $pdoStatement = $this->bd->prepare($sql);
            $pdoStatement->bindParam("id_produto", $idProduto);
            $pdoStatement->execute();

            $produto = $pdoStatement->fetch(PDO::FETCH_ASSOC);

            return $produto;
        }

        public function inserir (string $nome, float $preco, int $idCategoria, string $urlDaImagem) {
            $sql = "
                INSERT INTO
                    produtos (nome, preco, url_image, id_categoria)
                VALUES
                    (:nome, :preco, :url_image, :id_categoria)
                ";

            $pdoStatement = $this->bd->prepare($sql);
            $pdoStatement->bindParam("nome", $nome);
            $pdoStatement->bindParam("preco", $preco);
            $pdoStatement->bindParam("url_image", $urlDaImagem);
            $pdoStatement->bindParam("id_categoria", $idCategoria);
            $pdoStatement->execute();

            return $this->bd->lastInsertId();
        }

        public function alterar (string $nome, float $preco, int $idCategoria, int $idProduto) {
            $sql = "
            UPDATE
                produtos
            SET
                nome = :nome, preco = :preco, id_categoria = :id_categoria
            WHERE 
                id_produto = :id_produto
            ";

            $pdoStatement = $this->bd->prepare($sql);
            $pdoStatement->bindParam("nome", $nome);
            $pdoStatement->bindParam("preco", $preco);
            $pdoStatement->bindParam("id_categoria", $idCategoria);
            $pdoStatement->bindParam("id_produto", $idProduto);
            $pdoStatement->execute();
        }

        public function excluir (int $idProduto) {
            $sql = "
                        DELETE FROM
                            produtos
                        WHERE 
                            id_produto = :id_produto
                        ";
    
            $pdoStatement = $this->bd->prepare($sql);
            $pdoStatement->bindParam("id_produto", $idProduto);
            $pdoStatement->execute();
        }

    }