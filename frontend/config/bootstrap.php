<?php
use Yii;
use yii\helpers\Url;
use yii\base\InvalidConfigException;

Yii::$container->set('baseAPIUri', function ($container, $config, $params) {
    $base = Url::base(true);
    $currentScheme = preg_match('/http:\/\//mis', $base) ? 'http' : 'https';
    if (strlen($base) > 1) {
        $base = preg_replace('/http[s]?:\/\//mis', '', $base);
    } else {
        if (Yii::$app->params['baseAPIUri']) {
            $base = Yii::$app->params['baseAPIUri'];
        } else {
            throw new InvalidConfigException('Please set `baseAPIUri param in frontend/config/params-local.conf` for example api.huskyjam.local');
        }
    }
    if ($base) {
        $base = $currentScheme . '://api.'.$base;
    }
    return $base;
});