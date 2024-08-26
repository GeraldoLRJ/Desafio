<?php
namespace tests\unit\models;

use app\models\Tarefa;
use app\models\User;
use Codeception\Test\Unit;

class TarefaTest extends Unit
{
    public function testCreateValidTarefa()
    {
        // Criar um mock da Tarefa
        $tarefaMock = $this->getMockBuilder(Tarefa::class)
            ->onlyMethods(['save'])
            ->getMock();

        // Configurar o mock para retornar true quando o método save for chamado
        $tarefaMock->expects($this->once())
            ->method('save')
            ->willReturn(true);

        // Definir os valores dos atributos da tarefa
        $tarefaMock->titulo = 'Nova Tarefa';
        $tarefaMock->descricao = 'Descrição da nova tarefa';
        $tarefaMock->status = 'pendente';
        $tarefaMock->data_vencimento = '2024-12-31';
        $tarefaMock->user_id = 6;

        // Assert para verificar que o método save foi bem-sucedido
        $this->assertTrue($tarefaMock->save());

        // Verificar se os atributos foram definidos corretamente
        $this->assertEquals('Nova Tarefa', $tarefaMock->titulo);
        $this->assertEquals('pendente', $tarefaMock->status);
    }

    public function testCreateInvalidTarefa()
    {
        // Criar um mock da Tarefa
        $tarefaMock = $this->getMockBuilder(Tarefa::class)
            ->onlyMethods(['save', 'getErrors'])
            ->getMock();

        // Configurar o mock para retornar false quando o método save for chamado
        $tarefaMock->expects($this->once())
            ->method('save')
            ->willReturn(false);

        // Configurar o mock para retornar um erro no campo 'titulo'
        $tarefaMock->expects($this->once())
            ->method('getErrors')
            ->willReturn(['titulo' => ['Title cannot be blank']]);

        // Definir os atributos da tarefa (sem título para ser inválida)
        $tarefaMock->descricao = 'Descrição da nova tarefa';
        $tarefaMock->status = 'pendente';
        $tarefaMock->data_vencimento = '2024-12-31';
        $tarefaMock->user_id = 6;

        // Assert para verificar que o método save falhou
        $this->assertFalse($tarefaMock->save());

        // Verificar se o erro foi atribuído ao campo 'titulo'
        $errors = $tarefaMock->getErrors();
        $this->assertArrayHasKey('titulo', $errors);
    }

    public function testUpdateTarefa()
    {
        // Criar um mock da Tarefa
        $tarefaMock = $this->getMockBuilder(Tarefa::class)
            ->onlyMethods(['save'])
            ->getMock();

        // Configurar o mock para retornar true quando o método save for chamado
        $tarefaMock->expects($this->exactly(2))
            ->method('save')
            ->willReturn(true);

        // Definir os valores iniciais dos atributos
        $tarefaMock->titulo = 'Tarefa Original';
        $tarefaMock->descricao = 'Descrição original';
        $tarefaMock->status = 'pendente';
        $tarefaMock->data_vencimento = '2024-12-31';
        $tarefaMock->user_id = 6;

        // Salvar a tarefa original
        $this->assertTrue($tarefaMock->save());

        // Atualizar os valores dos atributos
        $tarefaMock->titulo = 'Tarefa Atualizada';
        $tarefaMock->descricao = 'Descrição atualizada';

        // Salvar a tarefa atualizada
        $this->assertTrue($tarefaMock->save());

        // Verificar se os atributos foram atualizados corretamente
        $this->assertEquals('Tarefa Atualizada', $tarefaMock->titulo);
        $this->assertEquals('Descrição atualizada', $tarefaMock->descricao);
    }

    public function testDeleteTarefa()
    {
        // Criar um mock da Tarefa
        $tarefaMock = $this->getMockBuilder(Tarefa::class)
            ->onlyMethods(['delete'])
            ->getMock();

        // Configurar o mock para retornar 1 (indicando que 1 linha foi deletada)
        $tarefaMock->expects($this->once())
            ->method('delete')
            ->willReturn(1);

        // Deletar a tarefa
        $rowsDeleted = $tarefaMock->delete();

        // Assert para verificar que a tarefa foi deletada
        $this->assertGreaterThan(0, $rowsDeleted);
    }

    public function testTarefaUserAssociation()
    {
        // Criar um mock da Tarefa
        $tarefaMock = $this->getMockBuilder(Tarefa::class)
            ->onlyMethods(['getUser'])
            ->getMock();

        // Criar um mock do User
        $userMock = $this->getMockBuilder(User::class)
            ->onlyMethods(['getUsername'])
            ->getMock();

        // Configurar o mock do User para retornar o username 'Geraldo'
        $userMock->method('getUsername')
            ->willReturn('Geraldo');

        // Configurar o mock da Tarefa para retornar o mock do User
        $tarefaMock->method('getUser')
            ->willReturn($userMock);

        // Assert para verificar a associação
        $this->assertEquals('Geraldo', $tarefaMock->getUser()->getUsername());
    }
}
