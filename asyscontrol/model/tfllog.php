<?php
/*
CREATE TABLE tfllog (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    idop INT NOT NULL,
    iduser INT NOT NULL,
    value DOUBLE NOT NULL,
    status  TINYINT NOT NULL DEFAULT 0,
    due DATETIME NULL,
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    finished DATETIME NULL
);
*/

    class tfllog
    {
        private $id = 0;
        private $idop = 0;
        private $iduser = 0;
        private $value = 0.0;
        private $status = 0;
        private $due = "";
        private $created = "";
        private $finished = "";

        public function getId()
        {
            return $this->id;
        }
        
        public function getIdop()
        {
            return $this->idop;
        }

        public function getiduser()
        {
            return $this->iduser;
        }

        public function getValue()
        {
            return $this->value;
        }

        public function getStatus()
        {
            return $this->status;
        }

        public function getDue()
        {
            return $this->due;
        }

        public function getFinished()
        {
            return $this->finished;
        }

        public function setIdop($value)
        {
            $this->idop = $value;
        }

        public function setIduser($value)
        {
            $this->iduser = $value;
        }

        public function setValue($value)
        {
            $this->value = (float)$value;
        }

        public function setStatus($value)
        {
            $this->status = $value;
        }

        public function setDue($value)
        {
            $this->due = $value;
        }

        public function setFinished($value)
        {
            $this->finished = $value;
        }
    }
?>