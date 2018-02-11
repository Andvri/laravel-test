@extends('layouts.app')


@section('content') 
  <div class="container">
    
  <div class="row">
    <ttable :data="{{json_encode($data)}}"></ttable>
  </div>
@endsection