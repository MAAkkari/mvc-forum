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

        public function infoCategorie($id){
            $sql = "SELECT  categorie.nom , id_categorie,
                        (SELECT COUNT(post.topic_id)  FROM post WHERE post.topic_id IN ( SELECT topic.id_topic FROM topic WHERE topic.categorie_id = $id ) ) AS nbPosts  ,
                        (SELECT COUNT(topic.categorie_id) FROM topic WHERE topic.categorie_id= $id) AS nbTopics ,
                        (SELECT topic.dateCreation   FROM topic ORDER BY topic.dateCreation DESC LIMIT 1) AS lastPostDate FROM categorie 
                    INNER JOIN topic ON topic.categorie_id = categorie.id_categorie
                    INNER JOIN post ON post.topic_id = topic.id_topic 
                    WHERE categorie.id_categorie= $id
                    GROUP BY categorie.id_categorie" ;
            DAO::select($sql);
        }

 

 

    }