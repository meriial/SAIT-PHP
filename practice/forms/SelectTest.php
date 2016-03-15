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

    /**
     * @test
     */
    public function it_should_return_a_group_of_radio_buttons()
    {

        $arrayOfOptions = [
            'AB' => 'Alberta',
            'ON' => 'Ontario',
            'MB' => 'Manitoba'
        ];

        $actual = generateRadioGroup($arrayOfOptions);

        $expected = <<<"OPTIONS"
<input type="radio" value="AB" name="province" /><label>Alberta</label>
<input type="radio" value="ON" name="province" /><label>Ontario</label>
<input type="radio" value="MB" name="province" /><label>Manitoba</label>
OPTIONS;

        $this->assertEquals($expected, $actual);
    }

}
