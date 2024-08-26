<?php

namespace tests\unit\models;

use app\models\SignupForm;
use app\models\Tarefa;
use app\models\User;
use Codeception\Test\Unit;

class TarefaTest extends Unit
{
    public function testCreateValidTarefa()
    {
        $signupForm = new SignupForm();
        $signupForm->username = 'Batata';
        $signupForm->password = 'Batata';
        $signupForm->confirm_password = 'Batata';
        $user = $signupForm->signup();

        $this->assertNotNull($user);
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('Batata', $user->username);

        $tarefa = new Tarefa();
        $tarefa->titulo = 'Tarefa 1';
        $tarefa->descricao = 'Descrição 1';
        $tarefa->status = 'pendente';
        $tarefa->data_vencimento = '2024-12-31';
        $tarefa->user_id = $user->id;

        $this->assertTrue($tarefa->save());

        $this->assertNotNull($tarefa->id);
        $this->assertEquals('Nova Tarefa', $tarefa->titulo);
        $this->assertEquals('pendente', $tarefa->status);
        $this->assertEquals($user->id, $tarefa->user_id);
    }

    public function testCreateInvalidTarefa()
    {
        $signupForm = new SignupForm();
        $signupForm->username = 'Mauricio';
        $signupForm->password = 'Mauricio';
        $signupForm->confirm_password = 'Mauricio';
        $user = $signupForm->signup();

        $this->assertNotNull($user);
        $this->assertInstanceOf(User::class, $user);

        $tarefa = new Tarefa();
        $tarefa->descricao = 'Tarefa 1';
        $tarefa->status = 'pendente';
        $tarefa->data_vencimento = '2024-12-31';
        $tarefa->user_id = $user->id;

        $this->assertFalse($tarefa->save());

        $errors = $tarefa->getErrors();
        $this->assertArrayHasKey('titulo', $errors);
    }

    public function testUpdateTarefa()
    {
        $signupForm = new SignupForm();
        $signupForm->username = 'Batata';
        $signupForm->password = 'Batata';
        $signupForm->confirm_password = 'Batata';
        $user = $signupForm->signup();

        $this->assertNotNull($user);
        $this->assertInstanceOf(User::class, $user);

        $tarefa = new Tarefa();
        $tarefa->titulo = 'Tarefa 1';
        $tarefa->descricao = 'Tarefa 1';
        $tarefa->status = 'pendente';
        $tarefa->data_vencimento = '2024-12-31';
        $tarefa->user_id = $user->id;
        $tarefa->save();

        $tarefa->titulo = 'Tarefa 2';
        $tarefa->descricao = 'Tarefa 2';
        $this->assertTrue($tarefa->save());

        $tarefaAtualizada = Tarefa::findOne($tarefa->id);
        $this->assertEquals('Tarefa Atualizada', $tarefaAtualizada->titulo);
        $this->assertEquals('Descrição atualizada', $tarefaAtualizada->descricao);
    }

    public function testDeleteTarefa()
    {
        $signupForm = new SignupForm();
        $signupForm->username = 'Batata';
        $signupForm->password = 'Batata';
        $signupForm->confirm_password = 'Batata';
        $user = $signupForm->signup();

        $this->assertNotNull($user);
        $this->assertInstanceOf(User::class, $user);

        $tarefa = new Tarefa();
        $tarefa->titulo = 'Tarefa 1';
        $tarefa->descricao = 'Tarefa 1';
        $tarefa->status = 'pendente';
        $tarefa->data_vencimento = '2024-12-31';
        $tarefa->user_id = $user->id;
        $tarefa->save();

        $tarefaId = $tarefa->id;
        $rowsDeleted = $tarefa->delete();
        $this->assertGreaterThan(0, $rowsDeleted);

        $tarefaDeletada = Tarefa::findOne($tarefaId);
        $this->assertNull($tarefaDeletada);
    }

    public function testTarefaUserAssociation()
    {
        $signupForm = new SignupForm();
        $signupForm->username = 'Batata';
        $signupForm->password = 'Batata';
        $signupForm->confirm_password = 'Batata';
        $user = $signupForm->signup();

        $this->assertNotNull($user);
        $this->assertInstanceOf(User::class, $user);

        $tarefa = new Tarefa();
        $tarefa->titulo = 'Tarefa 1';
        $tarefa->descricao = 'Tarefa 1';
        $tarefa->status = 'pendente';
        $tarefa->data_vencimento = '2024-12-31';
        $tarefa->user_id = $user->id;
        $tarefa->save();

        $this->assertEquals($user->id, $tarefa->user_id);
        $this->assertEquals('Batata', $tarefa->user->username);
    }
}