<?php

class ObjectTest extends PHPUnit_Framework_TestCase {

    public function setUp()
    {
        require_once PRACTICE_ROOT.'/basic/objects.php';
    }

    /**
     * @test
     */
    public function it_should_output_a_description_of_its_legs()
    {
        $creature = new Creature();
        $creature->numLegs = 5;

        $expected = 'I have 5 legs!';
        $actual = $creature->describe();

        $this->assertEquals($expected, $actual);


        $spider = new Spider();

        $expected = 'I have 8 legs!';
        $actual = $spider->describe();

        $this->assertEquals($expected, $actual);


        $blob = new Blob();

        $expected = 'I have 0 legs!';
        $actual = $blob->describe();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     * @group tricky
     */
    public function it_should_properly_pluralize()
    {
        $creature = new Creature();
        $creature->numLegs = 5;

        $expected = 'I have 5 legs!';
        $actual = $creature->describe();

        $this->assertEquals($expected, $actual);


        $creature = new Creature();
        $creature->numLegs = 1;

        $expected = 'I have 1 leg!';
        $actual = $creature->describe();

        $this->assertEquals($expected, $actual);
    }
}
