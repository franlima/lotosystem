<?php

require_once ('/Xampp/htdocs/syscontrol/dao/db.php');
require_once ('/Xampp/htdocs/syscontrol/model/users.php');

    class usersdao
    {
        private $conn;
        private $user;

        public function usersdao ( db $db )       
        {
            $this->conn = $db->getConn();
        }

        public function find($id)
        {
            $stmt = $this->conn->prepare('
                SELECT * 
                 FROM users 
                 WHERE id = :id
            ');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            
            // Set the fetchmode to populate an instance of 'User'
            // This enables us to use the following:
            //     $user = $repository->find(1234);
            //     echo $user->firstname;
            $stmt->setFetchMode(PDO::FETCH_CLASS/*|PDO::FETCH_PROPS_LATE*/ , 'users');
            $stmt->execute();
            $user =  $stmt->fetch();
            return $user;
        }

        public function findAll()
        {
            $stmt = $this->conn->prepare('
                SELECT * FROM users
            ');
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS/*|PDO::FETCH_PROPS_LATE*/, 'users');
            
            // fetchAll() will do the same as above, but we'll have an array. ie:
            //    $users = $repository->findAll();
            //    echo $users[0]->firstname;
            return $stmt->fetchAll();
        }

        public function save(users $model)
        {

            try {
                $stmt = $this->conn->prepare('
                    INSERT INTO users 
                        (idtype, username, password, finished) 
                    VALUES 
                        (:idtype, :username, :password, :finished)
                ');
                $stmt->bindValue(':idtype', $model->getIdType(), PDO::PARAM_INT);
                $stmt->bindValue(':username', $model->getUsername(), PDO::PARAM_STR);
                $stmt->bindValue(':password', $model->getPassword(), PDO::PARAM_STR);
                $stmt->bindValue(':finished', $model->getFinished(), PDO::PARAM_STR);
                $stmt->setFetchMode(PDO::FETCH_CLASS/*|PDO::FETCH_PROPS_LATE*/ , 'users');
                $stmt->execute();
                return $this->conn->lastInsertId();
            } catch (PDOException $Exception) {
                throw new $Exception($Exception->getMessage());
            }


        }

        public function update(users $model)
        {
            try
            {
                $stmt = $this->conn->prepare('
                UPDATE users
                SET idtype = :idtype,
                    username = :username,
                    password = :password,
                    finished = :finished
                WHERE id = :id
                ');
                $stmt->bindValue(':id', $model->getId(), PDO::PARAM_INT);
                $stmt->bindValue(':idtype', $model->getIdType(), PDO::PARAM_INT);
                $stmt->bindValue(':username', $model->getUsername(), PDO::PARAM_STR);
                $stmt->bindValue(':password', $model->getPassword(), PDO::PARAM_STR);
                $stmt->bindValue(':finished', $model->getFinished(), PDO::PARAM_STR);
                //$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE , 'users');
                $stmt->execute();
                return $this->conn->lastInsertId();
            } catch (PDOException $Exception) {
                throw new $Exception($Exception->getMessage());
            }
        }

        public function validateUser(users $model)
        {
            $stmt = $this->conn->prepare('
                SELECT * FROM users
                WHERE username = :username
                AND password = :password
            ');
            $stmt->bindValue(':username', $model->getUsername(), PDO::PARAM_STR);
            $stmt->bindValue(':password', $model->getPassword(), PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_CLASS/*|PDO::FETCH_PROPS_LATE*/, 'users');
            $stmt->execute();
            $model = $stmt->fetch();

            return $model;
        }

        public function updatePassword(users $model)
        {
            try
            {
                $stmt = $this->conn->prepare('
                    UPDATE users
                    SET password = :password
                    WHERE id = :id
                ');
                $stmt->bindValue(':id', $model->getId(), PDO::PARAM_INT);
                $stmt->bindValue(':password', $model->getPassword(), PDO::PARAM_STR);
                $stmt->setFetchMode(PDO::FETCH_CLASS/*|PDO::FETCH_PROPS_LATE*/, 'users');
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
                    UPDATE users
                    SET finished = :finished
                    WHERE id = :id
                ');
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt->bindValue(':finished', date('Y-m-d H:i:s'), PDO::PARAM_STR);
                //$stmt->setFetchMode(PDO::FETCH_CLASS/*|PDO::FETCH_PROPS_LATE*/, 'users');
                $stmt->execute();
                return $this->conn->lastInsertId();
            } catch (PDOException $Exception) {
                throw new $Exception($Exception->getMessage());
            }
        }
    }
?>