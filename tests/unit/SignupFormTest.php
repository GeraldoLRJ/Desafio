<?php
namespace tests\unit\models;

use app\models\SignupForm;
use app\models\User;
use Yii;

class SignupFormTest extends \Codeception\Test\Unit
{
    public function testSignupSuccessful()
    {
        $user = $this->getMockBuilder(User::class)
            ->onlyMethods(['save'])
            ->getMock();
        $user->expects($this->once())->method('save')->willReturn(true);

        $model = $this->getMockBuilder(SignupForm::class)
            ->onlyMethods(['validate', 'createUserInstance'])
            ->getMock();

        $model->expects($this->once())->method('validate')->willReturn(true);
        $model->expects($this->once())->method('createUserInstance')->willReturn($user);

        $model->username = 'Batata';
        $model->password = 'Batata';
        $model->confirm_password = 'Batata';

        $this->assertInstanceOf(User::class, $model->signup());
    }
    public function testSignupUsernameTaken()
    {
        $user = $this->getMockBuilder(User::class)
            ->onlyMethods(['findByUsername'])
            ->getMock();
        $user->method('findByUsername')->willReturn(new User());

        $model = new SignupForm();
        $model->username = 'Geraldo';
        $model->password = 'Geraldo';
        $model->confirm_password = 'Geraldo';

        $this->assertNull($model->signup());
        $this->assertArrayHasKey('username', $model->errors);
    }

    public function testSignupPasswordsDoNotMatch()
    {
        $model = new SignupForm();
        $model->username = 'Batata';
        $model->password = 'Geraldo';
        $model->confirm_password = 'Batata';

        $this->assertNull($model->signup());
        $this->assertArrayHasKey('confirm_password', $model->errors);
    }
}

