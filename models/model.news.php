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
    }
?>