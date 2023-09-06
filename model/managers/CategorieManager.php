<?php

    namespace Model\Managers;

   

    use App\Manager;

    use App\DAO;

    // use Model\Managers\CategorieManager;

 

    class CategorieManager extends Manager{

 

        protected $className = "Model\Entities\Categorie";

        protected $tableName = "categorie";

 

 

        public function __construct(){

            parent::connect();

        }

        public function nbPostsManager($id){
            $sql = " SELECT COUNT(topic_id) AS nbPosts FROM post WHERE topic_id IN 
            ( SELECT id_topic FROM topic WHERE categorie_id = :id ) ";
            DAO::select($sql,['id'=>$id]);
        }

 

 

    }