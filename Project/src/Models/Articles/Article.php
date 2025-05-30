<?php

namespace src\Models\Articles;

use src\Models\ActiveRecordEntity;
use src\Models\Users\User;
use src\Models\Comments\Comment;

class Article extends ActiveRecordEntity
{
    protected $id;
    protected $name;
    protected $text;
    protected $authorId;
    protected $createdAt;

    public static function getTableName(): string
    {
        return 'articles'; 
    }
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getText()
    {
        return $this->text;
    }
    public function getAuthor()
    {
        return User::getById($this->authorId);
    }
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    public function getComments()
    {
        return Comment::getByArticleId($this->id);
    }
    public function setId($id): void
    {
        $this->id = $id;
    }
    public function setName($name): void
    {
        $this->name = $name;
    }
    public function setText($text): void
    {
        $this->text = $text;
    }
    public function setAuthorId($authorId): void
    {
        $this->authorId = $authorId;
    }
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function delete()
    {
        $comments = $this->getComments();
        foreach ($comments as $comment) {
            $comment->delete();
        }

        parent::delete();
    }
}
