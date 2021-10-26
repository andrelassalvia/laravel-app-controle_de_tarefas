<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
      .titulo{
        background-color: #c2c2c2;
        border: 1px;
        text-align: center;
        width: 100%;
        text-transform: uppercase;
        font-weight: bold;
        margin-bottom: 25px;
      }

      .table{
          width: 100%;

      }

      .table th{
        text-align: left;
      }

      .page-break {
        page-break-after: always;
      }


    </style>

    <title>Tarefa PDF</title>
  </head>
  <body>
    <h2 class="titulo">Lista de Tarefas</h2>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Tarefa</th>
          <th scope="col">Data Limite Conclusão</th>
        </tr>
      </thead>
      <tbody>
        @foreach ( $tarefas as $key => $tarefa)
            <tr>
                {{-- <th scope="row">1</th> --}}
                <td>{{$tarefa->id}}</td>
                <td>{{$tarefa->tarefa}}</td>
                <td>{{date('d / m / Y', strtotime($tarefa->data_limite_conclusao))}}</td>
            </tr>
        @endforeach
      </tbody>
    </table>
    <div class="page-break"></div>  
    <h2>Pagina 2</h2>
  </body>
</html>
