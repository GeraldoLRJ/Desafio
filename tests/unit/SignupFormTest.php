<?php
namespace tests\unit\models;

use app\models\SignupForm;
use app\models\User;
use Yii;

class SignupFormTest extends \Codeception\Test\Unit
{
    public function testSignupSuccessful()
    {
        $userMock = $this->getMockBuilder(User::class)
            ->onlyMethods(['save'])
            ->getMock();

        $userMock->expects($this->once())
            ->method('save')
            ->willReturn(true);

        $modelMock = $this->getMockBuilder(SignupForm::class)
            ->onlyMethods(['validate', 'createUserInstance'])
            ->getMock();

        $modelMock->expects($this->once())
            ->method('validate')
            ->willReturn(true);

        $modelMock->expects($this->once())
            ->method('createUserInstance')
            ->willReturn($userMock);

        $modelMock->username = 'Batata';
        $modelMock->password = 'Batata';
        $modelMock->confirm_password = 'Batata';

        $this->assertInstanceOf(User::class, $modelMock->signup());
    }

    public function testSignupUsernameTaken()
    {
        $userMock = $this->getMockBuilder(User::class)
            ->onlyMethods(['findByUsername'])
            ->getMock();

        $userMock->method('findByUsername')
            ->willReturn(new User());

        $modelMock = $this->getMockBuilder(SignupForm::class)
            ->onlyMethods(['validate'])
            ->getMock();

        $modelMock->expects($this->once())
            ->method('validate')
            ->willReturn(false);

        $modelMock->addError('username', 'This username has already been taken.');

        $modelMock->username = 'Geraldo';
        $modelMock->password = 'Geraldo';
        $modelMock->confirm_password = 'Geraldo';

        $this->assertNull($modelMock->signup());
        $this->assertArrayHasKey('username', $modelMock->errors);
    }

    public function testSignupPasswordsDoNotMatch()
    {
        $modelMock = $this->getMockBuilder(SignupForm::class)
            ->onlyMethods(['validate'])
            ->getMock();

        $modelMock->expects($this->once())
            ->method('validate')
            ->willReturn(false);

        $modelMock->addError('confirm_password', 'Passwords do not match.');

        $modelMock->username = 'Batata';
        $modelMock->password = 'Geraldo';
        $modelMock->confirm_password = 'Batata';

        $this->assertNull($modelMock->signup());
        $this->assertArrayHasKey('confirm_password', $modelMock->errors);
    }
}