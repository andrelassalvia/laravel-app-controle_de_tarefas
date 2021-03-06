<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\NovaTarefaMail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TarefasExport;
use PDF;


class TarefaController extends Controller
{   
    /*
    public function __construct(){
        $this->middleware('auth');
    }
    */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
        $user_id = auth()->user()->id;
        // dd($user_id);
        $tarefas = Tarefa::where('user_id', $user_id)->paginate(10);
        return view ('tarefa.index', ['tarefas' => $tarefas]);
    }

        /*
        if(Auth::check()){
            $id = Auth::user()->id;
            $name = Auth::user()->name;
            $email = Auth::user()->email;
            return "Id: $id | name: $name | email: $email";
        } else{
            return 'Usuário não logado no sistema';
        }
        */
        /*
        if(auth()->check()){
            $id = auth()->user()->id;
            $name = auth()->user()->name;
            $email = auth()->user()->email;
            return "Id: $id | name: $name | email: $email";
        } else{
            return 'Usuário não logado no sistema';
        }
        */
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tarefa.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $dados = $request->all();
        $dados['user_id'] = auth()->user()->id;
        // dd($dados);

        $tarefa = Tarefa::create($dados);
        $destinatario = auth()->user()->email; // email do usuario logado
        Mail::to($destinatario)->send(new NovaTarefaMail($tarefa));
        return redirect()->route('tarefa.show', ['tarefa' => $tarefa->id]);
        // dd($tarefa);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function show(Tarefa $tarefa)
    {
        //
        // dd($tarefa);
        return view ('tarefa.show', ['tarefa' => $tarefa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarefa $tarefa)
    {
        //
        $user_id = auth()->user()->id;
        if(!$tarefa->user_id == $user_id){
            return view ('acesso-negado');
        } else{

            // dd($tarefa);
            return view ('tarefa.edit', ['tarefa' => $tarefa]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        //checagem de usuario
        $user_id = auth()->user()->id;
        if(!$tarefa->user_id == $user_id){
            return view ('acesso-negado');
        }else{

            $tarefa->update($request->all());
            return redirect()->route('tarefa.show', ['tarefa' => $tarefa]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarefa $tarefa)
    {

        //checagem de usuario
        $user_id = auth()->user()->id;
        if(!$tarefa->user_id == $user_id){
            return view('acesso-negado');
        }else{
            $tarefa->delete($tarefa->id);
            return view('tarefa.show', ['tarefa' => $tarefa]);
        }

    }

    public function exportacao($extensao){

        // return Excel::download(new TarefasExport, 'lista_de_tarefas.xlsx');

        if(in_array($extensao, ['xlsx', 'pdf', 'csv'])){

            return Excel::download(new TarefasExport, 'lista_de_tarefas.'.$extensao);

        }else{
            return redirect()->route('tarefa.index');
        }
    }

    public function exportar(){
        $tarefas = auth()->user()->tarefas()->get();
        $pdf = PDF::loadView('tarefa.pdf', ['tarefas' => $tarefas]);
        $pdf->setPaper('a4', 'landscape');
        // return $pdf->download('lista_de_tarefas.pdf');
        return $pdf->stream('lista_de_tarefas.pdf');
    
    }
}
