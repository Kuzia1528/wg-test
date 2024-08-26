<?php

namespace app\services;

use app\models\Image;
use Random\RandomException;
use yii\base\InvalidConfigException;
use yii\httpclient\Client;
use yii\httpclient\Exception;

/**
 * Сервис для работы с Picsum
 */
class PicsumService
{
    /** @var string URL сервиса */
    public const string PICSUM_URL = 'https://picsum.photos/';

    /** @var int Максимальное количество попыток генерации случайного ID */
    private const int MAX_ID_ATTEMPTS = 100;
    /** @var int Максимальное количество попыток загрузки изображения с сервиса */
    private const int MAX_DOWNLOAD_ATTEMPTS = 10;
    /** @var int Начальный ID для генерации случайного ID */
    private const int START_ID = 1;
    /** @var int Конечный ID для генерации случайного ID */
    private const int END_ID = 1000;

    /**
     * Получение изображения с сервиса Picsum
     *
     * @throws Exception
     * @throws InvalidConfigException
     * @throws RandomException
     */
    public function downloadImage(&$id): string
    {
        $attempts = 0;
        while (true) {
            if (!$id) {
                $id = $this->getRandomID();
            }
            $url = self::PICSUM_URL . 'id/' . $id . '/600/500';

            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('GET')
                ->setUrl($url)
                ->send();

            if ($response->isOk) {
                return 'data:image/jpg;base64,' . base64_encode($response->content);
            }

            $id = null;
            $attempts++;
            if ($attempts > self::MAX_DOWNLOAD_ATTEMPTS) {
                throw new \RuntimeException('Не удалось получить изображение');
            }
        }
    }

    /**
     * Получение случайного ID изображения
     *
     * @throws RandomException
     */
    private function getRandomID(): int
    {
        $attempts = 0;
        while (true) {
            $id = random_int(self::START_ID, self::END_ID);
            if (Image::find()->where(['picsum_id' => $id])->exists()) {
                $attempts++;
                if ($attempts > self::MAX_ID_ATTEMPTS) {
                    throw new \Exception('Не удалось получить уникальный ID изображения');
                }
            } else {
                return $id;
            }
        }
    }
}