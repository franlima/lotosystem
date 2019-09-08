<?php
/*
CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    idtype INT NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    finished DATETIME
);
*/

    class users
    {
        private $id;
        private $idtype;
        private $username = "";
        private $password = "";
        private $created = "";
        private $finished = "";

        public function getId()
        {
            return $this->id;
        }
        
        public function getIdType()
        {
            return $this->idtype;
        }

        public function getUsername()
        {
            return $this->username;
        }

        public function getPassword()
        {
            return sha1($this->password);
        }

        public function getCreated()
        {
            return $this->created;
        }

        public function getFinished()
        {
            return $this->finished;
        }
        
        public function setIdType($idtype)
        {
            $this->idtype = $idtype;
        }

        public function setUsername($username)
        {
            $this->username = $username;
        }

        public function setPassword($password)
        {
            $this->password = sha1($password);
        }

        public function setFinished($finished)
        {
            $this->finished = $finished;
        }
    }
    



?>