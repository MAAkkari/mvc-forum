<?php
    namespace Model\Entities;

    use App\Entity;

    final class Post extends Entity{

        private $id;
        private $dateCreation;
        private $text;
        private $user;
        private $topic;

        public function __construct($data){         
            $this->hydrate($data);        
        }

        public function getId(){
            return $this->id;
        }
        public function getDateCreation(){
            $formattedDate = $this->dateCreation->format("d/m/Y, H:i:s");
            return $formattedDate;
        }
        public function getText(){
            return $this->text ;
        }

        public function getUser(){
            return $this->user ;
        }
        public function getTopic(){
            return $this->topic ;
        }

        public function setId($id){
            $this->id=$id;
            return $this;
        }
      
        public function setDateCreation($date){
            $this->dateCreation = new \DateTime($date);
            return $this;
        }

        public function setText($text){
            $this->text=$text;
            return $this;
        }

        public function setUser($user){
            $this->user=$user;
            return $this;
        }

        public function setTopic($topic){
            $this->topic=$topic;
            return $this;
        }
       

       






    }