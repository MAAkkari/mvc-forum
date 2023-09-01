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
                "nomCategorie" => $categorieManager->findOneById($id),
                "AllCategories" => $categorieManager->findAll(["nom", "ASC"])
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
                "posts" => $postManager->topicPosts($id,["dateCreation", "ASC"])
                ]
            ];
        }

        public function nvTopic($id){
            $topicManager = new TopicManager();
            $postManager = new PostManager();
            $titre = filter_input(INPUT_POST,"titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $message = filter_input(INPUT_POST,"message", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $data=['titre'=>$titre , 'categorie_id'=>$id , 'user_id'=>2];
            $idTopic=$topicManager->Add($data);
            $dataPost=['text'=>$message , 'user_id'=>2 , 'topic_id'=>$idTopic];
            $postManager->add($dataPost);
            $this->redirectTo("forum" , "listCategorieTopics",$id);
        }

        public function nvPost($id){
            $postManager = new PostManager();
            $text = filter_input(INPUT_POST,"text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $data =['text'=>$text , 'user_id'=>2 , 'topic_id'=>$id];
            $postManager->Add($data);
            $this->redirectTo("forum" , "listTopicPosts", $id);
        }

        public function deleteTopic($id){
            $topicManager = new TopicManager();
            $topic = $topicManager->findOneById($id);
            $categorieId = $topic->getCategorie()->getId();
            $topicManager->delete($id);
            $this->redirectTo("forum" , "listCategorieTopics", $categorieId);
        }

        public function deletePost($id){
            $postManager = new PostManager();
            $post = $postManager->findOneById($id);
            $topicId=$post->getTopic()->getId();
            $postManager->delete($id);
            $this->redirectTo("forum","listTopicPosts", $topicId);
        }

        public function editTopic($id){
            $topicManager = new TopicManager();
            $topicManager->editTopicManager($id);
            $topic = $topicManager->findOneById($id);
            $categorieId = $topic->getCategorie()->getId();
            $this->redirectTo("forum" , "listCategorieTopics", $categorieId);
        }

        public function editPost($id){
            $postManager = new PostManager();
            $postManager->editPostManager($id);
            $post = $postManager -> findOneById($id);
            $topicId=$post->getTopic()->getId();
            $this->redirectTo("forum" , "listTopicPosts", $topicId);
        }
        

      
        

    }
