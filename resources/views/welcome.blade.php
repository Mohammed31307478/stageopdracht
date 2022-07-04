<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/css.css">
    <title>stageopdracht</title>
</head>
<body>


<div class='navbar'>
    <button class="navbarknop"><a class="navbartext" href="/todo"><i>Home</i></a></button>
    <button class="navbarknop"><a class="navbartext" href="#section2 "><i>Overmij</i></a></button>
    <button class="navbarknop"><a class="navbartext" href="#section3"><i>contact</i></a></button>
    <form action="/logout" method="post">
        @csrf
        <button class="navbarknop"><a class="navbartext"><i>logout</i></a></button>
    </form>
</div>



<div class="onderwerp"><h1>Maak je items</h1></div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{--MAAK JE IETEMS FORMULEER--}}
<form class="mi" method="post" action="{{route('todo.store')}}" enctype="multipart/form-data">
    @csrf
    <label class="label1"><h4>Naam voor je items </h4></label>
    <input placeholder="naam" name="name" type="text">

    <label  class="label1" for="fileinput"><h4> voeg een foto toe </h4></label>
    <input type="file"  name="image">

    <label class="label1"> <h4>opmerking toevoegen </h4></label>
    <input placeholder="opmerking" name="informatie" type="text">
    <input type="submit" placeholder="klaar">
</form>

<div class="all-items">
<table>
    <thead >
        <tr >
            <th>ID</th>
            <th  >Name</th>
            <th>Image</th>
            <th>Information</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($todolists as $todolist)
        <tr>
            <td>{{$todolist->id}}</td>
            <td>{{$todolist->name}}</td>
            <td><img src="/{{$todolist->image}}" ></td>
            <td>{{$todolist->informatie}}<a class="button" href="{{route('todo.edit', $todolist->id)}}">update</a></td>
        </tr>
    @endforeach

    </tbody>
</table>
</div>

{{--VOLTOOID FORMULEER--}}

<form class="vol" method="post" action="/todo/update">
    @method('PUT')
    @csrf

    <input name="voltooid_update" type="hidden" value="1">

    <div class="label1"><h4>Voltooid</h4></div>
    <select name="id">
        <option>selecteer een ietems als die voltooid is</option>
        @foreach($todolists as $todolist)

            <option value={{$todolist->id}}>{{$todolist->name}}
                @if($todolist->voltooid == true ){
                <H1>voltooid</H1>
                }
                @else{
                    <h1>onvoltooid</h1>
                    }
                @endif

                @endforeach</option>
    </select>
    <input type="checkbox" name="voltooid">
    <input  type="submit">
</form>





{{--VERWIJDER IETEMS --}}
<form class="delet" method="post" action="{{url('/todo/delete')}}">
    @csrf
    <div class="label1"><h4>Verwijderen</h4></div>
    {{--    @method('delete')--}}
    <select name="id">
        <option>selecteer je product om te verwijderen</option>
        @foreach($todolists as $todolist)
            <option value="{{$todolist->id }}">{{$todolist->name ?? " "}}</option>
        @endforeach
    </select>

    <button type="submit">delete</button>
</form>




<div class="titelovermij">
    <a><h2>Hallo, Hier vind je persoonlijk informatie over mij</h2></a>
</div>



<section id="section2" class="overmij">

    <div class="overmijtekst">
        <h1>dromen</h1>
            <p class="text"> mijn dromen zijn ten eerste dat mijn ouders trots op mij zijn. Dat is het belangrijkste. Ten tweede
                wil
                ik met een BMW 18 roadster rijden en een groot huis kopen en rijk leven. Zo kan ik later met
                tijd rusten want je leeft maar 1 keer. Ik wil dus niet mijn hele leven werken.
                Als laatste wil ik met een vrouw trouwen en kinderen krijgen. Zo kan ik gezellig leven met mijn
                nieuwe familie.
                Dat is alles wat ik wil.
            </p>
    </div>


    <div class="overmijtekst">
        <h1> overmij </h1>
        <p class="text">
            ik ben Mohammed. ik woon in Hoogeveen.Ik ben 18 jaar oud en ik kom uit Syrie. Ik woon nu vier
                jaar in Nederland.
                Ik zit op MBO landstede in Zwolle en volg de opleiding tot Software Developer. Mijn hobby's zijn
                zwemmen, voetballen .
        </p>
    </div>


    <div class="overmijtekst">
        <h1>doel</h1>
        <p class="text">
            Het doel van deze opleiding (software developer) is dat ik later zelf websites kan maken en zelf
                programmeren en daardoor kan ik geld verdienen en mijn dromen bereiken. Het doel van deze website is
                het visualiseren van mijn schoolopdrachten. Ik ga hier de komende jaren laten zien wat ik ga leren
                en heb geleerd. Ik kan hierdoor bij het zoeken van een stageplek laten zien waar ik sta. Als jij,
                als gast, nog een vraag hebt, stel me die dan gerust!
        </p>
    </div>
</section>

<ul class="footer" id="section3">
    <li><a href="https://nl-nl.facebook.com/mhmd.noor.3998263">
            <img src="/images/facebook.jpg"></a></li>

    <li><a href="https://www.instagram.com/mootje_xo1/">
            <img src="/images/insta.jpg"></a></li>
</ul>
</body>
</html>
