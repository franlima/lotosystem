<?php
    class userstype
    {
        private $id;
        private $type = "";
        private $description = "";
        private $created = "";
        private $finished = "";

        public function getId()
        {
            return $this->id;
        }
        
        public function getType()
        {
            return $this->type;
        }
        
        public function getDescription()
        {
            return $this->description;
        }

        public function getCreated()
        {
            return $this->created;
        }

        public function getFinished()
        {
            return $this->finished;
        }

        
        public function setType($type)
        {
            $this->type = $type;
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