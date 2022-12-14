<?php
    require_once("models/model.base.php");

    class Categories extends Base{
        
        public function getAllCategories(){
            $query= $this-> db-> prepare("
                SELECT
                    category_id, name
                FROM
                    categories
            ");

            $query-> execute();

            return $query-> fetchAll();
        }

        public function getTenCategories(){
            $query= $this-> db-> prepare("
                SELECT
                    category_id, name
                FROM
                    categories
                LIMIT
                    10
            ");

            $query-> execute();

            return $query-> fetchAll();
        }

        public function getNextCategories($page){
            $currentPage= $page*10;

            $query= $this-> db-> prepare("
                SELECT
                    category_id, name
                FROM
                    categories
                LIMIT
                    $currentPage, 10
            ");

            $query-> execute();

            return $query-> fetchAll();
        }

        public function getCategory($id){
            $query= $this-> db-> prepare("
                SELECT
                    category_id, name
                FROM
                    categories
                WHERE
                    category_id= ?
            ");

            $query-> execute([$id]);

            return $query->fetch();
        }

        public function create($data){
            $data= $this-> sanitizer($data);

            $query= $this-> db-> prepare("
                INSERT INTO categories
                (name)
                VALUES(?)
            ");


            $query-> execute([
                $data["category_name"]
            ]);

            return $this-> db-> lastInsertId();
        }

        public function delete($data){
            $data= $this-> sanitizer($data);

            $query= $this-> db-> prepare("
                DELETE FROM
                    categories
                WHERE 
                    category_id= ?
            ");

            $query-> execute([
                $data["removeCategory_id"]
            ]);

            return $query-> rowCount();
        }

        public function update($data){
            $data= $this-> sanitizer($data);

            $query= $this-> db-> prepare("
                UPDATE 
                    categories
                SET
                    name= ?
                WHERE
                    category_id= ?
            ");

            $query-> execute([
                $data["category_name"],
                $data["editCategory_id"],
            ]);

            $query= $this-> db-> prepare("
                SELECT
                    category_id, name
                FROM
                    categories
                WHERE
                    category_id= ?
            ");

            $query-> execute([
                $data["editCategory_id"]
            ]);

            $category= $query-> fetch();

            return $category;
        }
    }
?>