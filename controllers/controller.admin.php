<?php
    if(empty($_SESSION["user"]["user_id"])){
        http_response_code(401);

        $message= "Unauthorized, please login";
        $title= "Error";

        require("views/view.error.php");
        exit;
    }

    if($_SESSION["user"]["isAdmin"]!= 1){
        http_response_code(403);

        $message= "Forbidden";
        $title= "Error";

        require("views/view.error.php");
        exit;
    }

    $title= "Admin";

    
    if(empty($url_parts[2])){
        
        require("views/admin/view.admin.php");
        exit;
    }
    else if(isset($url_parts[2]) && $url_parts[2]=== "news"){
        require("models/model.news.php");

        $modelNews= new News();
        $allNews= $modelNews-> getAllNews();

        $maxPage= round(count($allNews)/10, 0, PHP_ROUND_HALF_UP) +1;

        if(empty($page)){
            $news= $modelNews-> getTenNews();
        }
        else if(isset($page) && is_numeric($page) && $page> 0 && $page <=$maxPage){
            $news= $modelNews-> getNextAdminNews($page);
        }
        else if(isset($url_parts[3]) && $url_parts[3]=== "create"){
            require("models/model.categories.php");

            $modelCategories= new Categories();
            $categories= $modelCategories-> getAllCategories();

            if(isset($_POST["send"])) {

                if(
                    !empty($_POST["title"]) &&
                    !empty($_POST["summary"]) &&
                    !empty($_POST["message"]) &&
                    !empty($_POST["category"]) &&
                    mb_strlen($_POST["title"]) >= 3 &&
                    mb_strlen($_POST["title"]) <= 140 &&
                    isset($_FILES["image"]) &&
                    $_FILES["image"]["error"]=== 0 &&
                    ($_FILES["image"]["type"]=== "image/png" || 
                    $_FILES["image"]["type"]=== "image/jpeg") &&
                    $_FILES["image"]["size"] > 0 &&
                    $_FILES["image"]["size"] < 2 * 1024 * 1024
                ){
                    if($_FILES["image"]["type"]=== "image/png"){
                        $imagename= date("YmdHis")."_".mt_rand(10000000, 99999999).".png";
                    }
                    else{
                        $imagename= date("YmdHis")."_".mt_rand(10000000, 99999999).".jpeg";
                    }

                    move_uploaded_file($_FILES["image"]["tmp_name"], "images/news/".$imagename);

                    $_POST["image"]= "/images/news/".$imagename;

                    $news_id= $modelNews-> create($_POST);

                    if(isset($news_id)){
                        header("Location: /news/".$news_id);
                    }
                    else{
                        http_response_code(500);
    
                        $message= "Internal Server Error";
                        $title= "Error";
                    
                        require("views/view.error.php");
                        exit;
                    }
                    
                }
                else{
                    $message= "Dados incorretos, confirme o preenchimento dos campos";   
                }
            }

            require("views/admin/view.news_create.php");
            exit;
        }
        else{
            http_response_code(404);

            $message= "Invalid URL";
            $title= "Error";

            require("views/view.error.php");
            exit;
        }

        if(empty($news)){
            http_response_code(404);
        
            $message= "Not Found";
            $title= "Error";
        
            require("views/view.error.php");
            exit;
        }

        require("views/admin/view.news.php");
        exit;
    }
    else if(isset($url_parts[2]) && $url_parts[2]=== "categories"){
        require("models/model.categories.php");

        $modelCategories= new Categories();
        $categories= $modelCategories-> getAllCategories();

        if(isset($_POST["send"])){

            if(
                !empty($_POST["category_name"]) && 
                mb_strlen($_POST["category_name"]) >= 3 &&
                mb_strlen($_POST["category_name"]) <= 60
            ){
                $category_id= $modelCategories-> create($_POST);
                
                if(empty($category_id)){
                    http_response_code(500);

                    $message= "Internal Server Error";
                    $title= "Error";

                    require("views/view.error.php");
                    exit;
                }

                header("Location: /admin/categories");
            }
            else{
                $message= "O nome deve conter entre 3 e 60 carateres";
            }
        }

        if(isset($_POST["editCategory_id"])){
            if(
                !empty($_POST["category_name"]) && 
                mb_strlen($_POST["category_name"]) >= 3 &&
                mb_strlen($_POST["category_name"]) <= 60
            ){
                $category= $modelCategories-> update($_POST);

                if(empty($category)){
                    http_response_code(500);

                    $message= "Internal Server Error";
                    $title= "Error";

                    require("views/view.error.php");
                    exit;
                }

                header("Location: /admin/categories");
            }
            else{
                $message= "O nome deve conter entre 3 e 60 carateres";
            }
        }


        if(isset($_POST["removeCategory_id"])){
            $affectedCategory= $modelCategories-> delete($_POST);

            if(isset($affectedCategory)){
                http_response_code(200);

                $message= "Categoria removida com sucesso";
            }
            else{
                http_response_code(500);

                $message= "Internal Server Error";
                $title= "Error";

                require("views/view.error.php");
                exit;
            }

        }

        require("views/admin/view.categories.php");
        exit;
    }
    else if(isset($url_parts[2]) && $url_parts[2]=== "users"){
        require("models/model.users.php");

        $modelUsers= new Users();
        $users= $modelUsers-> getAllUsers();

        require("views/admin/view.users.php");
        exit;
    }
    else if(isset($url_parts[2]) && $url_parts[2]=== "comments"){
        require("models/model.comments.php");

        $modelComments= new Comments();
        $comments= $modelComments-> getAllComments();

        require("views/admin/view.comments.php");
        exit;
    }
    else{
        http_response_code(404);

        $message= "Invalid URL";
        $title= "Error";

        require("views/view.error.php");
        exit;
    }

?>