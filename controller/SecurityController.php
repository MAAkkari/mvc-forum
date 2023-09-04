<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategorieManager;
    use Model\Managers\UserManager;
    
    
    class SecurityController extends AbstractController implements ControllerInterface{

        
        public function login(){
            
            $userManager = New UserManager(); 

            if(isset($_POST["submit"])){
                
            }else{
                return[
                "view"=> VIEW_DIR."forum/login.php"
                ];
            }

        }

        public function register(){
            $userManager= new UserManager();
            if(isset($_POST["submit"])){

                $email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, 
                FILTER_VALIDATE_EMAIL);
                $pseudo = filter_input(INPUT_POST,"pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $pass1 = filter_input(INPUT_POST,"mdp", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $pass2 = filter_input(INPUT_POST,"mdp2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if ( $pass1 == $pass2 && strlen($pass1)>=8){
                    $passVerif =true;
                } else {
                    // message d erreur password different 
                }

                var_dump( $userManager->findOneByMail($email) );die;

                if ( $email && $pseudo && $passVerif && !$userManager->findOneByMail($email) &&
                    !$userManager->findOneByPseudo($pseudo)){
                    $mdp = password_hash($pass1, PASSWORD_DEFAULT);
                    var_dump($mdp);
                    $sql ="INSERT INTO user (pseudo , mdp , email , role) 
                    VALUES (':pseudo' , ':mdp' , ':email' , ':role')";
                    DAO::select($sql, ['pseudo'=> $pseudo , 'mdp'=>$mdp , 'email'=>$email , 'role'=>0]);
                }
            }
            else{
                return[
                "view"=> VIEW_DIR."forum/register.php"
                ];
            }

                
                
        }












        public function logout(){

        }
    }

































    