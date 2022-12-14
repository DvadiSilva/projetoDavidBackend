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
    elseif(isset($url_parts[2]) && $url_parts[2]=== "news"){
        require("models/model.news.php");

        $modelNews= new News();
        $allNews= $modelNews-> getAllNews();

        $maxPage= round(count($allNews)/10, 0, PHP_ROUND_HALF_UP) +1;

        if(empty($page)){
            $news= $modelNews-> getTenNews();

            if(isset($_POST["removeNews_id"])){
                if(!is_numeric($_POST["removeNews_id"])){
                    http_response_code(404);
        
                    $message= "Not Found";
                    $title= "Error";
                
                    require("views/view.error.php");
                    exit;
                }
                
                $removedNews= $modelNews-> delete($_POST);

                if(isset($removedNews)){
                    $message= "Notícia removida com sucesso";
                }
                else{
                    http_response_code(500);

                    $message= "Internal Server Error";
                    $title= "Error";

                    require("views/view.error.php");
                    exit;
                }
            }
        }
        elseif(isset($page) && is_numeric($page) && $page> 0 && $page <=$maxPage){
            $news= $modelNews-> getNextAdminNews($page);

            if(isset($_POST["removeNews_id"])){
                if(!is_numeric($_POST["removeNews_id"])){
                    http_response_code(404);
        
                    $message= "Not Found";
                    $title= "Error";
                
                    require("views/view.error.php");
                    exit;
                }
                
                $removedNews= $modelNews-> delete($_POST);

                if(isset($removedNews)){
                    $message= "Notícia removida com sucesso";
                }
                else{
                    http_response_code(500);

                    $message= "Internal Server Error";
                    $title= "Error";

                    require("views/view.error.php");
                    exit;
                }
            }
        }

        elseif(isset($url_parts[3]) && $url_parts[3]=== "create"){
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
        elseif(isset($url_parts[3]) && $url_parts[3]=== "edit"){
            require("models/model.categories.php");

            $modelCategories= new Categories();
            $categories= $modelCategories-> getAllCategories();

            $validIds= [];

            foreach($allNews as $news){
                $validIds[]= $news["news_id"];
            }
            
            if(empty($url_parts[4]) || !is_numeric($url_parts[4])){
                http_response_code(404);

                $message= "Invalid URL";
                $title= "Error";

                require("views/view.error.php");
                exit;
            }
            if(!in_array($url_parts[4], $validIds)){
                http_response_code(404);
        
                $message= "Not Found";
                $title= "Error";
            
                require("views/view.error.php");
                exit;
            }

            $news_id= $url_parts[4];
            $news= $modelNews-> getSoloNews($news_id);

            if(empty($news)){
                http_response_code(500);

                $message= "Internal Server Error";
                $title= "Error";

                require("views/view.error.php");
                exit;
            }

            if(
                isset($_POST["send"])
            ){
                if(
                    !empty($_POST["title"]) &&
                    !empty($_POST["summary"]) &&
                    !empty($_POST["message"]) &&
                    mb_strlen($_POST["title"])>=3 &&
                    mb_strlen($_POST["title"])<=140
                ){
                    if(empty($_POST["category_id"]) || !is_numeric($_POST["category_id"])){
                        $_POST["category_id"]= $news["category_id"];
                    }

                    if(
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

                    }
                    else{
                        $_POST["image"]= $news["image"];
                    }
                    $_POST["news_id"]= $news_id;
                    $updatedNews= $modelNews-> update($_POST);

                    if(isset($updatedNews)){
                        $message= "Noticia atualizada com sucesso";

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

            require("views/admin/view.news_edit.php");
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
    elseif(isset($url_parts[2]) && $url_parts[2]=== "categories"){
        require("models/model.categories.php");

        $modelCategories= new Categories();

        if(!empty($page) && !is_numeric($page)){
            http_response_code(404);
    
            $message= "Invalid URL";
            $title= "Error";
        
            require("views/view.error.php");
            exit;
        }

        $allCategories= $modelCategories-> getAllCategories();

        if(empty($allCategories)){
            http_response_code(404);
    
            $message= "Not Found";
            $title= "Error";
        
            require("views/view.error.php");
            exit;
        }

        $maxPage= round(count($allCategories)/10, 0, PHP_ROUND_HALF_UP) +1;

        if(empty($page) || $page== 0){
            $categories= $modelCategories-> getTenCategories();
        }
        elseif($page<= $maxPage){
            $categories= $modelCategories-> getNextCategories($page);
        }
        else{
            http_response_code(404);
    
            $message= "Invalid URL";
            $title= "Error";
        
            require("views/view.error.php");
            exit;
        }

        if(empty($categories)){
            http_response_code(404);
    
            $message= "Not Found";
            $title= "Error";
        
            require("views/view.error.php");
            exit;
        }

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
                if(!is_numeric($_POST["editCategory_id"])){
                    http_response_code(404);
        
                    $message= "Not Found";
                    $title= "Error";
                
                    require("views/view.error.php");
                    exit;
                }

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
            if(!is_numeric($_POST["removeCategory_id"])){
                http_response_code(404);
    
                $message= "Not Found";
                $title= "Error";
            
                require("views/view.error.php");
                exit;
            }
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
    elseif(isset($url_parts[2]) && $url_parts[2]=== "users"){
        require("models/model.users.php");

        $modelUsers= new Users();

        if(!empty($page) && !is_numeric($page) && $page!="create"){
            http_response_code(404);
    
            $message= "Invalid URL";
            $title= "Error";
        
            require("views/view.error.php");
            exit;
        }

        $allUsers= $modelUsers-> getAllUsers();

        if(empty($allUsers)){
            http_response_code(404);
    
            $message= "Not Found";
            $title= "Error";
        
            require("views/view.error.php");
            exit;
        }

        $maxPage= round(count($allUsers)/10, 0, PHP_ROUND_HALF_UP) +1;

        if(empty($page) || $page== 0){
            $users= $modelUsers-> getTenUsers();
        }
        elseif($page<= $maxPage){
            $users= $modelUsers-> getNextUsers($page);
        }
        else{
            http_response_code(404);
    
            $message= "Invalid URL";
            $title= "Error";
        
            require("views/view.error.php");
            exit;
        }

        if(empty($users)){
            http_response_code(404);
    
            $message= "Not Found";
            $title= "Error";
        
            require("views/view.error.php");
            exit;
        }

        $usernames= [];
        $emails= [];

        foreach($users as $user){
            $usernames[]= $user["username"];
            $emails[]= $user["email"];
        }

        if(
            isset($_POST["editUser_id"])
        ){
            if(!is_numeric($_POST["editUser_id"])){
                http_response_code(404);
    
                $message= "Not Found";
                $title= "Error";
            
                require("views/view.error.php");
                exit;
            }
            $user= $modelUsers-> getUser($_POST);
            
            if(!isset($_POST["isSubscriber"])){
                $_POST["isSubscriber"]= $user["isSubscriber"];
            }
            if(!isset($_POST["isWriter"])){
                $_POST["isWriter"]= $user["isWriter"];
            }
            if(!isset($_POST["isAdmin"])){
                $_POST["isAdmin"]= $user["isAdmin"];
            }

            if(
                !empty($_POST["name"]) &&
                !empty($_POST["username"]) &&
                !empty($_POST["email"]) &&
                !empty($_POST["phone"]) &&
                filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)  &&
                mb_strlen($_POST["name"])>= 2   &&
                mb_strlen($_POST["name"])<= 60  &&
                mb_strlen($_POST["username"])>= 1   &&
                mb_strlen($_POST["username"])<= 30  &&
                mb_strlen($_POST["phone"])>= 9  &&
                mb_strlen($_POST["phone"])<= 30 &&
                ($_POST["isSubscriber"]== 0 || $_POST["isSubscriber"]== 1) &&
                ($_POST["isWriter"]== 0 || $_POST["isWriter"]== 1) &&
                ($_POST["isAdmin"]== 0 || $_POST["isAdmin"]== 1)
            ){

                $_POST["username"]= strtolower(str_replace(' ', '', $_POST["username"]));

                if(
                    !in_array($_POST["username"], $usernames) || 
                    $_POST["username"]=== $user["username"]
                ){
                    if(
                        !in_array($_POST["email"], $emails) || 
                        $_POST["email"]=== $user["email"]
                    ){
                        $updatedUser= $modelUsers-> update($_POST);

                        if(isset($updatedUser)){
                            $message= "Utilizador atualizado com sucesso";

                            header("Location: /admin/users");
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
                        $message= "Email Indisponível";
                    }
                }
                else{
                    $message= "Username Indisponível";
                }
            }
            else{
                $message= "Dados incorretos, confirme o preenchimento dos campos";
            }

        }

        if(isset($_POST["removeUser_id"])){
            if(!is_numeric($_POST["removeUser_id"])){
                http_response_code(404);
    
                $message= "Not Found";
                $title= "Error";
            
                require("views/view.error.php");
                exit;
            }
            
            $affectedUser= $modelUsers-> delete($_POST);

            if(isset($affectedUser)){
                http_response_code(200);

                $message= "Utilizador removido com sucesso";
            }
            else{
                http_response_code(500);

                $message= "Internal Server Error";
                $title= "Error";

                require("views/view.error.php");
                exit;
            }

        }

        if(isset($_POST["searchUser"])){
            if(
                mb_strlen($_POST["searchUser"])>= 1   &&
                mb_strlen($_POST["searchUser"])<= 30
            ){
                $users= $modelUsers-> search($_POST["searchUser"]);

                if(empty($users)){
                    http_response_code(404);
                
                    $message= "No results for search";
                    $title= "Error";
                
                    require("views/view.error.php");
                    exit;
                }
            }
            else{
                http_response_code(400);
                
                $message= "Please fill the fields";
                $title= "Error";
            
                require("views/view.error.php");
                exit;
            }
        }

        if(isset($url_parts[3]) && $url_parts[3]=== "create"){
            
            if(isset($_POST["send"])){
                       
                if(
                    filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)  &&
                    $_POST["password"]=== $_POST["passwordRepeated"]    &&
                    !empty($_POST["name"])&&
                    !empty($_POST["username"])&&
                    !empty($_POST["email"])&&
                    !empty($_POST["phone"])&&
                    !empty($_POST["passwordRepeated"])&&
                    !empty($_POST["password"])&&
                    mb_strlen($_POST["name"])>= 2   &&
                    mb_strlen($_POST["name"])<= 60  &&
                    mb_strlen($_POST["username"])>= 1   &&
                    mb_strlen($_POST["username"])<= 30  &&
                    mb_strlen($_POST["phone"])>= 9  &&
                    mb_strlen($_POST["phone"])<= 30 &&
                    mb_strlen($_POST["password"])>= 8   &&
                    mb_strlen($_POST["password"])<= 1000    &&
                    mb_strlen($_POST["passwordRepeated"])>= 8   &&
                    mb_strlen($_POST["passwordRepeated"])<= 1000    &&
                    ($_POST["isSubscriber"]== 0 || $_POST["isSubscriber"]== 1) &&
                    ($_POST["isWriter"]== 0 || $_POST["isWriter"]== 1) &&
                    ($_POST["isAdmin"]== 0 || $_POST["isAdmin"]== 1)
                ){
                   $_POST["username"]= strtolower(str_replace(' ', '', $_POST["username"]));

                   if(
                        isset($_FILES["photo"]) &&
                        $_FILES["photo"]["error"]=== 0 &&
                        ($_FILES["photo"]["type"]=== "image/png" || 
                        $_FILES["photo"]["type"]=== "image/jpeg") &&
                        $_FILES["photo"]["size"] > 0 &&
                        $_FILES["photo"]["size"] < 2 * 1024 * 1024
                    ){
                        if($_FILES["photo"]["type"]=== "image/png"){
                            $photoname= date("YmdHis")."_".mt_rand(10000000, 99999999).".png";
                        }
                        else{
                            $photoname= date("YmdHis")."_".mt_rand(10000000, 99999999).".jpeg";
                        }
        
                        move_uploaded_file($_FILES["photo"]["tmp_name"], "images/profile_photos/".$photoname);
        
                        $_POST["photo"]= "/images/profile_photos/".$photoname;
                    }
                    else{
                        $_POST["photo"]= "/images/defaultUserPic.png";
                    }
                   
                    if(!in_array($_POST["username"], $usernames)){
                        
                        if(!in_array($_POST["email"], $emails)){

                            $user= $modelUsers-> create($_POST);
                            
                            if(!empty($user)){
                                $message= "Utilizador criado com sucesso";
                                
                                require("welcomeEmail.php");
                                
                                if($user["isSubscriber"]== 1){
                                    require("newsletterEmail.php");
                                }

                                header("Location: /admin/users");
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
                            $message= "Email Indisponível";
                        }
                    }
                    else{
                        $message= "Username Indisponível";
                    }
                }
                else{
                    $message= "Dados incorretos, confirme o preenchimento dos campos";
                }
            }

            require("views/admin/view.users_create.php");
            exit;
        }


        require("views/admin/view.users.php");
        exit;
    }
    elseif(isset($url_parts[2]) && $url_parts[2]=== "comments"){
        require("models/model.comments.php");

        $modelComments= new Comments();

        if(!empty($page) && !is_numeric($page)){
            http_response_code(404);
    
            $message= "Invalid URL";
            $title= "Error";
        
            require("views/view.error.php");
            exit;
        }

        $allComments= $modelComments-> getAllComments();

        if(empty($allComments)){
            http_response_code(404);
    
            $message= "Not Found";
            $title= "Error";
        
            require("views/view.error.php");
            exit;
        }

        $maxPage= round(count($allComments)/10, 0, PHP_ROUND_HALF_UP) +1;

        if(empty($page) || $page== 0){
            $comments= $modelComments-> getTenComments();
        }
        elseif($page<= $maxPage){
            $comments= $modelComments-> getNextComments($page);
        }
        else{
            http_response_code(404);
    
            $message= "Invalid URL";
            $title= "Error";
        
            require("views/view.error.php");
            exit;
        }

        if(empty($comments)){
            http_response_code(404);
    
            $message= "Not Found";
            $title= "Error";
        
            require("views/view.error.php");
            exit;
        }

        if(isset($_POST["removeComment_id"])){
            if(!is_numeric($_POST["removeComment_id"])){
                http_response_code(404);
    
                $message= "Not Found";
                $title= "Error";
            
                require("views/view.error.php");
                exit;
            }
            
            $removedComment= $modelComments-> delete($_POST);

            if(isset($removedComment)){
                $message= "Comentário removido com sucesso";
            }
            else{
                http_response_code(500);

                $message= "Internal Server Error";
                $title= "Error";

                require("views/view.error.php");
                exit;
            }
        }

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