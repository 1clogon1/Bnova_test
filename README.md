# bnova_test

## Тестовое задание PHP Backend Developer

## Запуск микросервиса на Docker


1. Скачать Docker.



2. Клонируем репозиторий:

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1) ssh - git@gitlab.com:clogon/bnova_test.git;

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2) https - https://gitlab.com/clogon/bnova_test.git;

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3) Скачать архив и распоковать его у себя.



3. Переходим в папку Laravel проекта в терминале(если не в ней находитесь):
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;cd .\laravel\



4. Запускаем:

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;composer install



6. Копируем env:

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;cp .env.example .env



7. Меняем данные для подключения к базе в файле .env на:

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DB_CONNECTION=pgsql

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DB_HOST=postgres_db

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DB_PORT=5432

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DB_DATABASE=laravel

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DB_USERNAME=user

&nbsp;&nbsp;&nbsp;DB_PASSWORD=password



8. Запускаем сборку и запуск контейнеров:

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;docker-compose up -d



9. Запускаем миграцию:

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;docker exec -it laravel_app php artisan migrate;



Теперь вы можете взаимодействовать с api



# Запросы

Примечание: 
так как запросы будем выполнять на локальной машине, отправляем из по данному пути - http://localhost:8000.

## GET - получение
Для получения гостей есть два варианта запроса GET(статус код 200):
1. http://localhost:8000/api/get/guest - получение всех данных;
Пример успешного ответа(статус код 200):
{
&nbsp;"status": "success",

&nbsp;"data": [

&nbsp;&nbsp;{

&nbsp;&nbsp;"id": 1,

&nbsp;&nbsp;"name": "Максим",

&nbsp;&nbsp;"surname": "Трифонов",

&nbsp;&nbsp;"phone": "+79533510593",

&nbsp;&nbsp;"email": "t.t.maxi0524314@gmail.com",

&nbsp;&nbsp;"country": "Russian",

&nbsp;&nbsp;"created_at": "2024-10-20T22:31:20.000000Z",

&nbsp;&nbsp;"updated_at": "2024-10-20T22:31:20.000000Z"

&nbsp;},

&nbsp;{

&nbsp;&nbsp;"id": 2,

&nbsp;&nbsp;"name": "Олег",

&nbsp;&nbsp;"surname": "Булатов",

&nbsp;&nbsp;"phone": "+79533210593",

&nbsp;&nbsp;"email": "t.t.maxi052314@gmail.com",

&nbsp;&nbsp;"country": "Russian",

&nbsp;&nbsp;"created_at": "2024-10-20T22:34:14.000000Z",

&nbsp;&nbsp;"updated_at": "2024-10-20T22:34:14.000000Z"

&nbsp;&nbsp;}

&nbsp;]

}


3. http://localhost:8000/api/get/guest/3 - получение конкретного гостя по его id переданному в ссылке;
Пример успешного ответа(статус код 200):
{
&nbsp;"status": "success",

&nbsp;"data": {

&nbsp;&nbsp;"id": 1,

&nbsp;&nbsp;"name": "Максим",

&nbsp;&nbsp;"surname": "Трифонов",

&nbsp;&nbsp;"phone": "+79533510593",

&nbsp;&nbsp;"email": "t.t.maxi0524314@gmail.com",

&nbsp;&nbsp;"country": "Russian",

&nbsp;&nbsp;"created_at": "2024-10-20T22:31:20.000000Z",

&nbsp;&nbsp;"updated_at": "2024-10-20T22:31:20.000000Z"

&nbsp;}

} 

Пример ответа когда не нашли такого id(статус код 404):
{

&nbsp;"status": "error",

&nbsp;"message": "Guest not found"

}



## POST - создание
Для создания записи о госте POST запрос(api/post/guest):
http://localhost:8000/api/post/guest


Передаем:
1. name(имя) - 1) обязательное поле, 2) Строка, 3) от 3 и до 100 символов;
2. surname(фамилия) - 1) обязательное поле, 2) Строка, 3) от 3 и до 100 символов;
3. phone(телефон) - 1) обязательное поле, 2) Строка, 3) от 10 и до 15 символов, 4) Уникальное;
4. email(почта) - 1) Строка, 3) поле является электронной почтой, 4) от 5 и до 255 символов, 5) Уникальное;
5. country(страна) - 1) Строка, 2) до 100 символов.


Примечание: 
Если не передать страну, то она определится по номер телефона +7 Россия или Казахстан(в зависимости от следующих цифр), +1 США или Канада(в зависимости от следующих цифр), +20 Египет и т.д.


Получаем при успешном создание(статус код 201):
{

&nbsp;"status": "success",

&nbsp;"message": "Guest added successfully"

}


Пример ошибки валидации при слишком короткой фамилии(статус код 422):
{

&nbsp;"status": "error",

&nbsp;"data": {

&nbsp;&nbsp;"surname": [

&nbsp;&nbsp;&nbsp;"The surname field must be at least 3 characters."

&nbsp;&nbsp;]

&nbsp;},

&nbsp;"message": "Error validate."

}


Пример ошибки если попытаться отправть в базу телефон и почту повторно тем, что уже есть в базе(статус код 422):
{

&nbsp;"status": "error",

&nbsp;"data": {

&nbsp;&nbsp;"phone": [

&nbsp;&nbsp;&nbsp;"The phone has already been taken."

&nbsp;&nbsp;],

&nbsp;"email": [

&nbsp;&nbsp;&nbsp;"The email has already been taken."

&nbsp;&nbsp;]

&nbsp;},

&nbsp;"message": "Error validate."

}



## PUT - обновление
Для обновления данных о госте, PUT запрос(api/put/guest):
http://localhost:8000/api/put/guest


Передаем:
1. name(имя) - 1) Строка, 3) от 3 и до 100 символов;
2. surname(фамилия) - 1) Строка, 3) от 3 и до 100 символов;
3. phone(телефон) - 1) Строка, 3) от 10 и до 15 символов, 4) Уникальное;
4. email(почта) - 1) Строка, 3) поле является электронной почтой, 4) от 5 и до 255 символов, 5) Уникальное;
5. country(страна) - 1) Строка, 2) до 100 символов.


Примечание: при обновление данных на уникальность для телефона и почты не проверяется, если передали теже данные, что и есть в базе в данной аписи гостя.


Запрос успешного обновления данных(статус код 200):
{

&nbsp;"status": "success",

&nbsp;"data": {

&nbsp;&nbsp;"id": 2,

&nbsp;&nbsp;"name": "Иввв",

&nbsp;&nbsp;"surname": "Петров",

&nbsp;&nbsp;"phone": "+79533510293",

&nbsp;&nbsp;"email": "t.t.maxi052314@gmail.com",

&nbsp;&nbsp;"country": "Russian",

&nbsp;&nbsp;"created_at": "2024-10-20T22:34:14.000000Z",

&nbsp;&nbsp;"updated_at": "2024-10-20T22:53:01.000000Z"

&nbsp;},

&nbsp;"message": "Guest updated successfully"

}


Запрос ошибки уникальности(статус код 422):
{

&nbsp;"status": "error",

&nbsp;"data": {

&nbsp;"phone": [

&nbsp;&nbsp;"The phone has already been taken."

&nbsp;&nbsp;]

&nbsp;},

&nbsp;"message": "Error validate"

}


Запрос ошибки валидации(статус код 422):
{

&nbsp;"status": "error",

&nbsp;"data": {

&nbsp;"name": [

&nbsp;&nbsp;&nbsp;"The name field must be at least 3 characters."

&nbsp;&nbsp;]

&nbsp;},

&nbsp;"message": "Error validate"

}



## DELETE - удаление
Запрос на удаления гостя:
http://localhost:8000/api/delete/guest/1


Передаем:
1) В ссылке id гостя которого хотим удалить.


Успешный запрос(статус код 200):
{

&nbsp;"status": "success",

&nbsp;"message": "Guest deleted successfully"

}


Запрос ошибка, предали id гостя котого нету(статус код 404):
{

&nbsp;"status": "error",

&nbsp;"message": "Guest not found"

}
