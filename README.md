Incialmente, garanta que sua máquina tenha Docker e Docker Compose:

- Instale curl: <br/>
`sudo apt update` <br/>
`sudo apt upgrade` <br/>
`sudo apt install curl` 

- Instale Docker e Docker Compose: <br/>
`sudo curl -L "https://github.com/docker/compose/releases/download/1.29.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose` <br/>
`sudo chmod +x /usr/local/bin/docker-compose`

Após fazer o clone do repositório você pode realizar o seguinte comando para já executar o container e fazer o build: <br/>

- Execute (caso esteja configurado para o Docker sempre rodar com 'sudo', não é necessário colocar no inicio do comando): <br/>
`sudo docker-compose up --build`

Agora realize os seguintes comandos: <br/>
`sudo docker exec -it yii2_app composer install` <br/>
`sudo docker exec -it yii2_app bower install jquery --allow-root` <br/>
`sudo docker exec -it yii2_app php yii migrate`

Agora a aplicação já estará rodando em: `http://localhost:8080` 

Para executar os testes unitários, no arquivo raiz do projeto execute: <br/>
`sudo docker exec -it yii2_app vendor/bin/codecept run unit`

Segue agora uma explicação de como usar o Aplicativo:

Inicialmente você pode ir para a aba de Login, onde você pode entrar com sua conta ou criar uma em Registrar.
![2024-08-25_22-55](https://github.com/user-attachments/assets/242f9787-3700-4142-b22a-3ada98d1dd21)

Na aba de Registrar, você coloca seu nome de usuário, sua senha e confirma a senha, depois basta clicar no botão Registrar.
![registrar](https://github.com/user-attachments/assets/7c11fb0f-1ed7-464d-80e1-14c46a2d4d71)

Agora você poderá acessar a sua conta.
![registrar_login](https://github.com/user-attachments/assets/0859aee9-a53e-4d76-810f-a5f3146f1204)


Assim que acessar com sua conta, você poderá acessar a aba de "Tarefas", incialmente não haverá nenhuma, então você já pode criar uma.
![tarefas_vazio](https://github.com/user-attachments/assets/e2892a36-3add-48a7-8c5f-a502a004649c)

Basta preencher todos os campos e salvar.
![criar_tarefa](https://github.com/user-attachments/assets/c8459332-a2e8-4421-84b2-6909a641c16d)

Ao criar sua nova tarefa, você será direcionado a uma visualização das informações salvas da sua Tarefa.
![apos_crair](https://github.com/user-attachments/assets/4702e7be-0f6e-43cc-9bdc-4f986d8d8529)

Voltando para a aba das suas tarefas, vão ser listadas as tarefas cadastradas.
![primeira_tarefa](https://github.com/user-attachments/assets/479dd767-01f5-43c9-bd81-b6a54b34d32b)

Você pode alterar a ordenação dos itens clicando sobre a coluna que deseja mudar a ordenação.
![ordernar](https://github.com/user-attachments/assets/8f8f54e7-e50a-488e-9fb5-8059b0c00738)

Usando o campo de filtro, você pode digitar o que deseja filtrar e apertar a tecla "Enter", para aplicar um filtro.
![filtrar](https://github.com/user-attachments/assets/591c07a5-3ab9-4072-973c-3a56205015f7)

Existem também a função de "Visualizar" as informações da tarefa.
![visualizar](https://github.com/user-attachments/assets/97714f2b-e67f-4f15-874a-41cd962425b6)
![vizualizar1](https://github.com/user-attachments/assets/2ee12b82-32fc-4d17-9b1d-3ed779224def)

A função de "Editar".
![editar](https://github.com/user-attachments/assets/1b772a11-06b2-44cb-9f98-b9db65f4d333)
![edicao_finalizada](https://github.com/user-attachments/assets/280a9968-edb7-493a-a498-2af8741bd12b)

E a de "Deletar".
![deletar](https://github.com/user-attachments/assets/a73919c2-13e5-4c20-8e30-bf32716457bc)
![confirmar_deletar](https://github.com/user-attachments/assets/18f927fa-f808-4fa9-9a8e-59647e631b0a)

É possível sair de sua conta clicando em "Logout".
![logout](https://github.com/user-attachments/assets/de3c9cdb-63c8-4b81-8f7c-3696b7f65f60)

Caso tenham gostado, ficarei feliz em ser contratado.
![Png](https://github.com/user-attachments/assets/ef5b6ef1-7696-4ab3-9448-c982b455821e)






