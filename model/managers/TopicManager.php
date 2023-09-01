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

        public function editTopicManager($id){
            $titre = filter_input(INPUT_POST,"titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fermer = filter_input(INPUT_POST,"fermer", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $categorieId= filter_input(INPUT_POST,"categorie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          

            $sql = ("UPDATE topic SET 
                    titre = '$titre' , 
                    fermer = $fermer,
                    categorie_id = $categorieId
                    WHERE id_topic = $id");
            
           
            DAO::select($sql);     
            
        }



    }