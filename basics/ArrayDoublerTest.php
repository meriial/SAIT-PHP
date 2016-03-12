<?php

class ArrayDoublerTest extends PHPUnit_Framework_TestCase {

    public function setUp()
    {
        require_once 'basic/arrays.php';
    }

    /**
     * @test
     */
    public function it_should_do_something()
    {
        $actual = arrayDoubler([1,2,3,4], 1);

        $expected = [
            1, 2, 3, 4
        ];

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_should_do_something_2()
    {
        $actual = arrayDoubler([1,2,3,4], 2);

        $expected = [
            2, 4, 6, 8
        ];

        $this->assertEquals($expected, $actual);
    }

}
