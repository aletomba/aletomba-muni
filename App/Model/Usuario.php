<?php
    class Usuario
    {
        
        private string $nombre;
        private string $email;
 

        public function __construct($nombre, $email)
        {
          
            $this->nombre = $nombre;
            $this->email = $email;
            
        }

        public function getNombre()
        {
            return $this->nombre;
        }

        public function getEmail()
        {
            return $this->email;
        }  


        
    }
?>