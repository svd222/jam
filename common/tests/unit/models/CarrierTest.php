<?php
/**
 * Created by PhpStorm.
 * User: svd
 * Date: 13.02.19
 * Time: 1:44
 */

namespace common\tests\unit\models;

use common\fixtures\CarrierFixture;
use common\models\Carrier;

/**
 * Login form test
 */
class CarrierTest extends \Codeception\Test\Unit
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
            'carrier' => [
                'class' => CarrierFixture::class,
                'dataFile' => codecept_data_dir() . 'carrier.php'
            ]
        ];
    }

    public function testCorrect()
    {
        $carrier = $this->tester->grabFixture('carrier', 0);
        $this->tester->assertEquals(1, $carrier->id);
        $this->tester->assertTrue($carrier->validate());
        $this->tester->assertArrayNotHasKey('name', $carrier->errors);
    }

    public function testInCorrectFirstSymbol()
    {
        $carrier = $this->tester->grabFixture('carrier', 1);
        $this->tester->assertEquals(2, $carrier->id);
        $this->tester->assertFalse($carrier->validate());
        $this->tester->assertArrayHasKey('name', $carrier->errors);
        $this->tester->assertEquals($carrier->errors['name'][0], 'First symbol should be _, digit or english character');
    }

    public function testHaveTooSmallName()
    {
        $carrier = $this->tester->grabFixture('carrier', 2);
        $this->tester->assertEquals(3, $carrier->id);
        $this->tester->assertFalse($carrier->validate());
        $this->tester->assertArrayHasKey('name', $carrier->errors);
    }

    public function testHaveTooLargeName()
    {
        $carrier = $this->tester->grabFixture('carrier', 3);
        $this->tester->assertEquals(4, $carrier->id);
        $this->tester->assertFalse($carrier->validate());
        $this->tester->assertArrayHasKey('name', $carrier->errors);
    }

    public function testSuccessfulSave()
    {
        $carrier = new Carrier();
        $carrier->name = 'carrier name';
        $this->tester->assertTrue($carrier->save());
        $this->tester->seeRecord(Carrier::class, ['name' => 'carrier name']);
    }

    public function testNotSuccessfulSave()
    {
        $carrier = new Carrier();
        $carrier->name = '';
        $this->tester->assertFalse($carrier->save());
    }
}
