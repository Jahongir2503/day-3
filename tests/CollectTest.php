<?php

use PHPUnit\Framework\TestCase;
use Collects\Collect;

require __DIR__ . '\..\src\Collect.php';

class CollectTest extends TestCase
{
    public function testCount()
    {
        $collect = new Collect([13, 17, 12]);
        $this->assertSame(3, $collect->count());
    }

}