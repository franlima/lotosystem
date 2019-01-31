<?php

require_once ('/Xampp/htdocs/syscontrol/dao/db.php');
require_once ('/Xampp/htdocs/syscontrol/model/tfloperation.php');

    class tfloperationdao
    {
        private $conn;
        private $tfloperation;

        public function tfloperationdao ( db $db )       
        {
            $this->conn = $db->getConn();
        }

        public function find($id)
        {
            $stmt = $this->conn->prepare('
                SELECT * 
                 FROM tfloperation 
                 WHERE id = :id
            ');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            
            // Set the fetchmode to populate an instance of 'User'
            // This enables us to use the following:
            //     $user = $repository->find(1234);
            //     echo $user->firstname;
            $stmt->setFetchMode(PDO::FETCH_CLASS/*|PDO::FETCH_PROPS_LATE*/ , 'tfloperation');
            $stmt->execute();
            $tfloperation =  $stmt->fetch();
            return $tfloperation;
        }

        public function findAll()
        {
            $stmt = $this->conn->prepare('
                SELECT * FROM tfloperation
            ');
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS/*|PDO::FETCH_PROPS_LATE*/, 'tfloperation');
            
            // fetchAll() will do the same as above, but we'll have an array. ie:
            //    $tfloperation = $repository->findAll();
            //    echo $tfloperation[0]->firstname;
            return $stmt->fetchAll();
        }

        public function save(tfloperation $model)
        {

            try {
                $stmt = $this->conn->prepare('
                    INSERT INTO tfloperation 
                        (name, description, delta)
                    VALUES 
                        (:name, :description, :delta)
                ');
                $stmt->bindValue(':name', $model->getName(), PDO::PARAM_STR);
                $stmt->bindValue(':description', $model->getDescription(), PDO::PARAM_STR);
                $stmt->bindValue(':delta', $model->getDelta(), PDO::PARAM_INT);
                $stmt->setFetchMode(PDO::FETCH_CLASS/*|PDO::FETCH_PROPS_LATE*/ , 'tfloperation');
                $stmt->execute();
                return $this->conn->lastInsertId();
            } catch (PDOException $Exception) {
                throw new $Exception($Exception->getMessage());
            }


        }

        public function update(tfloperation $model)
        {
            try
            {
                $stmt = $this->conn->prepare('
                UPDATE tfloperation
                SET name = :name,
                    description = :description,
                    delta = :delta,
                WHERE id = :id
                ');
                $stmt->bindValue(':id', $model->getId(), PDO::PARAM_INT);
                $stmt->bindValue(':name', $model->getName(), PDO::PARAM_STR);
                $stmt->bindValue(':description', $model->getDescription(), PDO::PARAM_STR);
                $stmt->bindValue(':delta', $model->getDelta(), PDO::PARAM_INT);
                //$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE , 'tfloperation');
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
                    UPDATE tfloperation
                    SET finished = :finished
                    WHERE id = :id
                ');
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt->bindValue(':finished', date('Y-m-d H:i:s'), PDO::PARAM_STR);
                //$stmt->setFetchMode(PDO::FETCH_CLASS/*|PDO::FETCH_PROPS_LATE*/, 'tfloperation');
                $stmt->execute();
                return $this->conn->lastInsertId();
            } catch (PDOException $Exception) {
                throw new $Exception($Exception->getMessage());
            }
        }
    }
?>