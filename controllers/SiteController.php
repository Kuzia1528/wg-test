<?php

namespace app\controllers;

use app\services\PicsumService;
use app\models\ApproveForm;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Главная страница
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Получение изображения с сервиса Picsum
     *
     * @return Response
     */
    public function actionGetImage(): Response
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $id = null;
            $image = (new PicsumService())->downloadImage($id);
            return $this->asJson(['id' => $id, 'image' => $image]);
        } catch (\Exception $e) {
            Yii::error($e->getMessage());
            throw new \RuntimeException('Произошла неизвестная ошибка');
        }
    }

    /**
     * Сохранение принятого решения
     *
     * @return Response
     */
    public function actionDecision(): Response
    {
        $model = new ApproveForm();
        if ($model->load(Yii::$app->request->post(), '') && $model->save()) {
            return $this->asJson(['success' => true]);
        }
        throw new \BadRequestHttpException('Не удалось сохранить решение');
    }
}
