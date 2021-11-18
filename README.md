# Considerando configuração para ambiente linux.
Fluxo chave SSH
* Verifica se já exite chave cadastrada:
```
https://docs.github.com/pt/authentication/connecting-to-github-with-ssh/checking-for-existing-ssh-keys
```
* Gerar uma nova chave.
```
https://docs.github.com/pt/authentication/connecting-to-github-with-ssh/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent
```
* Adicione ela no seu git hub.
```
https://docs.github.com/pt/authentication/connecting-to-github-with-ssh/adding-a-new-ssh-key-to-your-github-account
```
Apos chave ssh configurada.
* Clone do Projeto
```
cd /var/www/html
git clone git@github.com:alvarohmb/prova_123Milhas.git
```
* Instalação:
```
cd prova_123Milhas/
composer install
sudo chmod -R 777 /var/www/html/prova_123Milhas
composer definir-env-dev
sudo php artisan optimize:clear
php artisan key:generate
php artisan make:swagger
sudo chmod -R 777 /var/www/html/prova_123Milhas
```

* Forma de utilização:

    1 - Atraves do proprio server gerado pelo laravel

    ```
    php artisan serve
    ```

    ** links:

    http://127.0.0.1:8000

    http://127.0.0.1:8000/documentacao


    2 - Atravez do NGINX passo a passo a baixo:
    ** links:

    http://api123milhas.local:81

    http://api123milhas.local:81/documentacao


* Configuracao Ambiente ( caso utilize o NGINX como Eu ):
    ```
    cd /var/www/html/prova_123Milhas
    sudo cp api123milhas.local.example /etc/nginx/sites-available/api123milhas.local
    cd /etc/nginx/sites-available
    sudo vim api123milhas.local
    ```
    * Trocar o caminho do projeto, +- na linha 6.

    * Ficar algo parecido com: root /var/www/html/prova_123Milhas/public;

    ```
    cd /etc/nginx/sites-enabled
    sudo ln -s /etc/nginx/sites-available/api123milhas.local
    sudo vim /etc/hosts
    ```

    * Adicionar o seu hosts
    ```
    127.0.0.1   api123milhas.local
    ```

    * Reiniciando Servico
    ```
    sudo service nginx restart
    ```
