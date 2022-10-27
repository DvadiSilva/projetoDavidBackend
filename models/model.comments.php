<?php
    require_once("models/model.base.php");

    class Comments extends Base{
        
        public function getAllComments(){
            $query= $this-> db-> prepare("
                SELECT
                    comments.comment_id, comments.user_id, comments.message, comments.post_date, users.username, news.title
                FROM
                    comments
                INNER JOIN
                    users USING(user_id)
                INNER JOIN
                    news USING(news_id)
            ");

            $query-> execute();

            return $query-> fetchAll();
        }

        public function getTenComments(){
            $query= $this-> db-> prepare("
                SELECT
                    comments.comment_id, comments.user_id, comments.message, comments.post_date, users.username, news.title
                FROM
                    comments
                INNER JOIN
                    users USING(user_id)
                INNER JOIN
                    news USING(news_id)
                LIMIT
                    10
            ");

            $query-> execute();

            return $query-> fetchAll();
        }

        public function getNextComments($page){
            $currentPage= $page*10;

            $query= $this-> db-> prepare("
                SELECT
                    comments.comment_id, comments.user_id, comments.message, comments.post_date, users.username, news.title
                FROM
                    comments
                INNER JOIN
                    users USING(user_id)
                INNER JOIN
                    news USING(news_id)
                LIMIT
                    $currentPage, 10
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

        public function delete($data){
            $data= $this-> sanitizer($data);

            $query= $this-> db-> prepare("
                DELETE FROM
                    comments
                WHERE 
                    comment_id= ?
            ");

            $query-> execute([
                $data["removeComment_id"]
            ]);

            return $query-> rowCount();
        }
    }
?>