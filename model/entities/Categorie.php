<?php
    namespace Model\Entities;

    use App\Entity;

    final class Categorie extends Entity{

        private $id;
        private $nom;

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
    }