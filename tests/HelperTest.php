<?php

use Shopreview\Helper;

class HelperTest extends PHPUnit_Framework_TestCase
{
    public function testRandomStringFunctionGeneratedRandomStringLength()
    {
        $strLen = strlen(Helper::getRandomString());
        $this->assertEquals(8, $strLen);
    }

    public function inputNumbers()
    {
        return array(
            array(1.5),
            array(-6),
            array('a'),
        );
    }

    /**
     * @expectedException InvalidArgumentException
     * @dataProvider inputNumbers
     */
    public function testRandomStringFunctionThrowsExceptionIfNonPositiveIntegerPassed($n)
    {
        Helper::getRandomString($n);
    }

    public function inputStrings()
    {
        return array(
            array("<script>alert('test');</script>"),
            array("<p></p>")
        );
    }

    /**
     * @dataProvider inputStrings
     */
    public function testSanitizeInputFunctionToRemoveScriptTags($s)
    {
        $sanitized = Helper::sanitizeInput($s);
        $this->assertEmpty($sanitized);
    }
}
