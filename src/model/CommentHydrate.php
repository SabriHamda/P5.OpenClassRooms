<?php
namespace blog\src\model;
/**
 * This Class hydrate the entities of comments
 */
class CommentHydrate
{
	protected $id;
	protected $post_id;
	protected $author;
	protected $comment;
	protected $civilite;
	protected $is_valid;
	protected $comment_date;

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

	public function getPostId()
	{
		return $this->post_id;
	}
	public function setPotsId(string $post_id)
	{
		$this->post_id = $post_id;
	}

	public function getAuthor()
	{
		return $this->author;
	}
	public function setAuthor(string $author)
	{
		$this->author = $author;
	}

	public function getComment()
	{
		return $this->comment;
	}
	public function setComment(string $comment)
	{
		$this->comment = $comment;
	}

	public function getCivilite()
	{
		return $this->civilite;
	}
	public function setCivilite(string $civilite)
	{
		$this->civilite = $civilite;
	}

	public function getIsValid()
	{
		return $this->is_valid;
	}
	public function setIsValid(string $is_valid)
	{
		$this->is_valid = $is_valid;
	}

	public function getCommentDate()
	{
		return $this->comment_date;
	}
	public function setCommentDate(string $comment_date)
	{
		$this->comment_date = $comment_date;
	}
	
}