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

Agora realize os seguintes comandos : <br/>
`sudo docker exec -it yii2_app composer install` <br/>
`sudo docker exec -it yii2_app bower install jquery --allow-root` <br/>
`sudo docker exec -it yii2_app php yii migrate`

Agora a aplicação já estará rodando em : `http://localhost:8080` 

Para executar os testes unitários, no arquivo raiz do projeto execute : <br/>
`sudo docker exec -it yii2_app vendor/bin/codecept run unit`
