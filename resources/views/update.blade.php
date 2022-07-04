<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/css.css">
    <title>Document</title>
</head>
<body>
<form class="mi" method="post" action="{{url('/todo/update')}}" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <input name="id" type="hidden" value="{{$todo->id}}">

    <label class="label1"><h4> verander Naam voor je items </h4></label>
    <input placeholder="naam" name="name" type="text" value="{{$todo->name}}">

    <label  class="label1" for="fileinput"><h4> voeg een foto toe </h4></label>
    <input type="file"  name="image" value="{{$todo->image}}">

    <label class="label1"> <h4>opmerking toevoegen </h4></label>
    <input placeholder="opmerking" name="informatie" type="text" value="{{$todo->informatie}}">
    <input type="submit" placeholder="klaar">
</form>

</body>
</html>
