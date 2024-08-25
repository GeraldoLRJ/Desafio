<?php


namespace tests\unit\models;

use app\models\Tarefa;
use Yii;
use \UnitTester;

class TarefaTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    public function testCreateValidTarefa()
    {
        $tarefa = new Tarefa();
        $tarefa->titulo = 'Nova Tarefa';
        $tarefa->descricao = 'Descrição da nova tarefa';
        $tarefa->status = 'pendente';
        $tarefa->data_vencimento = '2024-12-31';
        $tarefa->user_id = 6; // Certifique-se de que este usuário existe no banco de dados de teste

        $this->assertTrue($tarefa->save());

        // Verifique se a tarefa foi salva corretamente
        $this->assertNotNull($tarefa->id);
        $this->assertEquals('Nova Tarefa', $tarefa->titulo);
        $this->assertEquals('pendente', $tarefa->status);
    }

    public function testCreateInvalidTarefa()
    {
        $tarefa = new Tarefa();
        $tarefa->descricao = 'Descrição da nova tarefa';
        $tarefa->status = 'pendente';
        $tarefa->data_vencimento = '2024-12-31';
        $tarefa->user_id = 6;

        $this->assertFalse($tarefa->save());

        $errors = $tarefa->getErrors();
        $this->assertArrayHasKey('titulo', $errors);
    }

    public function testUpdateTarefa()
    {
        $tarefa = new Tarefa();
        $tarefa->titulo = 'Tarefa Original';
        $tarefa->descricao = 'Descrição original';
        $tarefa->status = 'pendente';
        $tarefa->data_vencimento = '2024-12-31';
        $tarefa->user_id = 6;
        $tarefa->save();

        $tarefa->titulo = 'Tarefa Atualizada';
        $tarefa->descricao = 'Descrição atualizada';
        $this->assertTrue($tarefa->save());

        $tarefaAtualizada = Tarefa::findOne($tarefa->id);
        $this->assertEquals('Tarefa Atualizada', $tarefaAtualizada->titulo);
        $this->assertEquals('Descrição atualizada', $tarefaAtualizada->descricao);
    }

    public function testDeleteTarefa()
    {
        $tarefa = new Tarefa();
        $tarefa->titulo = 'Tarefa para Deletar';
        $tarefa->descricao = 'Descrição da tarefa para deletar';
        $tarefa->status = 'pendente';
        $tarefa->data_vencimento = '2024-12-31';
        $tarefa->user_id = 6;
        $tarefa->save();

        $tarefaId = $tarefa->id;
        $rowsDeleted = $tarefa->delete();

        $this->assertGreaterThan(0, $rowsDeleted);

        $tarefaDeletada = Tarefa::findOne($tarefaId);
        $this->assertNull($tarefaDeletada);
    }

    public function testTarefaUserAssociation()
    {
        $tarefa = Tarefa::findOne(5);
        $this->assertEquals(6, $tarefa->user_id);

        $user = $tarefa->user;
        $this->assertEquals('Geraldo', $user->username);
    }
}
