<?php
    require("models/model.users.php");

    $modelUsers= new Users();
    $usernamesArray= $modelUsers-> getUsernames();

    foreach($usernamesArray as $username){
        $usernames[]= $username["username"];
    }

    $title= "Registo";

    session_unset();

    if(
        isset($_POST["send"])
    ){
        $_POST["username"]= strtolower(str_replace(' ', '', $_POST["username"]));
       
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
            mb_strlen($_POST["passwordRepeated"])<= 1000
        ){
            if(!in_array($_POST["username"], $usernames)){

                $user= $modelUsers-> create($_POST);
                
                if(!empty($user)){
                    $_SESSION["user"]= $user;
                    
                    require("welcomeEmail.php");
                    
                    if($_SESSION["user"]["isSubscriber"]== 1){
                        require("newsletterEmail.php");
                    }

                    header("Location: /");
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

    require("views/view.register.php");
?>