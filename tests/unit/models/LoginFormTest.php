<?php
namespace tests\unit\models;

use app\models\LoginForm;
use app\models\User;
use Yii;

class LoginFormTest extends \Codeception\Test\Unit
{
    public function testLoginSuccessful()
    {
        $user = $this->createMock(User::class);
        $user->method('validatePassword')->willReturn(true);

        $model = $this->getMockBuilder(LoginForm::class)
            ->onlyMethods(['getUser'])
            ->getMock();

        $model->expects($this->atLeastOnce())
            ->method('getUser')
            ->willReturn($user);

        $model->username = 'Geraldo';
        $model->password = 'Geraldo';

        $this->assertTrue($model->login());
    }

    public function testLoginIncorrectPassword()
    {
        $user = $this->createMock(User::class);
        $user->method('validatePassword')->willReturn(false);

        $model = $this->getMockBuilder(LoginForm::class)
            ->onlyMethods(['getUser'])
            ->getMock();

        $model->expects($this->atLeastOnce())
            ->method('getUser')
            ->willReturn($user);

        $model->username = 'Geraldo';
        $model->password = 'Batata';

        $this->assertFalse($model->login());
        $this->assertArrayHasKey('password', $model->errors);
    }

    public function testLoginUserNotFound()
    {
        $model = $this->getMockBuilder(LoginForm::class)
            ->onlyMethods(['getUser'])
            ->getMock();

        $model->expects($this->atLeastOnce())
            ->method('getUser')
            ->willReturn(null);

        $model->username = 'Batata';
        $model->password = 'Batata';

        $this->assertFalse($model->login());

        print_r($model->errors);
        $this->assertArrayHasKey('username', $model->errors);
    }
}

