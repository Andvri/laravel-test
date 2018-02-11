@extends('layouts.app')


@section('content') 
  <div class="container">
  <div class="row">
    <results 
      :dupli="{{json_encode($duplicateEmployees)}}"
      :err="{{json_encode($employeesFail)}}"
      :save="{{json_encode($employeesSave)}}"
      ></results>
  </div>
@endsection