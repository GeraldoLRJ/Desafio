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

Assim que acessar com sua conta, você poderá acessar a aba de Tarefas, incialmente não haverá nenhuma, então você já pode criar uma.
![tarefas_vazio](https://github.com/user-attachments/assets/e2892a36-3add-48a7-8c5f-a502a004649c)

basta preencher todos os campos e salvar.
Ao criar sua nova tarefa, ![criar_tarefa](https://github.com/user-attachments/assets/c8459332-a2e8-4421-84b2-6909a641c16d)

Você será direcionado a uma visualização das informações salvas da sua Tarefa:
![apos_crair](https://github.com/user-attachments/assets/4702e7be-0f6e-43cc-9bdc-4f986d8d8529)



