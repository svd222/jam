<?php
/**
 * Created by PhpStorm.
 * User: svd
 * Date: 14.02.19
 * Time: 12:43
 */
namespace common\helpers;

use http\Exception\RuntimeException;
use Yii;
use yii\base\Exception;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\httpclient\Client;

class RestClient
{
    public static $lastResponse;
    /**
     * @param string $base
     * @param string $method
     * @param string $path
     */
    public static function query(string $method, string $resource, $data = [], $asObject = true)
    {
        $apiUrl = Yii::$container->get('baseAPIUri');
        $apiUrl .= $resource;

        if (count($data)) {
            $data = http_build_query($data);
            $data = preg_replace("/%5B[0-9]+%5D=/simU", "%5B%5D=", $data);
        }

        if (!$data) {
            $data = '';
        }

        $client = new Client();
        $response = $client->createRequest()
            ->setFormat(Client::FORMAT_RAW_URLENCODED)
            ->setMethod($method)
            ->setUrl($apiUrl)
            ->addHeaders(['content-type' => 'application/x-www-form-urlencoded'])
            ->setContent($data)
            ->send();
        if ($response->isOk) {
            static::$lastResponse = $response;
            if ($asObject) {
                $response = Json::decode(Json::encode($response->data), false);
            } else {
                $response = $response->data;
            }
            return $response;
        } else {
            throw new Exception(VarDumper::dumpAsString($response));
        }
        return null;
    }
}













