<?php
    class Base{
        public $db;

        public function __construct(){
            $this-> db= new PDO(
                "mysql:host=".ENV["DB_HOST"].";dbname=".ENV["DB_NAME"].";charset=utf8mb4",
                ENV["DB_USER"],
                ENV["DB_PASSWORD"]
            );

            $this-> db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $this-> db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->db->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
        }

        public function sanitizer($data){
            foreach($data as $key=> $value){

                if(is_array($value)){
                    $data[$key]= $this-> sanitizer($value);
                }
                else{
                    $data[$key]= htmlspecialchars(strip_tags(trim($value)));
                }
            }

            return $data;
        }

    }
?>