<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class PostManager extends Manager{

        protected $className = "Model\Entities\Post";
        protected $tableName = "post";


        public function __construct(){
            parent::connect();
        }
        
        public function topicPosts($id , $order = null){

            $orderQuery = ($order) ?                 
            "ORDER BY ".$order[0]. " ".$order[1] :
            "";

            $sql = "SELECT *
            FROM ".$this->tableName." a 
            WHERE a.topic_id=". $id ." ". $orderQuery; 

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
            
        }
        public function newPost($id){
            $text = filter_input(INPUT_POST,"text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sql = "INSERT INTO post (text , user_id , topic_id )
            VALUE ('$text', 2 , $id) " ; 
        }

    }