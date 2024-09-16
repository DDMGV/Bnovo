1. cd Bnovo
2. docker-compose up -d
3. cd src/guest-api
4. composer install
5. create database "laravel"
6. docker exec -it bnovo-php-1 /bin/bash
7. php artisan migrate
8. php artisan db:seed

9. Go to POSTMAN

 Headers: { "key": "Accept", "value" : "application/json" }
   
   GET | http://localhost/api/guests/        | Получение всех гостей

   
  POST | http://localhost/api/guests/        | Создание гостя  

  
   GET | http://localhost/api/guests/{guest} | Получение гостя гостя по ID  

   
 PATCH | http://localhost/api/guests/{guest} | Изменение гостя гостя по ID  

 
DELETE | http://localhost/api/guests/{guest} | Удаление гостя гостя по ID  



Body: | Для POST & PATCH 
{
    "name": "John",                    | Обязательное, строка, только a-z & A-Z (пробелы тоже можно), Максимум: 30 
    "surname": "Connor",               | Обязательное, строка, только a-z & A-Z (пробелы тоже можно), Максимум: 30 
    "email": "JohnConnor@gmail.com",   | Строка, Е-мэйл, уникальный 
    "phone": "7 9999999943",           | Обязательно, строка, Только цифры и пробелы, уникальный
    "country_id": 2                    | Необязательно, Цифра, (id модели Country)
}
