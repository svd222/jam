<?php
/**
 * Created by PhpStorm.
 * User: svd
 * Date: 13.02.19
 * Time: 1:44
 */

namespace common\tests\unit\models;

use Yii;
use common\models\Station;
use common\fixtures\StationFixture;

/**
 * Login form test
 */
class StationTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;

    /**
     * @return array
     */
    public function _fixtures()
    {
        return [
            'station' => [
                'class' => StationFixture::class,
                'dataFile' => codecept_data_dir() . 'station.php'
            ]
        ];
    }

    public function testCorrect()
    {
        $station = $this->tester->grabFixture('station', 0);
        $this->tester->assertEquals(1, $station->id);
        $this->tester->assertTrue($station->validate());
        $this->tester->assertArrayNotHasKey('name', $station->errors);
    }

    public function testInCorrectFirstSymbol()
    {
        $station = $this->tester->grabFixture('station', 1);
        $this->tester->assertEquals(2, $station->id);
        $this->tester->assertFalse($station->validate());
        $this->tester->assertArrayHasKey('name', $station->errors);
        $this->tester->assertEquals($station->errors['name'][0], 'First symbol should be _, digit or english character');
    }

    public function testHaveTooLargeName()
    {
        $station = $this->tester->grabFixture('station', 2);
        $this->tester->assertEquals(3, $station->id);
        $this->tester->assertFalse($station->validate());
        $this->tester->assertArrayHasKey('name', $station->errors);
    }

    public function testSuccessfulSave()
    {
        $station = new Station();
        $station->name = 'station name';
        $this->tester->assertTrue($station->save());
        $this->tester->seeRecord(Station::class, ['name' => 'station name']);
    }

    public function testNotSuccessfulSave()
    {
        $station = new Station();
        $station->name = '';
        $this->tester->assertFalse($station->save());
    }
}
