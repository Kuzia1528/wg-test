<?php

namespace app\controllers;

use app\models\Image;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\Response;

class AdminController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function beforeAction($action)
    {
        $token = Yii::$app->request->get('token');
        if ($token !== 'xyz') {
            throw new \yii\web\UnauthorizedHttpException('У вас нет доступа к этой странице');
        }
        return parent::beforeAction($action);
    }

    /**
     * Список изображений и принятых решений
     */
    public function actionIndex()
    {
        $token = Yii::$app->request->get('token');
        $images = Image::find();

        $imagesProvider = new ActiveDataProvider([
            'query' => $images,
            'pagination' => [
                'pageSize' => 100,
                'forcePageParam' => false,
                'pageSizeParam' => false,
            ],
            'sort' => false,
        ]);

        return $this->render('index', [
            'imagesProvider' => $imagesProvider,
            'token' => $token,
        ]);
    }

    /**
     * Удаление принято решения и изображения
     *
     * @param $id
     * @return Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeleteDecision($id): Response
    {
        $image = Image::findOne($id);
        if ($image) {
            return $this->asJson(['success' => $image->delete()]);
        }
        return $this->asJson(['success' => false]);
    }
}
