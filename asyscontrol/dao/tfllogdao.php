<?php

require_once ('/Xampp/htdocs/syscontrol/dao/db.php');
require_once ('/Xampp/htdocs/syscontrol/model/tfllog.php');

    class tfllogdao
    {
        private $conn;
        private $tfllog;

        public function tfllogdao ( db $db )       
        {
            $this->conn = $db->getConn();
        }

        public function find($id)
        {
            $stmt = $this->conn->prepare('
                SELECT * 
                 FROM tfllog 
                 WHERE id = :id
            ');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            
            // Set the fetchmode to populate an instance of 'User'
            // This enables us to use the following:
            //     $user = $repository->find(1234);
            //     echo $user->firstname;
            $stmt->setFetchMode(PDO::FETCH_CLASS/*|PDO::FETCH_PROPS_LATE*/ , 'tfllog');
            $stmt->execute();
            $tfllog =  $stmt->fetch();
            return $tfllog;
        }

        public function findAll()
        {
            $stmt = $this->conn->prepare('
                SELECT * FROM tfllog ORDER BY idop
            ');
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS/*|PDO::FETCH_PROPS_LATE*/, 'tfllog');
            
            // fetchAll() will do the same as above, but we'll have an array. ie:
            //    $tfllog = $repository->findAll();
            //    echo $tfllog[0]->firstname;
            return $stmt->fetchAll();
        }

        public function findAllDateReport($date)
        {
            $newdate = date('Y-m-d', strtotime($date. '+1 days'));

            $stmt = $this->conn->prepare('
                SELECT * FROM tfllog
                WHERE created BETWEEN :created AND :newdate
                ORDER BY idop
            ');
            $stmt->bindValue(':created', $date, PDO::PARAM_STR);
            $stmt->bindValue(':newdate', $newdate, PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_CLASS/*|PDO::FETCH_PROPS_LATE*/, 'tfllog');
            $stmt->execute();       
            // fetchAll() will do the same as above, but we'll have an array. ie:
            //    $tfllog = $repository->findAll();
            //    echo $tfllog[0]->firstname;
            return $stmt->fetchAll();
        }

        public function findAllDueReport($date)
        {
            $stmt = $this->conn->prepare('
                SELECT * FROM tfllog
                WHERE due = :due
                ORDER BY idop
            ');
            $stmt->bindValue(':due', $date, PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_CLASS/*|PDO::FETCH_PROPS_LATE*/, 'tfllog');
            $stmt->execute();       
            // fetchAll() will do the same as above, but we'll have an array. ie:
            //    $tfllog = $repository->findAll();
            //    echo $tfllog[0]->firstname;
            return $stmt->fetchAll();
        }

        public function save(tfllog $model)
        {

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
            
            try {
                $stmt = $this->conn->prepare('
                    INSERT INTO tfllog 
                        (idop, iduser, value, due)
                    VALUES 
                        (:idop, :iduser, :value, :due)
                ');
                $stmt->bindValue(':idop', $model->getIdop(), PDO::PARAM_INT);
                $stmt->bindValue(':iduser', $model->getIduser(), PDO::PARAM_INT);
                $stmt->bindValue(':value', $model->getValue(), PDO::PARAM_STR);
                $stmt->bindValue(':due', $model->getDue(), PDO::PARAM_STR);
                $stmt->setFetchMode(PDO::FETCH_CLASS/*|PDO::FETCH_PROPS_LATE*/ , 'tfllog');
                $stmt->execute();
                return $this->conn->lastInsertId();
            } catch (PDOException $Exception) {
                throw new $Exception($Exception->getMessage());
            }
        }

        public function update(tfllog $model)
        {
            try
            {
                $stmt = $this->conn->prepare('
                UPDATE tfllog
                SET idop = :idop,
                    iduser = :iduser,
                    value = :value,
                    due = :due,
                WHERE id = :id
                ');
                $stmt->bindValue(':id', $model->getId(), PDO::PARAM_INT);
                $stmt->bindValue(':idop', $model->getIdop(), PDO::PARAM_INT);
                $stmt->bindValue(':iduser', $model->getIduser(), PDO::PARAM_INT);
                $stmt->bindValue(':value', $model->getValue(), PDO::PARAM_INT);
                $stmt->bindValue(':due', date('Y-m-d H:i:s'), PDO::PARAM_STR);
                //$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE , 'tfllog');
                $stmt->execute();
                return $this->conn->lastInsertId();
            } catch (PDOException $Exception) {
                throw new $Exception($Exception->getMessage());
            }
        }

        public function confirm($id)
        {
            try
            {
                $stmt = $this->conn->prepare('
                    UPDATE tfllog
                    SET status = 1
                    WHERE id = :id
                ');
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                //$stmt->setFetchMode(PDO::FETCH_CLASS/*|PDO::FETCH_PROPS_LATE*/, 'tfllog');
                $stmt->execute();
                return $this->conn->lastInsertId();
            } catch (PDOException $Exception) {
                throw new $Exception($Exception->getMessage());
            }
        }

        public function delete($id)
        {
            try
            {
                $stmt = $this->conn->prepare('
                    UPDATE tfllog
                    SET finished = :finished
                    WHERE id = :id
                ');
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt->bindValue(':finished', date('Y-m-d H:i:s'), PDO::PARAM_STR);
                //$stmt->setFetchMode(PDO::FETCH_CLASS/*|PDO::FETCH_PROPS_LATE*/, 'tfllog');
                $stmt->execute();
                return $this->conn->lastInsertId();
            } catch (PDOException $Exception) {
                throw new $Exception($Exception->getMessage());
            }
        }
    }
?>