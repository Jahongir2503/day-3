<?php

use PHPUnit\Framework\TestCase;
use Collects\Collect;
require __DIR__ . '\..\src\Collect.php';

class CollectTest extends TestCase
{
    public function testCount()
    {

        $collect = new Collect([13,17]);
        $this->assertSame(2, $collect->count());
    }

}