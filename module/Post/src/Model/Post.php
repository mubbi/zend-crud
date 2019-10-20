<?php

namespace Post\Model;

/**
 * Post Model
 */
class Post
{
    public $id;
    public $title;
    public $description;
    public $category;

    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->title = (!empty($data['title'])) ? $data['title'] : null;
        $this->description = (!empty($data['description'])) ? $data['description'] : null;
        $this->category = (!empty($data['category'])) ? $data['category'] : null;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getArrayCopy() {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "category" => $this->category
        ];
    }
}
