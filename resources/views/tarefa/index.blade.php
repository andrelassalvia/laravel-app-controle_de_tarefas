@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Adicionar Tarefa</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tarefa</th>
                                <th scope="col">Data Limite Conclusão</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach ( $tarefas as $k => $t )
                                <tr>
                                    <th scope="row">{{$t->id}}</th>
                                    <td>{{$t->tarefa}}</td>
                                    <td>{{date('d/m/y', strtotime($t->data_limite_conclusao))}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
