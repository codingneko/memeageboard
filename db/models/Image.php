<?php

    class Image {
        private int $id;
        private string $file_name;
        private User $owner;
        private Array $tags;

        public function __construct($id, $file_name, User $owner, Array $tags) {
            $this->id = $id;
            $this->file_name = $file_name;
            $this->owner = $owner;
            $this->tags = $tags;
        }

        public function getId() {
            return $this->id;
        }

        public function getFileName() {
            return $this->file_name;
        }

        public function getOwner() {
            return $this->owner;
        }

        public function getTags() {
            return $this->tags;
        }
    }