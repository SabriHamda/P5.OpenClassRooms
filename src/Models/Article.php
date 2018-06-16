<?php
namespace src\Repository;
/**
 * This Class hydrate the entities of articles
 */
class Article
{
    protected $id;
    protected $title;
    protected $content;
    protected $content_right;
    protected $image;
    protected $created_at;
    protected $updated_at;

    public function __construct($values = null)
    {
        if ($values != null)
        {
            $this->hydrate($values);
        }

    }
    public function hydrate(array $values)
    {
        foreach ($values as $key=>$value)
        {
            $elements = explode('_',$key);
            $newKey='';
            foreach($elements as $el)
            {
                $newKey .= ucfirst($el);
            }

            $method = 'set' .ucfirst($newKey);
            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

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

    public function getContentRight()
    {
        return $this->content_right;
    }
    public function setContentRight(string $content_right)
    {
        $this->content_right = $content_right;
    }

    public function getImage()
    {
        return $this->image;
    }
    public function setImage(string $image)
    {
        $this->image = $image;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public function setCreatedAt(string $created_at)
    {
        $this->created_at = $created_at;
    }

    public function getUpdated_at()
    {
        return $this->updated_at;
    }
    public function setUpdatedAt(string $updated_at)
    {
        $this->updated_at = $updated_at;
    }

}
