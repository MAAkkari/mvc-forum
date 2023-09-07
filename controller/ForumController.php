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
            $categs=$categorieManager->findAll(["nom", "ASC"]);
            $tabCategories=[];
            foreach($categs as $categorie){
                $info=$categorieManager->infoCategorie($categorie->getId());
                $tabCategories[$categorie->getId()] = $info;
            }

            return [

                "view" => VIEW_DIR."forum/listCategories.php",

                "data" => [

                    "categories" => $tabCategories
                    
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
            $data=['titre'=>$titre , 'categorie_id'=>$id , 'user_id'=>$_SESSION["user"]->getId()];
            $idTopic=$topicManager->Add($data);
            $dataPost=['text'=>$message , 'user_id'=>$_SESSION["user"]->getId() , 'topic_id'=>$idTopic];
            $postManager->add($dataPost);
            Session::addFlash("success","Ajout du Topic avec succes");
            $this->redirectTo("forum" , "listCategorieTopics",$id);
        }

        public function nvPost($id){
            $postManager = new PostManager();
            $text = filter_input(INPUT_POST,"text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $data =['text'=>$text , 'user_id'=>$_SESSION["user"]->getId() , 'topic_id'=>$id];
            $postManager->Add($data);
            Session::addFlash("success","Ajout du post avec succes");
            $this->redirectTo("forum" , "listTopicPosts", $id);
        }

        public function deleteTopic($id){
            $topicManager = new TopicManager();
            if ( $_SESSION["user"] !=null && $topicManager->findOneById($id)->MadeBy($_SESSION["user"]) ) {
                $topic = $topicManager->findOneById($id);
                $categorieId = $topic->getCategorie()->getId();
                $topicManager->delete($id);
                Session::addFlash("success","Suppression du topic reussi ! ");
                $this->redirectTo("forum" , "listCategorieTopics", $categorieId);
            } 
                else { Session::addFlash("error","Echec de la suppression ");
                        $this->redirectTo("forum" , "listCategories");}



        }

        public function deletePost($id){
            $postManager = new PostManager();
            if ( $_SESSION["user"] !=null && $postManager->findOneById($id)->MadeBy($_SESSION["user"]) ){
            $post = $postManager->findOneById($id);
            $topicId=$post->getTopic()->getId();
            $postManager->delete($id);
            Session::addFlash("success","Suppression reussi ! ");
            $this->redirectTo("forum","listTopicPosts", $topicId);
        } 
            else { Session::addFlash("error","Echec de la Suppression");
                $this->redirectTo("forum" , "listCategories"); }
        }
        

        public function editTopic($id){
            
            $topicManager = new TopicManager();
            if ( $_SESSION["user"] !=null && $topicManager->findOneById($id)->MadeBy($_SESSION["user"]) ) {
            $topicManager->editTopicManager($id);
            $topic = $topicManager->findOneById($id);
            $categorieId = $topic->getCategorie()->getId();
            Session::addFlash("success","Topic Modifier avec succes");
            $this->redirectTo("forum" , "listCategorieTopics", $categorieId); 
        } 
            else { Session::addFlash("error","Echec de la modification");
                 $this->redirectTo("forum" , "listCategories"); }
        }

        public function editPost($id){
            $postManager = new PostManager();
            if ( $_SESSION["user"] !=null && $postManager->findOneById($id)->MadeBy($_SESSION["user"]) ){
            $postManager->editPostManager($id);
            $post = $postManager -> findOneById($id);
            $topicId=$post->getTopic()->getId();
            Session::addFlash("success","Post Modifier avec succes");
            $this->redirectTo("forum" , "listTopicPosts", $topicId);
            } 
            else {  Session::addFlash("error","Echec de la modification du post");
                $this->redirectTo("forum" , "listCategories"); }
        }
        
        public function lock($id){
            $topicManager = new TopicManager();
            if ( $_SESSION["user"] !=null && $topicManager->findOneById($id)->MadeBy($_SESSION["user"]) ) {
                $categorieId=$topicManager->findOneById($id)->getCategorie()->getId();
                $topicManager->lockTopic($id);
                Session::addFlash("success","Verrouillage / Deverrouillage reussi");
                $this->redirectTo("forum" , "listCategorieTopics", $categorieId);
            }
            else {
                Session::addFlash("error","Verrouillage/Deverrouillage echoué");
                $this->redirectTo("forum" , "listCategories");
            }
        }

      
        

    }
