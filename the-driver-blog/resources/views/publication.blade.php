<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="{{ asset('/vendors/ckeditor/ckeditor.js') }}"></script>

    <title>Publicación</title>
</head>

<body>

<div class="container">
    @csrf
    <nav></nav>
    @if(!is_null($p))
        <h1 class="text-center mt-5"><b>{{$p->title}}</b></h1>
        <div class="row">
            <div class="column">
                <img src="{{Storage::url($p->image)}}" height="150px" width="200px">
            </div>
            <div class="column pl-5 mt-4">
                <p>Likes: {{$p->likes}}</p>
                <p>Fecha de creación: {{$p->created_at}}</p>
            </div>
        </div>
        <br>
        <a class="btn btn-success" href="/publications">Volver</a>
        <a class="btn btn-info" href="/createResponse/{{$p->id}}">Crear respuesta</a>
        <a class="btn btn-info" href="/createResponse/{{$p->id}}">Me gusta <img alt="yes" src="http://127.0.0.1:8000/vendors/ckeditor/plugins/smiley/images/thumbs_up.png" style="height:23px; width:23px" title="yes" /></a>
    @endif
    <hr>
    @if(!is_null($responses))
        @foreach($responses as $r)
            <div class="card">
                <div class="card-header">
                    {!! $r->name !!}
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        {!! $r->description !!}
                        <hr>
                        <p>likes: {!! $r->likes !!}</p>
                        <p>Aprobado: {!! $r->is_approved !!}</p>
                    </blockquote>
                </div>
            </div>
            <hr>
        @endforeach
    @endif
    @if(count($responses) == 0)
        <p class="alert alert-warning"><b>No hay respuestas</b></p>
    @endif

</div>
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>

<!-- Option 2: jQuery, Popper.js, and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>

</html>
