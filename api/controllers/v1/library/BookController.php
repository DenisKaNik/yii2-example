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
     * @OA\Get(
     *     path="/v1/books",
     *     tags={"Books"},
     *     description="List books",
     *     @OA\Parameter(
     *         name="Authorization",
     *         in="header",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid response"
     *     ),
     *     security={{"bearerAuth": {}, "OAuth2": {}}}
     * )
     *
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
     * @OA\Get(
     *     path="/v1/books/{bookId}",
     *     tags={"Books"},
     *     description="Book view",
     *     @OA\Parameter(
     *         description="Book id to view",
     *         in="path",
     *         name="bookId",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="Authorization",
     *         in="header",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid response"
     *     ),
     *     security={{"bearerAuth": {}, "OAuth2": {}}}
     * )
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
     * @OA\Put(
     *     path="/v1/books/{bookId}",
     *     tags={"Books"},
     *     description="Book update",
     *     @OA\Parameter(
     *         name="Authorization",
     *         in="header",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Book id that to be updated",
     *         in="path",
     *         name="bookId",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="Updated book object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Book")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid response"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Book not found"
     *     ),
     *     security={{"bearerAuth": {}, "OAuth2": {}}}
     * )
     *
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
     * @OA\Delete(
     *     path="/v1/books/{bookId}",
     *     summary="Deletes a book",
     *     description="",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         description="Book id to delete",
     *         in="path",
     *         name="bookId",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="Authorization",
     *         in="header",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Book not found"
     *     ),
     *     security={{"bearerAuth":{}}}
     * )
     *
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

/**
 * @OA\Schema(
 *     schema="Book",
 *     type="object",
 *     @OA\Property(
 *         property="id",
 *         title="Id",
 *         type="integer",
 *         format="int64",
 *     ),
 *     @OA\Property(
 *         property="name",
 *         title="Name",
 *         type="string",
 *     ),
 *     @OA\Property(
 *         property="isbn",
 *         title="Isbn",
 *         type="string",
 *     ),
 *     @OA\Property(
 *         property="slug",
 *         title="Slug",
 *         type="string",
 *     ),
 *     @OA\Property(
 *         property="description",
 *         title="Description",
 *         type="string",
 *     ),
 *     @OA\Property(
 *         property="meta_json",
 *         title="Meta JSON",
 *         type="object",
 *         @OA\Property(property="meta_title", title="Meta Title", type="string"),
 *         @OA\Property(property="meta_description", title="Meta Description", type="string"),
 *         @OA\Property(property="meta_keywords", title="Meta Keywords", type="string"),
 *     ),
 *     @OA\Property(
 *         property="active",
 *         title="Active",
 *         type="integer",
 *         format="int32",
 *     ),
 * )
 */
