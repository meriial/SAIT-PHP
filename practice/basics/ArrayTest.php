<?php

class ArrayTest extends TestCase {

    public function setUp()
    {
        parent::setUp();

        $this->requireOnce(PRACTICE_ROOT.'/basic/arrays.php');
        $this->assertFunctionExists('arrayDoubler');
    }

    /**
     * @test
     */
    public function it_should_multiply_the_input()
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
    public function it_should_multiply_the_input_2()
    {
        $actual = arrayDoubler([1,2,3,4], 2);

        $expected = [
            2, 4, 6, 8
        ];

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     *
     * Input is an associative array where
     * $key = [name]
     * $value = [address]
     *
     * Output is an array of strings with the format
     * [name] lives at: [address]
     */
    public function it_should_handle_associative_arrays()
    {
        $input = [
            'Bob' => '123 Main Street',
            'Jane' => '16 Philpot Avenue'
        ];

        $expected = [
            "Bob lives at: 123 Main Street",
            "Jane lives at: 16 Philpot Avenue"
        ];

        $actual = listAddresses($input);

        $this->assertEquals($expected, $actual);


        $input = [];
        $expected = [];
        $count = 10;

        for ($i=0; $i < $count; $i++) {
            $name = $this->faker->name;
            $address = $this->faker->address;
            $input[$name] = $address;
            $expected[] = "$name lives at: $address";
        }

        $actual = listAddresses($input);

        $this->assertEquals($expected, $actual);
    }



}
