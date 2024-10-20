# bnovo_test

Тестовое задание PHP Backend Developer




					Запуск микросервиса на докер
1. Клонируем репозиторий

2. Переходим в папку Laravel проекта в терминале(если не в ней находитесь):
	cd .\laravel\

3. Запускаем: 
	composer install

4. Копируем env: 
	cp .env.example .env

5. Меняем данные для подключения к базе в файле .env на:
	DB_CONNECTION=pgsql
	DB_HOST=postgres_db
	DB_PORT=5432
	DB_DATABASE=laravel
	DB_USERNAME=user
	DB_PASSWORD=password


6. Запускаем сборку и запуск контейнеров:
	docker-compose up -d

7. Запускаем миграцию:
	docker exec -it laravel_app php artisan migrate


Теперь вы можете взаимодействовать с api



					Запросы

Примечание: 
так как запросы будем выполнять на локальной машине, отправляем из по данному пути - http://localhost:8000.

Для получения гостей есть два варианта запроса GET(статус код 200):
1. http://localhost:8000/api/get/guest - получение всех данных;
Пример успешного ответа(статус код 200):
{
    "status": "success",
    "data": [
        {
            "id": 1,
            "name": "Максим",
            "surname": "Трифонов",
            "phone": "+79533510593",
            "email": "t.t.maxi0524314@gmail.com",
            "country": "Russian",
            "created_at": "2024-10-20T22:31:20.000000Z",
            "updated_at": "2024-10-20T22:31:20.000000Z"
        },
        {
            "id": 2,
            "name": "Олег",
            "surname": "Булатов",
            "phone": "+79533210593",
            "email": "t.t.maxi052314@gmail.com",
            "country": "Russian",
            "created_at": "2024-10-20T22:34:14.000000Z",
            "updated_at": "2024-10-20T22:34:14.000000Z"
        }
    ]
}


2. http://localhost:8000/api/get/guest/3 - получение конкретного гостя по его id переданному в ссылке;
Пример успешного ответа(статус код 200):
{
    "status": "success",
    "data": {
        "id": 1,
        "name": "Максим",
        "surname": "Трифонов",
        "phone": "+79533510593",
        "email": "t.t.maxi0524314@gmail.com",
        "country": "Russian",
        "created_at": "2024-10-20T22:31:20.000000Z",
        "updated_at": "2024-10-20T22:31:20.000000Z"
    }
} 
Пример ответа когда не нашли такого id(статус код 404):
{
    "status": "error",
    "message": "Guest not found"
}



Для создания записи о госте POST запрос(api/post/guest):
http://localhost:8000/api/post/guest

Передаем:
1. name(имя) - 1) обязательное поле, 2) Строка, 3) от 3 и до 100 символов;
2. surname(фамилия) - 1) обязательное поле, 2) Строка, 3) от 3 и до 100 символов;
3. phone(телефон) - 1) обязательное поле, 2) Строка, 3) от 10 и до 15 символов, 4) Уникальное;
4. email(почта) - 1) Строка, 3) поле является электронной почтой, 4) от 5 и до 255 символов, 5) Уникальное;
5. country(страна) - 1) Строка, 2) до 100 символов.

Примечанние: Если не передасть страну, то она определится по номер телефона +7 Россия или Казахстан(в зависимости от следующих цифр), +1 США или Канада(в зависимости от следующих цифр), +20 Египет и т.д.

Получаем при успешном создание(статус код 201):
{
    "status": "success",
    "message": "Guest added successfully"
}

Пример ошибки валидации при слишком корткой фамилии(статус код 422):
{
    "status": "error",
    "data": {
        "surname": [
            "The surname field must be at least 3 characters."
        ]
    },
    "message": "Error validate."
}

Пример ошибки если попытаться отправть в базу телефон и почту повторно тем, что уже есть в базе(статус код 422):
{
    "status": "error",
    "data": {
        "phone": [
            "The phone has already been taken."
        ],
        "email": [
            "The email has already been taken."
        ]
    },
    "message": "Error validate."
}



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
    "status": "success",
    "data": {
        "id": 2,
        "name": "Иввв",
        "surname": "Петров",
        "phone": "+79533510293",
        "email": "t.t.maxi052314@gmail.com",
        "country": "Russian",
        "created_at": "2024-10-20T22:34:14.000000Z",
        "updated_at": "2024-10-20T22:53:01.000000Z"
    },
    "message": "Guest updated successfully"
}

Запрос ошибки уникальности(статус код 422):
{
    "status": "error",
    "data": {
        "phone": [
            "The phone has already been taken."
        ]
    },
    "message": "Error validate"
}

Запрос ошибки валидации(статус код 422):
{
    "status": "error",
    "data": {
        "name": [
            "The name field must be at least 3 characters."
        ]
    },
    "message": "Error validate"
}

Запрос на удаления гостя:
http://localhost:8000/api/delete/guest/1

Передаем:
1) В ссылке id гостя которого хотим удалить.

Успешный запрос(статус код 200):
{
    "status": "success",
    "message": "Guest deleted successfully"
}

Запрос ошибка, предали id гостя котого нету(статус код 404):
{
    "status": "error",
    "message": "Guest not found"
}
