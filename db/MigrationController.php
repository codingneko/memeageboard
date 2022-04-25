<?php
    require_once('SqlConnection.php');
    require_once('ImageController.php');
    require_once('TagController.php');
    require_once('UserController.php');
    
    class MigrationController extends SqlConnection {
        public function migrateAll () {
            $image_has_tag = $this->connection->prepare("CREATE TABLE IF NOT EXISTS `image_has_tag` (
                `tag_id` int(32) NOT NULL,
                `image_id` int(32) NOT NULL,
                FOREIGN KEY (`tag_id`) REFERENCES `tag`(`id`),
                FOREIGN KEY (`image_id`) REFERENCES `image`(`id`),
                CONSTRAINT uq_image_has_tag UNIQUE(`tag_id`, `image_id`)
                );
            ");

            $imageController = new ImageController();
            $tagController = new TagController();
            $userController = new UserController();

            return 
                $userController->migrate() && 
                $tagController->migrate() && 
                $imageController->migrate() && 
                $image_has_tag->execute();
        }
    }