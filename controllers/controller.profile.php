<?php
    require("models/model.users.php");

    if(empty($_SESSION["user"]["user_id"])){
        http_response_code(401);

        $message= "Unauthorized, please login";
        $title= "Error";

        require("views/view.error.php");
        exit;
    }

    $modelUsers= new Users();
    $usernamesArray= $modelUsers-> getUsernames();

    foreach($usernamesArray as $username){
        $usernames[]= $username["username"];
    }

    $title= "Perfil";

    if(empty($url_parts[2])){
        
        require("views/view.profile.php");
        exit;
    }
    else if(isset($url_parts[2]) && $url_parts[2]==="edit"){

        if(
            isset($_POST["send"])
        ){
            if(empty($_POST["name"])){
                $_POST["name"]= $_SESSION["user"]["name"];
            }
            if(empty($_POST["username"])){
                $_POST["username"]= $_SESSION["user"]["username"];
            }
            if(empty($_POST["email"])){
                $_POST["email"]= $_SESSION["user"]["email"];
            }
            if(empty($_POST["phone"])){
                $_POST["phone"]= $_SESSION["user"]["phone"];
            }

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
                $_POST["photo"]= $_SESSION["user"]["photo"];
            }

            $_POST["username"]= strtolower(str_replace(' ', '', $_POST["username"]));

            if(
                filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)  &&
                mb_strlen($_POST["name"])>= 2   &&
                mb_strlen($_POST["name"])<= 60  &&
                mb_strlen($_POST["username"])>= 1   &&
                mb_strlen($_POST["username"])<= 30  &&
                mb_strlen($_POST["phone"])>= 9  &&
                mb_strlen($_POST["phone"])<= 30 &&
                mb_strlen($_POST["biografy"])<= 140
            ){
                if(
                    !in_array($_POST["username"], $usernames) || 
                    $_POST["username"]=== $_SESSION["user"]["username"]
                ){

                    $_POST["user_id"]= $_SESSION["user"]["user_id"];

                    $user= $modelUsers-> updateProfile($_POST);
                    
                    if(!empty($user)){
                        $_SESSION["user"]= $user;

                        header("Location: /profile");
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
                    $message= "Username Indisponível";
                }
            }
            else{
                $message= "Dados incorretos, confirme o preenchimento dos campos";
            }
        }

        require("views/view.profile_edit.php");
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