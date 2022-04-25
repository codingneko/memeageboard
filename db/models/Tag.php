<?php

    class Tag {
        private int $id;
        private string $tag_name;
        private string $tag_description;

        public function __construct(int $id, string $tag_name, ?string $tag_description) {
            $this->id = $id;
            $this->tag_name = $tag_name;
            $this->tag_description = $tag_description || '';
        }

        public function getId() {
            return $this->id;
        }

        public function getTagName() {
            return $this->tag_name;
        }

        public function getTagDescription() {
            return $this->tag_description;
        }
    }