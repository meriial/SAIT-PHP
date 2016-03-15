<?php

class SelectTest extends TestCase {

    public function setUp()
    {
        parent::setUp();

        $this->requireOnce(PRACTICE_ROOT.'/forms/functions.php');
    }

    /**
     * @test
     */
    public function it_should_return_a_select_element_with_options()
    {

        $arrayOfOptions = [
            'AB' => 'Alberta',
            'ON' => 'Ontario',
            'MB' => 'Manitoba'
        ];

        $actual = generateSelect($arrayOfOptions);

        $expected = <<<"OPTIONS"
<select>
    <option value="AB">Alberta</option>
    <option value="ON">Ontario</option>
    <option value="MB">Manitoba</option>
</select>
OPTIONS;

        $this->assertEquals($expected, $actual);
    }

}
