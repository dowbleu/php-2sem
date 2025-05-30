<?php

namespace src\Controllers;

use src\View\View;
use src\Services\Db;
use src\Models\Articles\Article;
use src\Models\Comments\Comment;


class ArticleController
{
    private $view;
    private $db;
    public function __construct()
    {
        $this->view = new View;
        $this->db = Db::getInstance();
    }

    public function index() //выводит все статьи
    {
        $articles = Article::findAll();
        $this->view->renderHtml('article/index', ['articles' => $articles]);
    }

    public function show($id) //выводит одну статью по id
    {
        $article = Article::getById($id);
        if ($article == []) {
            $this->view->renderHtml('error/404', [], 404);
            return;
        }
        $this->view->renderHtml('article/show', ['article' => $article]);
    }

    public function edit($id) //выводит форму для редактирования статьи по id
    {
        $article = Article::getById($id);
        $this->view->renderHtml('article/edit', ['article' => $article]);
    }

    public function update($id) //обновляет статью по id
    {
        $article = Article::getById($id);
        $article->name = $_POST['name'];
        $article->text = $_POST['text'];
        $article->save();
        return header('Location:http://localhost/polytech-2sem/Project/www/article/' . $article->getId()); //перенаправляет на страницу статьи
    }

    public function create() //выводит форму для создания статьи
    {
        $this->view->renderHtml('article/create');
    }

    public function store() //создает статью
    {
        $article = new Article;
        $article->name = $_POST['name'];
        $article->text = $_POST['text'];
        $article->authorId = 1;
        $article->save();
        return header('Location:http://localhost/polytech-2sem/Project/www/index.php'); //перенаправляет на главную страницу
    }

    public function delete(int $id) //удаляет статью по id
    {
        $article = Article::getById($id);
        $article->delete();
        return header('Location:http://localhost/polytech-2sem/Project/www/index.php');
    }

    public function comments(int $id) //добавляет комментарий к статье по id
    {
        $comment = new Comment;
        $comment->text = $_POST['text'];
        $comment->authorId = 1;
        $comment->articleId = $id;
        $comment->save();

        $commentId = $comment->getId();
        return header('Location:http://localhost/polytech-2sem/Project/www/article/' . $id . '#comment' . $commentId);
    }
}
