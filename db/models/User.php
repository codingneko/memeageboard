<?php
    class User {
        private int $id;
        private string $username;
        private string $avatar_url;
        private string $description;

        public function __construct(int $id, string $username, ?string $avatar_url, ?string $description) {
            $this->id = $id;
            $this->username = $username;
            $this->avatar_url = $avatar_url || '';
            $this->description = $description || '';
        }

        public function getUsername() {
            return $this->username;
        }

        public function getId() {
            return $this->id;
        }

        public function getAvatarUrl() {
            return $this->avatar_url;
        }

        public function getDescription() {
            return $this->description;
        }
    }