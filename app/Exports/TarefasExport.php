<?php

namespace App\Exports;

use App\Models\Tarefa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TarefasExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Tarefa::all();
        // dd(auth()->user()->tarefas()->get());
        return auth()->user()->tarefas()->get();
    }

    public function headings():array{ // declarando o tipo de retorno
        return [
            'Id da Tarefa',
            'Tarefa',
            'Data Limite Conclusão'
        ];
    }

    public function map($line):array{
        // dd($line);
        return [
            $line->id,
            $line->tarefa,
            date('d/m/Y', strtotime($line->data_limite_conclusao))
        ];
    }
}
