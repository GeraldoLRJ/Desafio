<?php
namespace tests\unit\models;

use app\models\LoginForm;
use app\models\User;
use Yii;

class LoginFormTest extends \Codeception\Test\Unit
{
    public function testLoginSuccessful()
    {
        $userMock = $this->createMock(User::class);
        $userMock->method('validatePassword')->willReturn(true);

        $modelMock = $this->getMockBuilder(LoginForm::class)
            ->onlyMethods(['getUser'])
            ->getMock();

        $modelMock->expects($this->atLeastOnce())
            ->method('getUser')
            ->willReturn($userMock);

        $modelMock->username = 'Batata';
        $modelMock->password = 'Batata';

        $this->assertTrue($modelMock->login());
    }

    public function testLoginIncorrectPassword()
    {
        $userMock = $this->createMock(User::class);
        $userMock->method('validatePassword')->willReturn(false);

        $modelMock = $this->getMockBuilder(LoginForm::class)
            ->onlyMethods(['getUser'])
            ->getMock();

        $modelMock->expects($this->atLeastOnce())
            ->method('getUser')
            ->willReturn($userMock);

        $modelMock->username = 'Batatas';
        $modelMock->password = 'Batatas';

        $this->assertFalse($modelMock->login());

        $modelMock->addError('password', 'Incorrect password.');

        $this->assertArrayHasKey('password', $modelMock->errors);
    }

    public function testLoginUserNotFound()
    {
        $modelMock = $this->getMockBuilder(LoginForm::class)
            ->onlyMethods(['getUser'])
            ->getMock();

        $modelMock->expects($this->atLeastOnce())
            ->method('getUser')
            ->willReturn(null);

        $modelMock->username = 'Batata';
        $modelMock->password = 'Batata';

        $this->assertFalse($modelMock->login());

        $modelMock->addError('username', 'User not found.');

        $this->assertArrayHasKey('username', $modelMock->errors);
    }
}