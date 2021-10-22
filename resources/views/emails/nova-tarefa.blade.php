@component('mail::message')
Tarefa: {{$tarefa}}

Data Limite de Conclusao: {{$data_limite_conclusao}}

@component('mail::button', ['url' => $url])
Clique aqui para ver a tarefa
@endcomponent

Att,<br>
{{ config('app.name') }}
@endcomponent
