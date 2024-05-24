<?php
    class Usuario
    {
        private int $id;
        private string $nombre;
        private string $email;
 

        public function __construct($id,$nombre, $email)
        {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->email = $email;
            
        }

        public function getId()
        {
            return $this->id;
        } 

        public function getNombre()
        {
            return $this->nombre;
        }

        public function getEmail()
        {
            return $this->email;
        }  

        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }
    
        public function setEmail($email) {
            $this->email = $email;
        }


        
    }
?>