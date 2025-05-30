<?php

namespace src\Controllers;

use src\View\View;

class MainController
{
    private $view;
    public function __construct()
    {
        $this->view = new View;
    }
    public function main() //выводит все статьи
    {
        $articles = [
            [
                'title' => 'Title 1',
                'text' => 'Lorem ipsum',
                'author' => 'den',
                'date' => '09-09-1999'
            ],
            [
                'title' => 'Title 2',
                'text' => 'Lorem ipsum',
                'author' => 'den',
                'date' => '10-09-1999'
            ]
        ];
        $this->view->renderHtml('article/index', ['articles' => $articles]);
    }
    public function sayHello(string $name) //выводит имя
    {
        $this->view->renderHtml('main/hello', ['name' => $name]);
    }
    public function sayBye(string $name) 
    {
        $this->view->renderHtml('main/bye', ['name' => $name]);
    }
}
