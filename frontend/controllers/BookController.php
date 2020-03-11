<?php

namespace frontend\controllers;

use library\readModels\Library\BookReadRepository;
use yii\web\{
    Controller,
    NotFoundHttpException
};

class BookController extends Controller
{
    private $books;

    public function __construct($id, $module, BookReadRepository $books, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->books = $books;
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'dataProvider' => $this->books->getAll(),
        ]);
    }

    /**
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($slug)
    {
        if (!$book = $this->books->findBySlug($slug)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('book', [
            'book' => $book,
        ]);
    }
}
