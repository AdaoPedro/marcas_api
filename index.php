<?php
    use Slim\Factory\AppFactory;

    use App\Controllers\{
        PegarTodosProdutos,
        PegarProdutoPorId,
        InserirProduto,
        AlterarProduto,
        ExcluirProduto,
        PegarImagemProduto
    };

    use App\BancoDeDados;
    use App\Uploader;

    use App\Storage\Produto as StorageProduto;

    require __DIR__ . "/vendor/autoload.php";

    //inicializar a aplicacao slim
    $app = AppFactory::create();


    //CORS
    $app->add(new Tuupola\Middleware\CorsMiddleware);

    //For running with Apache. In addition, we must set the .htaccess file
    $app->setBasePath("/marcas-api/v2");
    
    $app->addErrorMiddleware(true, true, true);

    $config = require __DIR__ . "/config.php";
    $upload = new Uploader($config["diretorio_uploads"]);

    $diretorioUploads = __DIR__ . DIRECTORY_SEPARATOR . "uploads";
    
    $bd = BancoDeDados::abrirConeccao();

    $storageProduto = new StorageProduto($bd);

    //definir endpoints
    #GET /produtos
    $app->get("/produtos", new PegarTodosProdutos($storageProduto));

    #GET /produtos/{id}
    $app->get("/produtos/{id:[0-9]+}", new PegarProdutoPorId($storageProduto));

    #POST /produtos
    $app->post("/produtos", new InserirProduto($storageProduto, $upload));

    #PUT /produtos/{id}
    $app->put("/produtos/{id:[0-9]+}", new AlterarProduto($storageProduto));

    #DELETE /produtos/{id}
    $app->delete("/produtos/{id:[0-9]+}", new ExcluirProduto($storageProduto));

    #GET /produtos/{id}/imagem
    //$app->get("/produtos/{id}/imagem", new PegarImagemProduto($storageProduto));

    #GET /uploads/{filename:.*\.\w+}
    $app->get("/static-files/{nome_ficheiro:.*\.\w+}", new PegarImagemProduto($storageProduto, $diretorioUploads));

    //executar a aplicacao
    $app->run();

