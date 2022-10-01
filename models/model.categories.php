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
    }
?>