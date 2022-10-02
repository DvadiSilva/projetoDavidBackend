<?php
    require_once("models/model.base.php");

    class News extends Base{
        
        public function getAllNews(){
            $query= $this-> db-> prepare("
                SELECT
                    news_id, title, summary, post_date, image
                FROM
                    news
                ORDER BY
                    post_date DESC
            ");

            $query-> execute();

            return $query-> fetchAll();
        }
        
        public function getCategoryNews($id){
            $query= $this-> db-> prepare("
                SELECT
                    news_id, title, summary, post_date, image
                FROM
                    news
                WHERE
                    category_id= ?
                ORDER BY
                    post_date DESC
            ");

            $query-> execute([$id]);

            return $query-> fetchAll();
        }

        public function getSoloNews($id){
            $query= $this-> db-> prepare("
                SELECT
                    news_id, title, summary, message, post_date, image
                FROM
                    news
                WHERE
                    news_id= ?
            ");

            $query->execute([$id]);

            return $query-> fetch();
        }

        public function getSearchNews($data){
            $query= $this-> db-> prepare("
                SELECT 
                    news_id, title, summary, post_date, image
                FROM 
                    news 
                WHERE 
                    title LIKE ? OR 
                    summary LIKE ? OR 
                    message LIKE ? OR
                    post_date LIKE ?
                ORDER BY
                    post_date DESC
            ");

            $query-> execute([
                '%'.$data.'%',
                '%'.$data.'%',
                '%'.$data.'%',
                '%'.$data.'%'
            ]);

            return $query-> fetchAll();
        }
    }
?>