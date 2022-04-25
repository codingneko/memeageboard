<?php
    require_once('SqlConnection.php');
    require_once('models/Tag.php');

    class TagController extends SqlConnection {
        public function migrate() {
            $statement = $this->connection->prepare("CREATE TABLE IF NOT EXISTS `tag` (
                `id` int(32) NOT NULL AUTO_INCREMENT,
                `tag_name` varchar(128) NOT NULL UNIQUE,
                `tag_description` text NOT NULL,
                PRIMARY KEY (`id`)
                );
            ");
        
            return $statement->execute();
        }

        public function createTag($tag_name, $tag_description = '') {
            $statement = $this->connection->prepare("INSERT IGNORE INTO `tag` (`tag_name`, `tag_description`) VALUE (?, ?)");

            $statement->bindParam(1, $tag_name);
            $statement->bindParam(2, $tag_description);

            $statement->execute();

            return $this->getTagByTagName($tag_name);
        }

        public function getTagByTagName($tag_name) {
            $statement =  $this->connection->prepare("SELECT * FROM `tag` WHERE `tag_name` = ? LIMIT 1");
            $statement->bindParam(1, $tag_name);
            $statement->execute();

            $db_tag = $statement->fetch();
            
            return new Tag($db_tag['id'], $db_tag['tag_name'], $db_tag['tag_description']);
        }

        public function getTagsByImageId(int $id) {
            $tags = [];

            $statement = $this->connection->query("SELECT * FROM `tag` 
                JOIN `image_has_tag`
                ON `image_has_tag`.`tag_id` = `tag`.`id` 
                WHERE `image_has_tag`.`image_id` = $id
            ");

            while ($tag = $statement->fetch()) {
                array_push($tags, new Tag($tag['id'], $tag['tag_name'], $tag['tag_description']));
            }

            return $tags;
        }

        public function getTags(?int $limit = 10) {
            $statement = $this->connection->query("SELECT * FROM `tag` LIMIT $limit");
            $tags = [];

            while($tag = $statement->fetch()) {
                array_push($tags, new Tag($tag['id'], $tag['tag_name'], $tag['tag_description']));
            }

            return $tags;
        }
    }