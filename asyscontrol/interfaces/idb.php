<?php

    interface iDb {

        public function conn ();
        public function getConn ();
        public function closeConn ();

    }

    interface iDao {

        public function insert ($model);
        public function update ($model);
        public function delete ($model);
        public function find ($model);

    }

?>