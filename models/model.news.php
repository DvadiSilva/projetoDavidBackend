<?php
    require_once("models/model.base.php");

    class News extends Base{
        
        public function getAllNews(){
            $query= $this-> db-> prepare("
                SELECT
                    news.news_id, news.title, news.summary, news.post_date, news.image, news.category_id, categories.name
                FROM
                    news
                INNER JOIN
                    categories USING(category_id)
                ORDER BY
                    post_date DESC
            ");

            $query-> execute();

            return $query-> fetchAll();
        }

        public function getSoloNews($id){
            $query= $this-> db-> prepare("
                SELECT
                    news.news_id, news.title, news.summary, news.message, news.post_date, news.image, news.category_id, categories.name
                FROM
                    news
                INNER JOIN
                    categories USING(category_id)
                WHERE
                    news_id= ?
            ");

            $query->execute([$id]);

            return $query-> fetch();
        }

        //News Homepage
        public function getTenNews(){
            $query= $this-> db-> prepare("
                SELECT
                    news.news_id, news.title, news.summary, news.post_date, news.image, news.category_id, categories.name
                FROM
                    news
                INNER JOIN
                    categories USING(category_id)
                ORDER BY
                    post_date DESC
                LIMIT
                    10
            ");

            $query-> execute();

            return $query-> fetchAll();
        }

        public function getNextNews($id){
            $page= $id*10;

            $query= $this-> db-> prepare("
                SELECT
                    news_id, title, summary, post_date, image
                FROM
                    news
                ORDER BY
                    post_date DESC
                LIMIT
                    $page, 10
            ");


            $query-> execute([]);

            return $query-> fetchAll();
        }
        
        //News Categories
        public function getAllCategoryNews($id){
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

        public function getTenCategoryNews($id){
            $query= $this-> db-> prepare("
                SELECT
                    news_id, title, summary, post_date, image
                FROM
                    news
                WHERE
                    category_id= ?
                ORDER BY
                    post_date DESC
                LIMIT
                    10
            ");

            $query-> execute([$id]);

            return $query-> fetchAll();
        }

        public function getNextCategoryNews($id, $page){
            $currentPage= $page*10;

            $query= $this-> db-> prepare("
                SELECT
                    news_id, title, summary, post_date, image
                FROM
                    news
                WHERE
                    category_id= ?
                ORDER BY
                    post_date DESC
                LIMIT
                    $currentPage, 10
            ");

            $query-> execute([$id]);

            return $query-> fetchAll();
        }

        //News Search
        public function getSearchNews($data){
            $data= htmlspecialchars(strip_tags(trim($data)));

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
        
        //News Admin
        public function getNextAdminNews($page){
            $currentPage= $page*10;

            $query= $this-> db-> prepare("
                SELECT
                    news.news_id, news.title, news.summary, news.post_date, news.image, news.category_id, categories.name
                FROM
                    news
                INNER JOIN
                    categories USING(category_id)   
                ORDER BY
                    post_date DESC
                LIMIT
                    $currentPage, 10
            ");


            $query-> execute([]);

            return $query-> fetchAll();
        }

        //CRUD News
        public function create($data){
            $data= $this-> sanitizer($data);

            $query= $this-> db-> prepare("
                INSERT INTO news
                (title, summary, message, image, category_id)
                VALUES(?, ?, ?, ?, ?)
            ");


            $query-> execute([
                $data["title"],
                $data["summary"],
                $data["message"],
                $data["image"],
                $data["category"],
            ]);

            return $this-> db-> lastInsertId();
        }

        public function delete($data){
            $data= $this-> sanitizer($data);

            $query= $this-> db-> prepare("
                DELETE FROM
                    news
                WHERE 
                    news_id= ?
            ");

            $query-> execute([
                $data["removeNews_id"]
            ]);

            return $query-> rowCount();
        }

        public function update($data){
            $data= $this-> sanitizer($data);

            $query= $this-> db-> prepare("
                UPDATE 
                    news
                SET
                    title= ?, summary= ?, message= ?, image= ?, category_id= ?
                WHERE
                    news_id= ?
            ");

            $query-> execute([
                $data["title"],
                $data["summary"],
                $data["message"],
                $data["image"],
                $data["category_id"],
                $data["news_id"]
            ]);

            return $query-> rowCount();
        }
    }
?>