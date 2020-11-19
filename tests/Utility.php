<?php

namespace GreenSMS\Tests;

use GreenSMS\GreenSMS;

class Utility
{
    public function getInstance()
    {
        $client = new GreenSMS([
          'user' => 'test',
          'pass' => 'test'
        ]);

        return $client;
    }

    public function getRandomPhone($min = 70000000111, $max = 70009999999)
    {
        $phoneNum = $this->getRandomNumber($min, $max);
        return $phoneNum;
    }

    public function getRandomNumber($min, $max)
    {
        return strval(rand($min, $max));
    }

    public function getTestToken()
    {
        return 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoidGVzdCIsImlhdCI6MTYwNTc5NjEwOCwiaXNzIjoiYXBpLmdyZWVuc21zLnJ1In0.St8-5fJqQnHx1MFybJ5o4D5VZ-RK3HxcL0DScJsOYec';
    }

    public function getInstanceWithEnv()
    {
        putenv('GREENSMS_USER=test');
        putenv('GREENSMS_PASS=test');
        $envClient = new GreenSMS();

        // Unsetting the env variable after use
        putenv('GREENSMS_USER');
        putenv('GREENSMS_PASS');

        return $envClient;
    }
}
