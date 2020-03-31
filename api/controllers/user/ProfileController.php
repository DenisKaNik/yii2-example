<?php

namespace api\controllers\user;

use api\helpers\DateHelper;
use library\entities\User\User;
use library\helpers\UserHelper;
use yii\rest\Controller;

class ProfileController extends Controller
{
    /**
     * @OA\Get(
     *     path="/profile",
     *     tags={"Profile"},
     *     description="Returns profile info",
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
     *         description="Success response",
     *         @OA\JsonContent(ref="#/components/schemas/User"),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid token supplier"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Profile not found"
     *     ),
     *     security={{"bearerAuth": {}, "OAuth2": {}}}
     * )
     */
    public function actionIndex(): array
    {
        return $this->serializeUser($this->findModel());
    }

    public function verbs(): array
    {
        return [
            'index' => ['get'],
        ];
    }

    private function findModel(): User
    {
        return User::findOne(\Yii::$app->user->id);
    }

    private function serializeUser(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->username,
            'email' => $user->email,
            'date' => [
                'created' => DateHelper::formatApi($user->created_at),
                'updated' => DateHelper::formatApi($user->updated_at),
            ],
            'status' => [
                'code' => $user->status,
                'name' => UserHelper::statusName($user->status),
            ],
        ];
    }
}

/**
 * @OA\Schema(
 *     schema="User",
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
 *         property="email",
 *         title="Email",
 *         type="string",
 *     ),
 *     @OA\Property(
 *         property="date",
 *         title="Date",
 *         type="object",
 *         @OA\Property(property="created", title="Created", type="string"),
 *         @OA\Property(property="updated", title="Updated", type="string"),
 *     ),
 *     @OA\Property(
 *         property="status",
 *         title="Status",
 *         type="object",
 *         @OA\Property(property="code", title="Code", type="integer", format="int32"),
 *         @OA\Property(property="name", title="Name", type="string"),
 *     ),
 * )
 */
