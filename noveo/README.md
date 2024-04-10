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
1. Этот тест был выполнен в среде моей тестовой платформы, доступной в [моем репозитории Githab](https://github.com/emisdb/luxus). Задача выполнена в фреймворке Laravel с использованием лучших практик для этого фреймворка в соответствии с принципами SOLID. Система развернута на  [моей тестовой площадке](https://luxus.emisdb.ru/noveo) на основе технологии Laravel 10/Vue.js 3 с использованием пакета сборки Vite. Креды для входа в систему:
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
      4. риквест [app/Http/Requests/StoreTaskRequest.php](https://github.com/emisdb/luxus/blob/master/app/Http/Requests/StoreTaskRequest.php)
      5. ресурс [app/Http/Resources/TaskResource.php](https://github.com/emisdb/luxus/blob/master/app/Http/Resources/TaskResource.php)
      6. контролллер [app/Http/Controllers/TaskController.php](https://github.com/emisdb/luxus/blob/master/app/Http/Controllers/TaskController.php)
      7. в [routes/api.php](https://github.com/emisdb/luxus/blob/master/routes/api.php#L28) зарегестрирован рут
   3. Для решения задачи понадобится еще одна, не указанная в спецификации таблица для отправленных уведомлений task_notifications. Командой **php artisan make:model TaskNotification -m** были созданы
       1. модель [app/Models/TaskNotification.php](https://github.com/emisdb/luxus/blob/master/app/Models/TaskNotification.php)
       2. миграция [database/migrations/2024_03_26_121651_create_task_notifications_table.php](https://github.com/emisdb/luxus/blob/master/database/migrations/2024_03_26_121651_create_task_notifications_table.php)
3. Реализованы операции
   1. Регистрация/Аутентификация пользователей 
      1. была использована штатная система Laravel, которая полностью отвечает всем заявленным требованиям
      2. на фронтэнде добавлена форма идентификации на Vue.Js [js/components/nov/LoginComponent.vue](https://github.com/emisdb/luxus/blob/master/resources/js/components/nov/LoginComponent.vue)
      3. для нее создан API с выдачей JWT токена [app/Http/Controllers/Auth/AuthController.php](https://github.com/emisdb/luxus/blob/master/app/Http/Controllers/Auth/AuthController.php#L34)
      4. он зарегестрирован в [routes/api.php](https://github.com/emisdb/luxus/blob/master/routes/api.php#L35)
   2. Создание, чтение, обновление и удаление задач
      1. Реализованы в компонентах Vue.js как SPA через Vue Router плагин [resources/js/routes.js](https://github.com/emisdb/luxus/blob/master/resources/js/routes.js#L17)
      2. компонент таблицы [resources/js/components/nov/SearchAdvancedComponent.vue](https://github.com/emisdb/luxus/blob/master/resources/js/components/nov/SearchAdvancedComponent.vue)
      3. с компонентом пагинации [resources/js/components/nov/PaginatorComponent.vue](https://github.com/emisdb/luxus/blob/master/resources/js/components/nov/PaginatorComponent.vue)
      4. компонент редакции и добавления нового элемента [resources/js/components/nov/FormComponent.vue](https://github.com/emisdb/luxus/blob/master/resources/js/components/nov/FormComponent.vue)
   3. Назначение задач пользователям
      1. Операция проходит в форме задачи [resources/js/components/nov/SearchAdvancedComponent.vue](https://github.com/emisdb/luxus/blob/master/resources/js/components/nov/SearchAdvancedComponent.vue)

## API

1. Создайте REST Api для выполнения операций, описанных выше.
   1. Операция авторизации проходит в [app/Http/Controllers/Auth/AuthController.php](https://github.com/emisdb/luxus/blob/master/app/Http/Controllers/Auth/AuthController.php)
   2. Все CRUD операции проводятся в ресурсном контроллере [app/Http/Controllers/TaskController.php](https://github.com/emisdb/luxus/blob/master/app/Http/Controllers/TaskController.php) 
2. API должно быть защищено JWT (JSON Web Token) аутентификацией.
   1. Был добавлен сервис ["tymon/jwt-auth": "^2.1"](https://github.com/emisdb/luxus/blob/master/composer.json#L15)
   2. Добавлены необходимые операции для его получения и обновления [app/Http/Controllers/Auth/AuthController.php](https://github.com/emisdb/luxus/blob/master/app/Http/Controllers/Auth/AuthController.php)
   3. на фронтэнде организована работа с jwt токенами через специальный модуль [resources/js/api.js](https://github.com/emisdb/luxus/blob/master/resources/js/api.js)

## Разработайте систему уведомлений

1. Создайте систему которая будет отправлять уведомления пользователям о просроченных задачах.
   1. В модели был создан метод для вычисления пользователей с просроченными задачами [app/Models/Task.php](https://github.com/emisdb/luxus/blob/master/app/Models/Task.php#L74)
   2. Метод реализован с постановкой в очередь задачи [app/Jobs/MailTaskPendingJob.php](https://github.com/emisdb/luxus/blob/master/app/Jobs/MailTaskPendingJob.php)
   3. зарегестрирована ежедневная команда [app/Console/Kernel.php](https://github.com/emisdb/luxus/blob/master/app/Console/Kernel.php#L16)
2. Уведомления должны отправляться по электронной почте и сохраняться в базе данных для истории уведомлений.
   1. Job [app/Jobs/MailTaskPendingJob.php](https://github.com/emisdb/luxus/blob/master/app/Jobs/MailTaskPendingJob.php#L35) создана для выполнения этих задач
   2. Отправка по почте сообщения [app/Mail/TaskPendingMail.php](https://github.com/emisdb/luxus/blob/master/app/Mail/TaskPendingMail.php)
   3. создание записи в БД через модель [app/Models/TaskNotification.php](https://github.com/emisdb/luxus/blob/master/app/Models/TaskNotification.php)
3. Проект был обеспечен тестами
   1. Тест аутентификации через токен JWT [tests/Feature/Auth/AuthControllerTest.php](https://github.com/emisdb/luxus/blob/master/tests/Feature/Auth/AuthControllerTest.php)
   2. Тест данных и CRUD операций API [](https://github.com/emisdb/luxus/blob/master/tests/Feature/Auth/AuthControllerTest.php)

    

