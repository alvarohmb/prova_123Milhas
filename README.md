* Considerando configuração para ambiente linux.
    cd /var/www/html;

    * Clone do projeto
        sudo git clone git@github.com:alvarohmb/prova_123Milhas.git

Instalação:
    composer install
    composer definir-env-dev
    sudo chmod -R 777 /var/www/html/*
    sudo php artisan optimize:clear
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