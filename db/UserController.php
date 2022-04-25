<?php
    require_once('SqlConnection.php');
    require_once('models/User.php');
    
    class UserController extends SqlConnection {
        public function migrate() {
            $statement = $this->connection->prepare("CREATE TABLE IF NOT EXISTS `user` (
                `id` int(32) NOT NULL AUTO_INCREMENT,
                `username` varchar(256) NOT NULL UNIQUE,
                `password` text NOT NULL,
                `avatar_url` text,
                `description` text,
                PRIMARY KEY (`id`)
                );
            ");

            if ($statement->execute()) {
                return $this->createUser('Anonymous', '');
            } else {
                return false;
            }
        }

        public function createUser($username, $password) {
            $statement = $this->connection->prepare("INSERT INTO `user` (`password`, `username`) VALUES (?, ?)");
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $statement->bindParam(1, $hashed_password);
            $statement->bindParam(2, $username);
            
            try {
                return $statement->execute();
            } catch (PDOException $e){
                return false;
            }
        }

        public function getUsers($limit = 20) {
            $statement = $this->connection->query("SELECT * FROM `user` LIMIT $limit");
            $users = [];

            while($db_user = $statement->fetch(PDO::FETCH_ASSOC)) {
                array_push($users, new User($db_user['id'], $db_user['username'], $db_user['avatar_url'], $db_user['description']));
            }

            return $users;
        }

        public function login($username, $password) {
            $statement = $this->connection->prepare("SELECT * FROM `user` WHERE `username` = ?");
            $statement->bindParam(1, $username);
            $statement->execute();
            $db_user = $statement->fetch();

            if (password_verify($password, $db_user['password'])) {
                $user = new User($db_user['id'], $db_user['username'], $db_user['avatar_url'], $db_user['description']);

                // setcookie('current_user', $user->toString());
                return true;
            } else {
                return false;
            }
        }

        public function getUserById(int $id) {
            $statement = $this->connection->prepare("SELECT * FROM `user` WHERE `id` = ? LIMIT 1");
            $statement->bindParam(1, $id);
            $statement->execute();
            $db_user = $statement->fetch();

            return new User($db_user[0], $db_user['username'], $db_user['avatar_url'], $db_user['description']);
        }
    }