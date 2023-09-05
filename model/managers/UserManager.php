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
            $sql = "SELECT *
            FROM ".$this->tableName." a
            WHERE a.email= :mail
            ";
            return $this->getOneOrNullResult(
            DAO::select($sql, ['mail' => $mail], false), 
            $this->className
            );
               
        }
        public function findOneByPseudo($pseudo){
            $sql = "SELECT *
            FROM ".$this->tableName." a
            WHERE a.pseudo= :pseudo
            ";
            return $this->getOneOrNullResult(
            DAO::select($sql, ['pseudo' => $pseudo], false), 
            $this->className
            );
        }
        
    


       



    }