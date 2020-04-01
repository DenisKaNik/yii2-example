<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Advanced Project Template</h1>
    <br>
</p>

Example Yii2 Advanced Project Template

## Info

* Yii 2.0.32
* PHP >= 7.3
* MariaDB >= 10.3.22
* Nginx >= 1.14 (PHP-FPM)
* Bootstrap 3
* Swagger UI
* Vagrant

## Установка

##### Вариант 1
```
$ git clone https://github.com/DenisKaNik/yii2-example.git
$ cd yii2-example
$ composer install
$ ./init --env=Development
```

* Создать БД 
    * `yii2_example_db`
    * `yii2_example_db_test`
* Скопировать `.env.example` в `.env` и прописать нужные реквизиты для подключения к БД

Запустить миграции
```
$ ./yii migrate
$ ./yii_test migrate
```

Наполнить БД первичными данными
```
$ ./yii fixture/load '*' --namespace='common\fixtures'
$ ./yii_test fixture/load '*' --namespace='common\fixtures'
```

Конфигурационный файл для Nginx взять из `vagrant/nginx/app.conf`

##### Вариант 2
Предварительно установить VirtualBox, vagrant
```
$ git clone https://github.com/DenisKaNik/yii2-example.git
$ cd yii2-example
$ vagrant up
```

Либо предварительно перед `vagrant up` скопировать `vagrant/config/vagrant-local.example.yml` 
в `vagrant/config/vagrant-local.yml` и указать персональный GitHub token, либо после вывода сообщения
*You must place REAL GitHub token into configuration* прописать персональный GitHub token
в `vagrant/config/vagrant-local.yml` и повторно запустить команду:
```
$ vagrant up
```

## Запуск тестов

Перед запуском тестов выполняем команду
```
$ php -S 127.0.0.1:8080 -t api/web
```
и в другом консольном окне запустить тесты
```
$ ./vendor/bin/codecept run
```

## Описание

1. Реализованы сущности авторы и книги

2. Реализована административная часть:
    * CRUD операции для авторов и книг
    * Вывод списка книг с указанием имени автора
    * Вывод списка авторов с указанием количества книг

3. Реализована публичная часть сайта с отображением книг и детальной страницы книги

4. Реализована выдача данных в формате json по RESTful спецификации:
    * GET /v1/books - получение списка книг с именем автора (-ов)
    * GET /v1/books/ID - получение данных книги по ID
    * PUT /v1/books/ID - обновление данных книги
    * DELETE /v1/books/ID - удаление записи книги из БД

#### Ссылки
* http://yii2-example.loc - публичная часть
* http://adm.yii2-example.loc - административная часть
* http://api.yii2-example.loc - API, также доступно и через правило `api` в роутере http://yii2-example.loc/api
* http://api.yii2-example.loc/docs/index.html - Swagger UI

## Особенности
1. Доступы в админку в файле `common/fixtures/data/user.php`

2. При работе с API через отдельный домен необходимо сгенерировать токен для авторизации 
через _Endpoint_ http://api.yii2-example.loc/oauth2/token методом POST в JSON формате. Пример JSON:
```json
{
    "grant_type": "password",
    "username": "admin",
    "password": "password_0",
    "client_id": "testclient",
    "client_secret": "testpass"
}
```

И в Endpoint's по книгам указывать GET-параметр
```
accessToken=__access_token__
```

При использовании Swagger UI в `header` параметре **Authorization** указывать значение
```
Bearer __access_token__
``` 
