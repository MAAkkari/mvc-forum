<?php
    namespace Model\Managers;   
    
    use App\Manager;
    use App\DAO;

    class UserManager extends Manager{

        protected $className = "Model\Entities\User";
        protected $tableName = "user";


        public function __construct(){
            parent::connect();
        }

        public function findOneByMail($mail){
            $sql="SELECT * FROM user WHERE user.email=:mail";
            
            
                DAO::select($sql,['mail'=>$mail]);
               
        }
        public function findOneByPseudo($pseudo){
            $sql="select * from user where user.pseudo=:pseudo";

            return $this->getOneOrNullResult(
                DAO::select($sql, []), 
                $this->className
            );
        }
        
        public function loginRequest(){

        }


       



    }