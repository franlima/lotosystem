<?php
/*
CREATE TABLE tfloperation (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE,
    description VARCHAR(255) NOT NULL,
    delta  INT DEFAULT 0,
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    finished DATETIME NULL
);
*/

    class tfloperation
    {
        private $id = 0;
        private $name = "";
        private $description = "";
        private $delta = 0;
        private $created = "";
        private $finished = "";

        public function getId()
        {
            return $this->id;
        }
        
        public function getName()
        {
            return $this->name;
        }

        public function getDescription()
        {
            return $this->description;
        }

        public function getDelta()
        {
            return $this->delta;
        }

        public function getCreated()
        {
            return $this->created;
        }

        public function getFinished()
        {
            return $this->finished;
        }

        public function setName($name)
        {
            $this->name = $name;
        }

        public function setDescription($description)
        {
            $this->description = $description;
        }

        public function setFinished($finished)
        {
            $this->finished = $finished;
        }
    }
?>