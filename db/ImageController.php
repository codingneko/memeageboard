<?php
    require_once('SqlConnection.php');
    require_once('db/models/Image.php');
    require_once('db/models/Tag.php');
    require_once('db/UserController.php');
    require_once('db/TagController.php');

    class ImageController extends SqlConnection {
        public function migrate() {
            $statement = $this->connection->prepare("CREATE TABLE IF NOT EXISTS `image` (
                `id` int(32) NOT NULL AUTO_INCREMENT,
                `file_name` varchar(64) NOT NULL UNIQUE,
                `owner_id` int(32) NOT NULL DEFAULT '1',
                PRIMARY KEY (`id`),
                FOREIGN KEY (`owner_id`) REFERENCES user(`id`)
                );
            ");

            return $statement->execute();
        }

        public function createImage($file, $tags) {
            if (isset($this->connection)) {
                $ownerId = 1;
                $statement = $this->connection->prepare("INSERT INTO `image` (file_name, owner_id) VALUES (?, ?)");
                $urlReadyImagePath = '/' . $file;
                $statement->bindParam(1, $urlReadyImagePath);
                $statement->bindParam(2, $ownerId);

                try {
                    $image_insert_result = $statement->execute();
                    $tags = explode(' ', $tags);
                    $tagController = new TagController();
                    $imageObject = $this->getImageById($this->connection->lastInsertId());

                    foreach($tags as $tag) {                        
                        $tagObject = $tagController->createTag($tag);

                        if (!$this->addTag($imageObject, $tagObject)) $image_insert_result = false;
                    }

                    return $image_insert_result;
                } catch (PDOException $sql_error){
                    print_r($sql_error);
                    return $sql_error->getCode();
                }

            } else {
                throw new Exception('You need to use `connect()` first', 1);
            }
        }

        public function addTag(Image $image, Tag $tag) {
            $statement = $this->connection->prepare("INSERT INTO `image_has_tag` (`tag_id`, `image_id`) VALUES (?, ?)");
            
            $tag_id = $tag->getId();
            $image_id = $image->getId();

            $statement->bindParam(1, $tag_id);
            $statement->bindParam(2, $image_id);
            
            return $statement->execute();
        }

        public function getImages($limit = 20) {
            $statement = $this->connection->query("SELECT * FROM `image` ORDER BY `id` DESC LIMIT $limit");
            $images = [];
            $userController = new UserController();
            $tagController = new TagController();

            while($db_image = $statement->fetch()) {
                array_push(
                    $images, 
                    new Image(
                        $db_image['id'], 
                        $db_image['file_name'], 
                        $userController->getUserById($db_image['owner_id']), 
                        $tagController->getTagsByImageId($db_image['id'])
                    )
                );
            }

            return $images;
        }

        public function getImagesByTagId(string $id, ?int $limit = 20) {
            $userController = new UserController();
            $tagController = new TagController();
            $images = [];

            $statement = $this->connection->query("SELECT * FROM `image`
                JOIN `image_has_tag`
                ON `image_has_tag`.`image_id` = `image`.`id`
                WHERE `image_has_tag`.`tag_id` = $id
                ORDER BY `id` DESC LIMIT $limit;
            ");

            while ($db_image = $statement->fetch()) {
                array_push(
                    $images, 
                    new Image(
                        $db_image['id'], 
                        $db_image['file_name'], 
                        $userController->getUserById(
                            $db_image['owner_id']), 
                            $tagController->getTagsByImageId(
                                $db_image['id']
                            )
                        )
                    );
            }

            return $images;
        }

        public function getImageById(int $id) {
            $statement = $this->connection->query("SELECT * FROM `image` WHERE `id` = $id LIMIT 1");
            $userController = new UserController();
            $tagController = new TagController();

            $db_image = $statement->fetch();

            $owner_id = $db_image['owner_id'];

            return new Image($db_image['id'], $db_image['file_name'], $userController->getUserById($owner_id), $tagController->getTagsByImageId($db_image['id']));
        }
    }