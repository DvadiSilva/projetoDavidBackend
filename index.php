<?php

    define("ENV", parse_ini_file(".env"));

    define(
        "ROOT",
        rtrim(
            str_replace(
                "\\", "/", dirname($_SERVER["SCRIPT_NAME"])
            ),
            "/"
        )
    );

    $url_parts= explode("/", $_SERVER["REQUEST_URI"]);

    $controlers=[
        "home", "categories", "news"
    ];

    $controller= $url_parts[1] ?: "home";
    $id= $url_parts[2] ?? "";
    
    if(!in_array($controller, $controlers)){
        http_response_code(404);

        $message= "Invalid URL";
        $title= "Error";

        require("views/view.error.php");
        exit;
    }
    
    require("controllers/controller.".$controller.".php")
?>