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
                $email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, 
                FILTER_VALIDATE_EMAIL);
                $pass1 = filter_input(INPUT_POST,"mdp", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $userAccount=$userManager->findOneByMail($email);
                if($userAccount != null ){
                    $hash = $userAccount->getMdp();
                    $passVerif = password_verify($pass1,$hash);
                }else ( 
                    $passVerif = false
                );

                if( $email && $passVerif ){
                    Session::setUser($userAccount);
                    Session::addFlash("message","bienvenue $userAccount");
                    $this->redirectTo("forum" , "listCategories");

                } else {
                    switch(true){
                        case (!$email): Session::addFlash("error","veillez saisir un Email Valide");break;
                        case ($userManager->findOneByMail($email)==Null): Session::addFlash("error","Email inexistant");break; 
                        case ($passVerif == false): Session::addFlash("error","Information incorrectes");break; 
                        
                    } 
                    return[
                        "view"=> VIEW_DIR."forum/login.php"
                    ];
                }

        }
        return[
            "view"=> VIEW_DIR."forum/login.php"
        ];}

        public function register(){
            $userManager= new UserManager();
            $msg ="";
            $categ="";
            if(isset($_POST["submit"])){

                $email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, 
                FILTER_VALIDATE_EMAIL);
                $pseudo = filter_input(INPUT_POST,"pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $pass1 = filter_input(INPUT_POST,"mdp", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $pass2 = filter_input(INPUT_POST,"mdp2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
               
             
                if ( $email && $pseudo && !$userManager->findOneByMail($email) &&
                    !$userManager->findOneByPseudo($pseudo) && $pass1 == $pass2 && strlen($pass1)>=8 ){
                    $mdp = password_hash($pass1, PASSWORD_DEFAULT);
                    $dataUser = ['pseudo' => $pseudo, 'email' => $email, 'mdp' => $mdp , 'role'=>'ROLE_USER'];
                    $userManager->add($dataUser);
                    Session::addFlash("success","inscription reussi");
                    $this->redirectTo("security" , "login");
                }
                else {
                    switch(true){
                        case (!$email): Session::addFlash("error","email non accepter");break;
                        case (!$pseudo): Session::addFlash("error","pseudo non accepter");break;
                        case ($userManager->findOneByMail($email) !=NULL): Session::addFlash("error","email deja utiliser");break;
                        case ($userManager->findOneByPseudo($pseudo) !=NULL): Session::addFlash("error","pseudo deja utiliser");break;
                        case ($pass1 != $pass2): Session::addFlash("error","mot de passes differents");break;
                        case (strlen($pass1)>=8): Session::addFlash("error","mot de passe trop court");break;
                    }
                   
                }
            }
           
            return[
            "view"=> VIEW_DIR."forum/register.php"
            ];     
        }

        public function logout(){
            
            $_SESSION["user"]=[];
            Session::addFlash("message","deconnexion");

            $this->redirectTo("forum" , "listCategories");
        }

        public function profile($id){
            $userManager = new UserManager;
            $topicManager = new TopicManager ; 
            $postManager = new PostManager; 
            
            $user = $userManager->findOneById($id);
            $postManager->findAllByUser($id);
            
            return[

                "view"=> VIEW_DIR."forum/profile.php" ,
                "data" => [
                    "user"=> $user,
                    "posts"=> $postManager->findAllByUser($id),
                    "topics"=> $topicManager->findAllByUser($id)
                ]
            ];
               
                
        }
    }

































    