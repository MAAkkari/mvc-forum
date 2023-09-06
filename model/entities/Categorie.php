<?php
    namespace Model\Entities;

    use App\Entity;

    final class Categorie extends Entity{

        private $id;
        private $nom;

        private $nbPosts;
        private $nbTopics;
        private $lastPostDate;

        public function __construct($data) {

            $this->hydrate($data);

        }

        public function getId() {

            return $this->id;

        }

        public function setId($id){
            $this->id=$id;
            return $this;
        }

        public function getNom()
        {
                return $this->nom;
        }
        
        public function setNom($nom)
        {
                $this->nom = $nom;

                return $this;
        }
        public function getNbPosts()
        {
                return $this->nbPosts;
        }
        
        public function setNbPost($NbPosts)
        {
                $this->nbPosts = $NbPosts;

                return $this;
        }

        public function getLastPostDate()
        {
                return $this->lastPostDate;
        }
        
        public function setLastPostDate($lastPostDate)
        {
                $this->lastPostDate = $lastPostDate;
                return $this;
        }
        
        public function getNbTopics()
        {
                return $this->nbTopics;
        }
        
        public function setNbTopics($NbTopics)
        {
                $this->nbTopics = $NbTopics;

                return $this;
        }
    }