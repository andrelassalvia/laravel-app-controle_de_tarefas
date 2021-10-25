Site da Aplicacao 

@auth

<h1>Usuario Autenticado</h1>
<p>Id: {{Auth::user()->id}}</p>
<p>Nome: {{ucfirst(Auth::user()->name)}}</p>
<p>Login: {{Auth::user()->email}}</p>

@endauth

@guest
<br>
<br>
<br>
<h1>Ola visitante!</h1>

@endguest