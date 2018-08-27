<?php
namespace src\models;
/**
 * This Class hydrate the entities of articles
 */
class Article
{
    private $id;
    private $title;
    private $content;
    private $chapo;
    private $image;
    private $createdAt;
    private $updatedAt;


    public function getId()
    {
        return $this->id;
    }
    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getContent()
    {
        return $this->content;
    }
    public function setContent(string $content)
    {
        $this->content = $content;
    }

    public function getChapo()
    {
        return $this->chapo;
    }
    public function setChapo(string $chapo)
    {
        $this->chapo = $chapo;
    }

    public function getImage()
    {
        return $this->image = urldecode($this->image);
    }
    public function setImage(string $image)
    {
        $this->image = $image;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    public function setCreatedAt(string $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdated_at()
    {
        return $this->updatedAt;
    }
    public function setUpdatedAt(string $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

}
