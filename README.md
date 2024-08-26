Incialmente, garanta que sua máquina tenha Docker e Docker Compose:\n

- Instale curl:\n
`sudo apt update` \n
`sudo apt upgrade` \n
`sudo apt install curl` \n

- Instale Docker e Docker Compose:\n
`sudo curl -L "https://github.com/docker/compose/releases/download/1.29.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose` \n
`sudo chmod +x /usr/local/bin/docker-compose`

Após fazer o clone do repositório você pode realizar o seguinte comando para já executar o container e fazer o build:\n

- Execute (caso esteja configurado para o Docker sempre rodar com 'sudo', não é necessário colocar no inicio do comando):\n
`sudo docker-compose up --build`\n

Agora a aplicação já estará rodando em :\n `http://localhost:8080`\n

Para executar os testes unitários, no arquivo raiz do projeto execute : \n
`sudo docker exec -it yii2_app vendor/bin/codecept run unit`
