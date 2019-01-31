<?php

    set_include_path ('/Xampp/htdocs/syscontrol');
        
    require_once ('../dao/db.php');
    require_once ('../dao/usersdao.php');
    require_once ('../model/userstype.php');

    class userstypedao
    {
        private $conn;

        public function userstypedao ( db &$db )       
        {
            $this->conn = $db->getConn();
        }

        public function find($id)
        {
            $stmt = $this->conn->prepare('
                SELECT * 
                 FROM userstype 
                 WHERE id = :id
            ');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            
            // Set the fetchmode to populate an instance of 'User'
            // This enables us to use the following:
            //     $user = $repository->find(1234);
            //     echo $user->firstname;
            $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE , 'userstype');
            $stmt->execute();
            return $stmt->fetch() ;

        }

        public function findAll()
        {
            $stmt = $this->conn->prepare('
                SELECT * FROM userstype
            ');
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'userstype');
            
            // fetchAll() will do the same as above, but we'll have an array. ie:
            //    $users = $repository->findAll();
            //    echo $users[0]->firstname;
            return $stmt->fetchAll();
        }

        public function save(userstype $model)
        {

            try {
                $stmt = $this->conn->prepare('
                INSERT INTO userstype 
                    (id, type, description, created, finished) 
                VALUES 
                    (NULL, :type , :description, NULL, :finished)
                ');
                $stmt->bindValue(':type', $model->getType(), PDO::PARAM_INT);
                $stmt->bindValue(':description', $model->getDescription(), PDO::PARAM_STR);
                $stmt->bindValue(':finished', $model->getFinished(), PDO::PARAM_STR);
                return $stmt->execute();
            } catch (PDOException $Exception) {
                throw new $Exception($Exception->getMessage());
            }


        }

        public function update(userstype $model)
        {
            try
            {
                $stmt = $this->conn->prepare('
                UPDATE userstype
                SET type = :type,
                    description = :description,
                    finished = :finished
                WHERE id = :id
                ');
                $stmt->bindValue(':type', $model->getType(), PDO::PARAM_INT);
                $stmt->bindValue(':description', $model->getDescription(), PDO::PARAM_STR);
                $stmt->bindValue(':finished', $model->getFinished(), PDO::PARAM_STR);
                return $stmt->execute();
            } catch (PDOException $Exception) {
                throw new $Exception($Exception->getMessage());
            }
        }
    }
?>