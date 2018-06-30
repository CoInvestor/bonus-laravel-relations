<?php
namespace thybag\BonusLaravelRelations\Test;

use Orchestra\Testbench\TestCase;
use thybag\BonusLaravelRelations\Test\Models\HasMethodTestModel;

class TestHasMethod extends TestCase
{
    public function testHasMethodWithPublicMethod()
    {
        $test = HasMethodTestModel::make([
            'amount' => 5,
            'value' => 2,
            'product' => 'cake'
        ]);

        $this->assertEquals('Cake', $test->asMethod->product);
        $this->assertEquals(10, $test->asMethod->totalValue);
    }

    public function testHasMethodWithCallback()
    {
        $test = HasMethodTestModel::make([
            'amount' => 5,
            'value' => 3,
            'product' => 'pie'
        ]);

        $this->assertEquals('Pie', $test->asCallback->product);
        $this->assertEquals(15, $test->asCallback->totalValue);
    }

    public function testHasMethodWithPublicMethodForceCollection()
    {
        $test = HasMethodTestModel::make([
            'amount' => 5,
            'value' => 3,
            'product' => 'pie'
        ]);

        $this->assertEquals('Pie', $test->asMethodForceCollection->get('product'));
        $this->assertEquals(2, $test->asMethodForceCollection->count());
    }

    public function testHasMethodWithCallbackReturnedCollection()
    {
        $test = HasMethodTestModel::make();

        $this->assertEquals(1, $test->asCallbackReturnCollection->first());
        $this->assertEquals(3, $test->asCallbackReturnCollection->count());
    }

    public function testHasMethodWithCallbackBadResults()
    {
        $test = HasMethodTestModel::make();

        $this->assertNull($test->callbackNull);
        $this->assertNull($test->callbackEmptyString);
        $this->assertNull($test->callbackEmpty);
    }

    public function testHasMethodWithCallbackArray()
    {
        $test = HasMethodTestModel::make();
        $this->assertEquals('one', $test->callbackAsArray->a);
    }

    public function testHasMethodWithCallbackObject()
    {
        $test = HasMethodTestModel::make();
        $this->assertEquals('one', $test->callbackAsObject->a);
    }
}
