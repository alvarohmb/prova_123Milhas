* Considerando configuração para ambiente linux.

    * Verifica se já exite chave cadastrada
        https://docs.github.com/pt/authentication/connecting-to-github-with-ssh/checking-for-existing-ssh-keys

    * Gerar uma nova chave.
        https://docs.github.com/pt/authentication/connecting-to-github-with-ssh/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent

    * Adicione ela no seu git hub.
        https://docs.github.com/pt/authentication/connecting-to-github-with-ssh/adding-a-new-ssh-key-to-your-github-account


    * Apos chave ssh configurada.
        * Ir para a pasta do projeto
            cd /var/www/html

        * Clone do projeto
            git clone git@github.com:alvarohmb/prova_123Milhas.git

        * Instalação:
            cd prova_123Milhas/
            composer install
            sudo chmod -R 777 /var/www/html/prova_123Milhas
            composer definir-env-dev
            sudo php artisan optimize:clear
            php artisan key:generate
            php artisan make:swagger

    http://alvaro_api123milhas.local:81/documentacao

Configuracao Ambiente ( caso utilize o NGINX como Eu ):
    sudo cp api123milhas.local.example /etc/nginx/sites-available/api123milhas.local

    sudo vim /etc/nginx/sites-available/api123milhas.local
        * Trocar o caminho do projeto, +- na linha 6.
        * Ficar algo parecido com: root /var/www/html/prova_123Milhas/public;

    cd /etc/nginx/sites-enabled
    sudo ln -s /etc/nginx/sites-available/api123milhas.local
    sudo vim /etc/hosts
        * Adicionar o seu hosts
    127.0.0.1   api123milhas.local

    sudo service nginx restart