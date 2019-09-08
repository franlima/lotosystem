<?php
    class db
    {        
        private $conn;

        public function __construct()
        {
            if (is_null( $this->conn ))
            {
                $param = array( 'localhost' => 'localhost',
                            'db' => 'demo',
                            'username' => 'root',
                            'password' => ''
                            );
                try 
                {
                    $this->conn = new PDO('mysql:host=' .$param['localhost']. ';dbname=' .$param['db'], $param['username'], $param['password'], array(
                        PDO::ATTR_PERSISTENT => true));
                    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
                catch (PDOException $ex) 
                {
                    echo "Error: " . $ex->getMessage();
                }
                finally
                {
                    return $this->conn;
                }
            }
            else
            {
                $this->getConn();
            }
            
        }

        public function getConn()
        {
            return $this->conn;
        }

        public function closeConn()
        {
            $this->conn = null;
        }
    }
?>