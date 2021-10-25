@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tarefa <a href="{{route('tarefa.create')}}" class="float-right">Novo</a></div>
                
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tarefa</th>
                                <th scope="col">Data Limite Conclusão</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach ( $tarefas as $k => $t )
                                <tr>
                                    <th scope="row">{{$t->id}}</th>
                                    <td>{{$t->tarefa}}</td>
                                    <td>{{date('d/m/y', strtotime($t->data_limite_conclusao))}}</td>
                                    <td><a href="{{ route('tarefa.edit', ['tarefa' => $t->id]) }}">Editar</a></td>
                                    <form id="form_{{$t->id}}" method="POST" action="{{route('tarefa.destroy', ['tarefa' => $t->id])}}">
                                        @method('DELETE')
                                        @csrf
                                            <td><a href="#" onclick="document.getElementById('form_{{$t->id}}').submit()">Excluir</a></td>
                                    </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="{{$tarefas->previousPageUrl()}}">Voltar</a>
                            </li>
                            
                            @for ($i = 1 ; $i <= $tarefas->lastPage() ; $i++)
                                <li class="page-item {{$tarefas->currentPage() == $i ? 'active' : ''}}">
                                    <a class="page-link" href="{{$tarefas->url($i)}}">{{$i}}</a>
                                </li>
                            @endfor
                            
                            <li class="page-item">
                                <a class="page-link" href="{{$tarefas->nextPageUrl()}}">Avançar</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
