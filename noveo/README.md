<p align="center"><a href="https://spb.hh.ru/vacancy/94972506" target="_blank">
<img src="https://img.hhcdn.ru/employer-logo/4232641.jpeg" width="400" alt="Laravel Logo"></a></p>

# Новео тест - Задание
Цель этого задания – проверить ваши навыки разработки приложений с использованием PHP и Laravel. 
Пожалуйста, проявите свои способности к проектированию систем, написанию чистого и поддерживаемого кода.

## Реализуйте систему управления задачами

1. Создайте базовую систему управления задачами. В системе должны быть пользователи и задачи. Каждый пользователь может иметь множество задач.
2. Логическая структура:
    1. Пользователь: 
       1. имя
       2. email
       3. пароль 
    2. Задача: 
       1. Название, 
       2. описание, 
       3. дата завершения, 
       4. статус (новая, в работе, завершенная), 
       5. назначенный пользователь
3. Операции:
   1. Регистрация/Аутентификация пользователей
   2. Создание, чтение, обновление и удаление задач
   3. Назначение задач пользователям

## API

1. Создайте REST Api для выполнения операций, описанных выше. 
2. API должно быть защищено JWT (JSON Web Token) аутентификацией.

## Разработайте систему уведомлений

1. Создайте систему которая будет отправлять уведомления пользователям о просроченных задачах. 
2. Уведомления должны отправляться по электронной почте и сохраняться в базе данных для истории уведомлений.

## Формат

1. Пожалуйста, сохраните ваш код в репозитории Git
2. пришлите ссылку на ваш репозиторий вместе с вашими ответами. 
3. Оценивать мы будем структуру вашего кода, методологию тестирования, общую архитектуру приложения и ваш подход к решению проблем.

# Решение
## Реализована система управления задачами
1. Этот тест был выполнен в среде моей тестовой платформы, доступной в [моем репозитории Githab](https://github.com/emisdb/luxus). Задача выполнена в фреймворке Laravel с использованием лучших практик для этого фреймворка в соответствии с принципами SOLID. Система развернута на  [моей тестовой площадке](https://luxus.emisdb.ru/noveo) на основе технологии Laravel 10/Vue.js 3 с использованием пакета сборки Vite:
    - Email Address: test@test.org
    - password: testtest
2. Создана или применена существующая логическая структура:
   1. В качестве таблицы Пользователь была использована таблица users из стартовой установки Laravel: [структура таблицы](https://github.com/emisdb/luxus/blob/master/database/users.sql). 
      - Все поля, необходимые для реализации этой задачи в таблице уже существуют
      - Реализованая в Laravel  система аутентификации и авторизации закрывает нашу задачу по этому пункту
   2. Командой  **php artisan make:model Task -mscrR** были созданы
      1. модель [app/Models/Task.php](https://github.com/emisdb/luxus/blob/master/app/Models/Task.php)
      2. миграция [database/migrations/2024_03_26_112106_create_tasks_table.php](https://github.com/emisdb/luxus/blob/master/database/migrations/2024_03_26_112106_create_tasks_table.php)
      3. сидер [database/seeders/TaskSeeder.php](https://github.com/emisdb/luxus/blob/master/database/seeders/TaskSeeder.php)
      4. риквесты
         1. [app/Http/Requests/StoreTaskRequest.php](https://github.com/emisdb/luxus/blob/master/app/Http/Requests/StoreTaskRequest.php)
         2. [app/Http/Requests/UpdateTaskRequest.php](https://github.com/emisdb/luxus/blob/master/app/Http/Requests/UpdateTaskRequest.php)
      5. ресурс [app/Http/Resources/TaskResource.php](https://github.com/emisdb/luxus/blob/master/app/Http/Resources/TaskResource.php)
      6. контролллер [app/Http/Controllers/TaskController.php](https://github.com/emisdb/luxus/blob/master/app/Http/Controllers/TaskController.php)
   3. Для решения задачи понадобится еще одна, не указанная в спецификации таблица для отправленных уведомлений task_notifications. Командой **php artisan make:model TaskNotification -m** были созданы
       1. модель [app/Models/TaskNotification.php](https://github.com/emisdb/luxus/blob/master/app/Models/TaskNotification.php)
       2. миграция [database/migrations/2024_03_26_121651_create_task_notifications_table.php](https://github.com/emisdb/luxus/blob/master/database/migrations/2024_03_26_121651_create_task_notifications_table.php)
3. Реализованы операции
   1. Регистрация/Аутентификация пользователей была использована штатная система Laravel, которая полностью отвечает всем заявленным требованиям
   2. 
    

