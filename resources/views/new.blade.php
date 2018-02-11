@extends('layouts.app')
@php

  $employeesSave = [ "id" => 1];
  $boolean = false;
@endphp

@section('content') 
  <div class="container" style="overflow: auto;">
      <h2 class="title">La hoja de calculo debe presentar la siguiente estructura</h2>
      <table class="table is-bordered is-striped">
          <thead>
            <tr>
              <th>PRIMERA FILA</th>
              <th>EMPRESA</th>
              <th>NOMBRES</th>
              <th>APELLIDO PATERNO</th>
              <th>APELLIDO MATERNO</th>
              <th>SEXO</th>
              <th>RFC</th>
              <th>CLAVE DEL IFE</th>
              <th>CLAVE DEL ELECTOR</th>
              <th>TELEFONO</th>
              <th>CURP</th>
              <th>ESTADO CIVIL</th>
              <th>AFILIACION A IMSS</th>
              <th>FECHA DE CONTRATO</th>
              <th>MODO DE NACIONALIDAD</th>
              <th>FECHA DE NACIMIENTO</th>
              <th>ENTIDAD DE NACIMIENTO</th>
              <th>MUNICIPIO DE NACIMIENTO</th>
              <th>COLONIA DE NACIMIENTO</th>
              
            </tr>
          </thead>
          <tbody>
            
            <tr>
              <th>CONDICIONES DE LAS SIGUIENTES FILAS</th>
              <td>OBLIGATORIO</td>
              <td>OBLIGATORIO</td>
              <td>OBLIGATORIO</td>
              <td>OBLIGATORIO</td>
              <td>OBLIGATORIO</td>
              <td>OBLIGATORIO, UNICO</td>
              <td>OBLIGATORIO SI POSEE CLAVE DE ELECTOR, UNICO</td>
              <td>OBLIGATORIO SI POSEE CLAVE DEL IFE, UNICO</td>
              <td>OBLIGATORIO</td>
              <td>OPCIONAL, UNICO</td>
              <td>OBLIGATORIO</td>
              <td>OPCIONAL, UNICO</td>

              <td>OBLIGATORIO</td>
              <td>OBLIGATORIO</td>
              <td>OBLIGATORIO</td>
              <td>OBLIGATORIO</td>
              <td>OBLIGATORIO</td>
              <td>OBLIGATORIO</td>
            </tr>
            
          </tbody>
        </table>
  </div>
@endsection