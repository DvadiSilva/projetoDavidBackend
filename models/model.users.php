<?php
    require_once("models/model.base.php");

    class Users extends Base{
        public function getAllUsers(){
            $query= $this-> db-> prepare("
                SELECT
                    user_id, name, username, email, phone, isSubscriber, isWriter, isAdmin
                FROM
                    users
            ");

            $query-> execute();

            return $query-> fetchAll();
        }

        public function getUser($data){
            $data= $this-> sanitizer($data);

            $query= $this-> db-> prepare("
                SELECT
                    user_id, name, username, email, phone, isSubscriber, isWriter, isAdmin
                FROM
                    users
                WHERE
                    user_id= ?
            ");

            $query-> execute([$data["editUser_id"]]);

            return $query-> fetch();
        }

        public function getUserPassword($data){
            $data= $this-> sanitizer($data);

            $query= $this-> db-> prepare("
                SELECT
                    password
                FROM
                    users
                WHERE
                    user_id= ?
            ");

            $query-> execute([$data["user_id"]]);

            return $query-> fetch();
        }

        public function create($data){
            $data= $this-> sanitizer($data);

            $query= $this-> db-> prepare("
                INSERT INTO users
                (name, username, email, password, phone, photo, isSubscriber, isWriter, isAdmin)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");

            $query-> execute([
                $data["name"],
                $data["username"],
                $data["email"],
                password_hash($data["password"], PASSWORD_DEFAULT),
                $data["phone"],
                $data["photo"],
                isset($data["isSubscriber"])? $data["isSubscriber"]: 0,
                isset($data["isWriter"])? $data["isWriter"]: 0,
                isset($data["isAdmin"])? $data["isAdmin"]: 0,
            ]);

            $lastCreatedUserId= $this-> db-> lastInsertId();

            $query= $this-> db-> prepare("
                SELECT 
                    user_id, name, username, email, phone, photo, biografy, isSubscriber, isWriter, isAdmin
                FROM 
                    users
                WHERE
                    user_id= ?
            ");

            $query-> execute([$lastCreatedUserId]);

            return $query-> fetch();
        }

        public function login($data){
            $data= $this-> sanitizer($data);

            $query= $this-> db-> prepare("
                SELECT 
                    user_id, name, username, email, password, phone, photo, biografy, isSubscriber, isWriter, isAdmin
                FROM 
                    users
                WHERE 
                    email= ?
            ");

            $query-> execute([
                $data["email"]
            ]);

            $user= $query-> fetch();

            if(!empty($user) && password_verify($data["password"], $user["password"])){
                    
                return $user;
            }

            return [];
        }

        public function updateProfile($data){
            $data= $this-> sanitizer($data);

            $query= $this-> db-> prepare("
                UPDATE 
                    users
                SET
                    name= ?, username= ?, email= ?, phone= ?, biografy= ?, photo= ?
                WHERE
                    user_id= ?
            ");

            $query-> execute([
                $data["name"],
                $data["username"],
                $data["email"],
                $data["phone"],
                $data["biografy"],
                $data["photo"],
                $data["user_id"],
            ]);

            $query= $this-> db-> prepare("
                SELECT 
                    user_id, name, username, email, password, phone, photo, biografy, isSubscriber, isWriter, isAdmin
                FROM 
                    users
                WHERE 
                    user_id= ?
            ");

            $query-> execute([
                $data["user_id"]
            ]);

            $user= $query-> fetch();

            return $user;
        }

        public function updatePassword($data){
            $data= $this-> sanitizer($data);

            $query= $this-> db-> prepare("
                UPDATE 
                    users
                SET
                    password= ?
                WHERE
                    user_id= ?
            ");

            $query-> execute([
                password_hash($data["newPassword"], PASSWORD_DEFAULT),
                $data["user_id"]
            ]);

            return $query-> rowCount();
        }

        public function delete($data){
            $data= $this-> sanitizer($data);

            $query= $this-> db-> prepare("
                DELETE FROM
                    users
                WHERE 
                    user_id= ?
            ");

            $query-> execute([
                $data["removeUser_id"]
            ]);

            return $query-> rowCount();
        }

        public function update($data){
            $data= $this-> sanitizer($data);

            $query= $this-> db-> prepare("
                UPDATE 
                    users
                SET
                    name= ?, username= ?, email= ?, phone= ?, isSubscriber= ?, isWriter= ?, isAdmin= ?
                WHERE
                    user_id= ?
            ");

            $query-> execute([
                $data["name"],
                $data["username"],
                $data["email"],
                $data["phone"],
                isset($data["isSubscriber"])? $data["isSubscriber"]: 0,
                isset($data["isWriter"])? $data["isWriter"]: 0,
                isset($data["isAdmin"])? $data["isAdmin"]: 0,
                $data["editUser_id"]
            ]);

            return $query-> rowCount();
        }
    }