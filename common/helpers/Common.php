<?php
/**
 * Created by PhpStorm.
 * User: svd
 * Date: 13.02.19
 * Time: 15:39
 */
namespace common\helpers;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Url;

class Common
{
    public function getIntersection(array $items, int $sum)
    {
        $intersection = [];
        foreach ($items as $k => $v) {
            if ($k & $sum) {
                $intersection[$k] = $v;
            }
        }
        return $intersection;
    }

    public function getTravelTime(int $departure_time, int $arrival_time)
    {
        $date1 = new \DateTime(date('Y-m-d H:i:s', $departure_time));
        $date2 = new \DateTime(date('Y-m-d H:i:s', $arrival_time));
        $interval = $date1->diff($date2);
        $d = $interval->format('%d');
        $h = $interval->format('%h');
        $i = $interval->format('%i');
        $diff = $d ? $d . ' days' : '';
        $diff .= $diff ? ' ' : '';
        $diff .= $h ? $h . ' hours' : '';
        $diff .= $diff ? ' ' : '';
        $diff .= $i ? $i . ' minutes' : '';
        return $diff;
    }

    public function getBitSum(array $arr)
    {
        return array_reduce($arr,
            function ($carry, $item) {
                return $carry | $item;
            },
            0);
    }

    /*public function getBaseAPIUri()
    {

    }*/

//    before save
//    $this->schedule_by_day_of_week = array_reduce($this->schedule_by_day_of_week, function ($summ, $item) {return $summ | $item;}, 0);

//    after find
//    $this->schedule_by_day_of_week = $this->getDays($this->schedule_by_day_of_week);
}