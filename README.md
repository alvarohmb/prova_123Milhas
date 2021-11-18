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

    Atraves do proprio server gerado pelo laravel

    ```
    php artisan serve
    ```

    ** links:

    http://127.0.0.1:8000

    http://127.0.0.1:8000/documentacao