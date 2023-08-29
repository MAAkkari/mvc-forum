<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategorieManager;
    
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){
           $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                "topics" => $topicManager->findAll(["dateCreation", "DESC"])
                ]
            ];
        }


        public function listCategories(){

 

            // On récupère les catégories et on les envoie à la vue

            $categorieManager = new CategorieManager();

 

            return [

                "view" => VIEW_DIR."forum/listCategories.php",

                "data" => [

                    "categories" => $categorieManager->findAll(["nom", "ASC"])

                ]

            ];

 

        }
        public function listCategorieTopics($id){
            $topicManager = new TopicManager();
            $categorieManager = new CategorieManager();

            return [
                "view" => VIEW_DIR."forum/categorieTopics.php",
                "data" => [
                "topics" => $topicManager->categorieTopics($id,["dateCreation", "DESC"]),
                "nomCategorie" => $categorieManager->findOneById($id)
                ]
            ];
        }

        public function listTopicPosts($id){
            $postManager = new PostManager();
            $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/topicPosts.php",
                "data" => [
                "topic" => $topicManager->findOneById($id),
                "posts" => $postManager->topicPosts($id,["dateCreation", "DESC"])
                ]
            ];
        }

      
        

    }
