<?php

namespace src\Models;
/**
 * This Class hydrate the entities of articles
 */
trait Article
{
    /**
     * @var
     */
    protected $id;
    /**
     * @var
     */
    protected $title;
    /**
     * @var
     */
    protected $content;
    /**
     * @var
     */
    protected $content_right;
    /**
     * @var
     */
    protected $image;
    /**
     * @var
     */
    protected $created_at;
    /**
     * @var
     */
    protected $updated_at;

    /**
     * Article constructor.
     * @param null $repository
     */
    public function __construct($repository = null)
    {
        $values = (array)$repository;
        if ($values != null) {
            $this->hydrate($values);
        }

    }

    /**
     * @param array $values
     */
    public function hydrate(array $values)
    {
        foreach ($values as $key => $value) {
            $elements = explode('_', $key);
            $newKey = '';
            foreach ($elements as $el) {
                $newKey .= ucfirst($el);
            }

            $method = 'set' . ucfirst($newKey);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;

    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;

    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getContentRight()
    {
        return $this->content_right;
    }

    /**
     * @param string $content_right
     */
    public function setContentRight(string $content_right)
    {
        $this->content_right = $content_right;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param string $created_at
     */
    public function setCreatedAt(string $created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * @param string $updated_at
     */
    public function setUpdatedAt(string $updated_at)
    {
        $this->updated_at = $updated_at;
    }

}
