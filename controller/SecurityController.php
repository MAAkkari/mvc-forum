<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategorieManager;
    
    
    class ForumController extends AbstractController implements ControllerInterface{

        
        public function login(){
            $userManager = New UserManager; 

            if($_POST["submit"]){
                echo " recu ";
            }else{
                $view = VIEW_DIR."forum/login.php";
                header("Location:$view");
            } 



        }

        public function register(){

        }

        public function logout(){

        }

































    }