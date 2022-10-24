<?php
    require_once("models/model.base.php");

    class Comments extends Base{
        
        public function getAllComments(){
            $query= $this-> db-> prepare("
                
            ");

            $query-> execute();

            return $query-> fetchAll();
        }

        public function getNewsComments($id){
            $query= $this-> db-> prepare("
                SELECT
                    comments.comment_id, comments.user_id, comments.message, comments.post_date, users.photo, users.username
                FROM
                    comments
                INNER JOIN
                    users USING(user_id)
                WHERE
                    news_id= ?
                ORDER BY
                    post_date DESC
            ");

            $query-> execute([$id]);

            return $query-> fetchAll();
        }

        public function create($data){
            $data= $this-> sanitizer($data);

            $query= $this-> db-> prepare("
                INSERT INTO comments
                (user_id, message, news_id)
                VALUES(?, ?, ?)
            ");


            $query-> execute([
                $_SESSION["user"]["user_id"],
                $data["comment"],
                $data["news_id"]
            ]);

            return $this-> db-> lastInsertId();
        }
    }
?>