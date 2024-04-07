<h1>Задача {{ $task->name }} просрочена</h1>
Уважаемый {{ $user->name }}.
<b>Срок задачи</b> {{ $task->name }} : <span style="font-size: 1.2em;">({{ $task->completion_date  }} )</span>
<b>Описание задачи:</b>
<br/> {{ $task->description  }}
