<?php

use function Collect\collection;
use PHPUnit\Framework\TestCase;


require __DIR__ . '\..\src\Collect.php';
require __DIR__ . '\..\src\helpers.php';
class CollectTest extends TestCase
{
    public function testValues()
    {
        $collect = new \Collect\Collect(['key1' => 13, 'key2' => 17]);
        $values = $collect->values();
        $this->assertSame([13, 17], $values->toArray());
    }

    public function testGetWithKey()
    {
        $collect = new \Collect\Collect(['key1' => 13, 'key2' => 17]);
        $value = $collect->get('key1');
        $this->assertSame(13, $value);
    }

    public function testGetWithoutKey()
    {
        $collect = new \Collect\Collect(['key1' => 13, 'key2' => 17]);
        $value = $collect->get();
        $this->assertSame(['key1' => 13, 'key2' => 17], $value);
    }

    public function testExcept()
    {
        $ars = array(0 => ["one" => 1, "five" => 5], 5 => "five");
        $collect = new Collect\Collect($ars);
        $this->assertSame(collection(["one" => 1, "five" => 5]), $collect->except(...$ars));
    }

    public function testOnly()
    {
        $collect = new \Collect\Collect(['key1' => 13, 'key2' => 17, 'key3' => 22]);
        $only = $collect->only('key1', 'key3');
        $this->assertSame(['key1' => 13, 'key3' => 22], $only->toArray());
    }

    public function testFirst()
    {
        $collect = new \Collect\Collect(['key1' => 13, 'key2' => 17, 'key3' => 22]);
        $first = $collect->first();
        $this->assertSame(13, $first);
    }

    public function testCount()
    {
        $collect = new \Collect\Collect(['key1' => 13, 'key2' => 17, 'key3' => 22]);
        $count = $collect->count();
        $this->assertSame(3, $count);
    }

    public function testToArray()
    {
        $collect = new \Collect\Collect(['key1' => 13, 'key2' => 17, 'key3' => 22]);
        $array = $collect->toArray();
        $this->assertSame(['key1' => 13, 'key2' => 17, 'key3' => 22], $array);
    }

    public function testSearch()
    {
        $collect = new \Collect\Collect([
            ['id' => 1, 'name' => 'John'],
            ['id' => 2, 'name' => 'Jane'],
            ['id' => 3, 'name' => 'Doe']
        ]);
        $result = $collect->search('id', 2);
        $this->assertSame([['id' => 2, 'name' => 'Jane']], $result->toArray());
    }

    public function testMap()
    {
        $collect = new \Collect\Collect([1, 2, 3]);
        $result = $collect->map(function($item) {
            return $item * 2;
        });
        $this->assertSame([2, 4, 6], $result->toArray());
    }

    public function testFilter()
    {
        $collect = new \Collect\Collect([1, 2, 3, 4, 5]);
        $result = $collect->filter(function($item) {
            return $item % 2 == 0;
        });
        $this->assertSame([1 => 2, 3 => 4], $result->toArray());
    }

    public function testEach()
    {
        $collect = new \Collect\Collect(['John', 'Jane', 'Doe']);
        $collect->each(function($item, $key) {
            $this->assertNotEmpty($item);
            $this->assertIsInt($key);
        });
    }

    public function testPush()
    {
        $collect = new \Collect\Collect([1, 2]);
        $collect->push(3);
        $this->assertSame([1, 2, 3], $collect->toArray());
    }

    public function testUnshift()
    {
        $collect = new \Collect\Collect([2, 3]);
        $collect->unshift(1);
        $this->assertSame([1, 2, 3], $collect->toArray());
    }

    public function testShift()
    {
        $collect = new \Collect\Collect([1, 2, 3]);
        $collect->shift();
        $this->assertSame([2, 3], $collect->toArray());
    }

    public function testPop()
    {
        $collect = new \Collect\Collect([1, 2, 3]);
        $collect->pop();
        $this->assertSame([1, 2], $collect->toArray());
    }

    public function testSplice()
    {
        $collect = new \Collect\Collect([1, 2, 3, 4, 5]);
        $this->assertSame([1, 2, 5], array($collect->splice([2, 2])));
    }
}