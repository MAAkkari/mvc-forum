<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";


        public function __construct(){
            parent::connect();
        }
        
        public function categorieTopics($id, $order = null){
            
            $orderQuery = ($order) ?                 
            "ORDER BY ".$order[0]. " ".$order[1] :
            "";
            $sql = "SELECT *
                    FROM ".$this->tableName." a
                    WHERE a.categorie_id =". $id 
                    ." ".$orderQuery;  
            
                    

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }
        public function newTopic($id){
            $titre = filter_input(INPUT_POST,"titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $message = filter_input(INPUT_POST,"message", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sql = "INSERT INTO topic (titre, fermer , categorie_id , user_id ) 
            VALUE ( '$titre', 0 , $id , 2 ) ;
            INSERT INTO post (text , user_id , topic_id )
            VALUE ( '$message' , 2 , select( id_topic from topic where titre=$titre ) ) " ; 
        }

       



    }