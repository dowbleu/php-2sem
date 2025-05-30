<?php

namespace src\Controllers;

use src\View\View;
use src\Services\Db;
use src\Models\Articles\Article;
use src\Models\Comments\Comment;

class CommentController
{
    private $view;
    private $db;
    public function __construct()
    {
        $this->view = new View;
        $this->db = Db::getInstance();
    }

    public function edit($id) //выводит форму для редактирования комментария по id
    {
        $comment = Comment::getById($id);
        $this->view->renderHtml('comments/edit', ['comment' => $comment]);
    }

    public function update($id) //обновляет комментарий по id
    {
        $comment = Comment::getById($id);
        $comment->text = $_POST['text'];
        $comment->save();

        $commentId = $comment->getId();
        return header('Location:http://localhost/polytech-2sem/Project/www/article/' . $comment->getArticleId() . '#comment' . $commentId);
    }

    public function delete($id) //удаляет комментарий по id
    {
        $comment = Comment::getById($id);
        if ($comment === null) {
            $this->view->renderHtml('error/404', [], 404);
            return;
        }
        
        $articleId = $comment->getArticleId();
        $comment->delete();
        
        return header('Location:http://localhost/polytech-2sem/Project/www/article/' . $articleId);
    }
}
