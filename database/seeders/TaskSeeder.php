<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Телеграм', 'description' => 'Просмотр ваканский Телеграм ', 'user_id' => 1, 'status' => 'new'],
            ['name' => 'HH', 'description' => 'Просмотр ваканский HH ', 'user_id' => 1, 'status' => 'new'],
            ['name' => 'Хабр', 'description' => 'Просмотр ваканский Хабр ', 'user_id' => 1, 'status' => 'new'],
            ['name' => 'Проверки', 'description' => 'Проверки Проверки ПроверкиП роверки', 'user_id' => 2, 'status' => 'new'],
            ['name' => 'Фильрация', 'description' => 'Фильрация Фильрация Фильрация', 'user_id' => 2, 'status' => 'new'],
            ['name' => 'CRUD', 'description' => 'Создать CRUD', 'user_id' => 1, 'status' => 'new'],
            ['name' => 'Документация', 'description' => 'Документироватьт задачи', 'user_id' => 1, 'status' => 'new'],
            ['name' => 'Сидер', 'description' => 'Создать сидер для задач', 'user_id' => 1, 'status' => 'new'],
            ['name' => 'Фильтры для формы', 'description' => 'Фильтры для отбора в форме задач', 'user_id' => 1, 'status' => 'new'],
            ['name' => 'Пагинатор', 'description' => 'Создать пагинатор для таблицы задач', 'user_id' => 1, 'status' => 'new'],
            ['name' => 'Пагинатор во Vue', 'description' => 'Имплементировать специфику пагинатора во Vue', 'user_id' => 1, 'status' => 'new'],
            ['name' => 'Контроллер задач', 'description' => 'Все необходимые экшены для CRUD', 'user_id' => 1, 'status' => 'new'],
            ['name' => 'Тесты', 'description' => 'Сделать тесты на CRUD', 'user_id' => 2, 'status' => 'new'],
            ['name' => 'Проверить в разных юзерах', 'description' => 'Проверить таблицу для разных юзеров', 'user_id' => 2, 'status' => 'new'],
        ];
        foreach ($data as $property) {
            Task::create($property);
        }
    }
}
