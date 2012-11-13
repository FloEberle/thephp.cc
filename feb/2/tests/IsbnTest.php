<?php
class IsbnTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException ValidateException
     * @expectedExceptionCode ValidateException::INVALID_FORMAT
     */
    public function testThrowsExceptionWhenFormatIsInvalid()
    {
        new Isbn('notaValidIsbn');
    }

    /**
     * @expectedException ValidateException
     * @expectedExceptionCode ValidateException::INVALID_GROUPNR
     */
    public function testThrowsExceptionWhenGroupIsInvalid()
    {
        // 50 = invalid group nr!!
        new Isbn('978-50-49806-056-5');
    }

    /**
     * @expectedException ValidateException
     * @expectedExceptionCode ValidateException::INVALID_LENGTH
     */
    public function testThrowsExceptionWhenLengthIsInvalid()
    {
        new Isbn('978-3-49806-056-5555');
    }

    /**
     * @expectedException ValidateException
     * @expectedExceptionCode ValidateException::INVALID_CHECKSUM
     */
    public function testThrowsExceptionWhenChecksumIsInvalid()
    {
        new Isbn('978-3-49806-056-6');
    }

    public function testIfValidIsbnWorks()
    {
        new Isbn('978-3-49806-056-5');
        new Isbn('978 3 86680 192 9');
        // You reached this position without Exception? Test succesful!
        $this->assertTrue(true);
    }

}