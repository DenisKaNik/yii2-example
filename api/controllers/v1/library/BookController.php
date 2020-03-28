<?php

namespace api\controllers\v1\library;

use api\providers\MapDataProvider;
use library\readModels\Library\{
    AuthorReadRepository,
    BookReadRepository
};
use library\entities\Library\Book\AuthorAssignment;
use library\entities\Library\Book\Book;
use library\useCases\Library\BookService;
use Yii;
use yii\data\DataProviderInterface;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class BookController extends Controller
{
    private $books;
    private $authors;
    private $service;

    public function __construct(
        $id,
        $module,
        BookReadRepository $books,
        AuthorReadRepository $authors,
        BookService $service,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->books = $books;
        $this->authors = $authors;
        $this->service = $service;
    }

    protected function verbs(): array
    {
        return [
            'index' => ['GET'],
            'view' => ['GET'],
            'update' => ['PUT'],
            'delete' => ['DELETE'],
        ];
    }

    /**
     * @return DataProviderInterface
     */
    public function actionIndex(): DataProviderInterface
    {
        $dataProvider = $this->books->getAll();
        return new MapDataProvider($dataProvider, [$this, 'serializeListItem']);
    }

    /**
     * @param $id
     * @throws NotFoundHttpException
     */
    public function actionOptions($id)
    {
        if (!$book = $this->books->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $options = ['GET', 'PUT', 'DELETE', 'OPTIONS'];
        $headers = Yii::$app->getResponse()->getHeaders();
        $headers->set('Allow', implode(', ', $options));
        $headers->set('Access-Control-Allow-Methods', implode(', ', $options));
    }

    /**
     * @param $id
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionView($id): array
    {
        if (!$book = $this->books->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $this->serializeView($book);
    }

    /**
     * @param $id
     * @throws BadRequestHttpException
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->request->getRawBody() && $jsonData = Json::decode(Yii::$app->request->getRawBody())) {
            try {
                $this->service->edit($id, $jsonData);
                Yii::$app->getResponse()->setStatusCode(204);
            } catch (\DomainException $e) {
                throw new BadRequestHttpException($e->getMessage(), null, $e);
            }

        } else {
            throw new BadRequestHttpException('Failed to verify the transferred data.');
        }
    }

    /**
     * @param $id
     * @throws BadRequestHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id): void
    {
        try {
            $this->service->remove($id);
            Yii::$app->getResponse()->setStatusCode(204);
        } catch (\DomainException $e) {
            throw new BadRequestHttpException($e->getMessage(), null, $e);
        }
    }

    public function serializeListItem(Book $book): array
    {
        return [
            'id' => $book->id,
            'name' => $book->name,
            'isbn' => $book->isbn,
            'authors' => array_map(function (AuthorAssignment $authorAssignment) {
                return [
                    'first_name' => $authorAssignment->author->first_name,
                    'last_name' => $authorAssignment->author->last_name,
                ];
            }, $book->authorAssignments),
            '_links' => [
                'self' => ['href' => Url::to(['view', 'id' => $book->id], true)],
                'public' => ['href' => Yii::$app->get('frontendUrlManager')->createAbsoluteUrl(["/book/{$book->slug}"])],
            ],
        ];
    }

    private function serializeView(Book $book): array
    {
        return $this->serializeListItem($book) + [
            'description' => $book->description,
        ];
    }
}
