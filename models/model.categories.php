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
    }
?>