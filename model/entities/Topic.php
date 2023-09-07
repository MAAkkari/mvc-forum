<?php
    namespace Model\Entities;

    use App\Entity;

    final class Topic extends Entity{

        private $id;
        private $titre;
        private $user;
        private $dateCreation;
        private $fermer;
        private $categorie;
        private $dateModif;

        public function __construct($data){         
            $this->hydrate($data);        
        }
 
        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of title
         */ 
        public function getTitre()
        {
                return $this->titre;
        }

        /**
         * Set the value of titre
         *
         * @return  self
         */ 
        public function setTitre($titre)
        {
                $this->titre = $titre;

                return $this;
        }

        /**
         * Get the value of user
         */ 
        public function getUser()
        {
                return $this->user;
        }

        /**
         * Set the value of user
         *
         * @return  self
         */ 
        public function setUser($user)
        {
                $this->user = $user;
                return $this;
        }

        public function getDateCreation(){
        if( $this->dateCreation->format("d/m/Y") == date_create()->format("d/m/Y") ){
            $formattedDate = $this->dateCreation->format("H:i:s"); }
            else {  $formattedDate = $this->dateCreation->format("d/m/Y"); }
            return $formattedDate;
        }

        public function setDateCreation($date){
            $this->dateCreation = new \DateTime($date);
            return $this;
        }
        public function getDateModif(){
                
                if ( $this->dateModif != null ){
                if( $this->dateModif->format("d/m/Y") == date_create()->format("d/m/Y") ){
                    $formattedDate = $this->dateModif->format("H:i:s"); }
                    else {  $formattedDate = $this->dateModif->format("d/m/Y"); }
                    return $formattedDate;
                } else { return null;}
                }
        
        public function setDateModif($date=null){
                if( $date !=null){
                $this->dateModif = new \DateTime($date);
                }
                else {
                $this->dateModif=null;
                }
                return $this;
                
        }

        /**
         * Get the value of fermer
         */ 
        public function getFermer()
        {
                return $this->fermer;
        }

        /**
         * Set the value of fermer
         *
         * @return  self
         */ 
        public function setFermer($fermer)
        {
                $this->fermer = $fermer;

                return $this;
        }

        /**
         * Get the value of categorie
         */ 
        public function getCategorie()
        {
                return $this->categorie;
        }

        /**
         * Set the value of categorie
         *
         * @return  self
         */ 
        public function setCategorie($categorie)
        {
                $this->categorie = $categorie;
                return $this;
        }
        public function MadeBy($user=null){
                if ( $user != null ) {
                        if($this->getUser() != null){
                                if (  $this->getUser()->getId() == $user->getId() || $user->getRole() == 'ROLE_ADMIN') {return true;} else {return false ;}
                }else { if ( $user->getRole() == 'ROLE_ADMIN'){
                        return true;
                } else {return false ;}}
            } else {return false ;}
    
        }

}
