<?php
use GreenSMS\Tests\Utility;
use GreenSMS\Tests\TestCase;

final class TelegramTest extends TestCase
{
    private $utility = null;

    public function setUp(): void
    {
        $this->utility = new Utility();
    }

    public function testCanSendMessage()
    {
        $phoneNum = $this->utility->getRandomPhone();
        $params = [
          'to' => $phoneNum,
          'txt' => '12345',
        ];

        $response = $this->utility->getInstance()->telegram->send($params);
        $this->assertObjectHasAttribute('request_id', $response);
        return $response->request_id;
    }

    public function testRaisesValidationException()
    {
        try {
            $response = $this->utility->getInstance()->telegram->send([]);
            $this->fail("Shouldn't send Telegram without parameters");
        } catch (Exception $e) {
            $this->assertObjectHasAttribute('message', $e);
            $this->assertEquals('Validation Error', $e->getMessage());
        }
    }

    public function testMinimalTo()
    {
        $this->expectException(\GreenSMS\Http\RestException::class);
        $this->utility->getInstance()->telegram->send([
            'to' => '0123456789',
            'txt' => '12345',
        ]);
    }

    public function testMaximalTo()
    {
        $this->expectException(\GreenSMS\Http\RestException::class);
        $this->utility->getInstance()->telegram->send([
            'to' => '012345678912345',
            'txt' => '12345',
        ]);
    }

    public function testMinimalTxt()
    {
        $this->expectException(\GreenSMS\Http\RestException::class);
        $this->utility->getInstance()->telegram->send([
            'to' => '01234567891',
            'txt' => str_repeat('s',3),
        ]);
    }

    public function testMaximalTxt()
    {
        $this->expectException(\GreenSMS\Http\RestException::class);
        $this->utility->getInstance()->telegram->send([
            'to' => '01234567891',
            'txt' => str_repeat('s',9),
        ]);
    }
}
