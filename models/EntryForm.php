<?php

namespace app\models;

use Yii;
use yii\base\Model;

class EntryForm extends Model
{
    public $plant;
    public $date;

    public function rules()
    {
        return [
            [['plant'], 'required'],
            [['date'],'safe']
        ];
    }
}