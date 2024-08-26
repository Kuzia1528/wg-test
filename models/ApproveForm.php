<?php

namespace app\models;

use app\models\Image;
use app\models\User;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class ApproveForm extends Model
{
    private const int DECISION_REJECT = 1;
    private const int DECISION_APPROVE = 2;

    public int $picsum_id;
    public int $decision;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['picsum_id', 'decision'], 'required'],
            ['picsum_id', 'integer'],
            ['decision', 'integer'],
            ['decision', 'in', 'range' => [self::DECISION_APPROVE, self::DECISION_REJECT]],
        ];
    }

    public function save()
    {
        $model = new Image();
        $model->picsum_id = $this->picsum_id;
        $model->approved = $this->decision === self::DECISION_APPROVE;
        return $model->save();
    }
}
