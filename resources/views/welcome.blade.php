@extends('layouts.app')


@section('content') 
<article class="message is-danger">
<div class="message-header">
    <p>Error al subir la hoja de calculo</p>
    <button class="delete" aria-label="delete"></button>
</div>
<div class="message-body">
    Solo se soportan archivos con extensiones xls y xslx
</div>
</article>
@endsection