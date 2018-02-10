@extends('welcome')


@section('content') 
  <div class="container">
    
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <table>
          <tr>
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
            <th>AFILIACION IMSS</th>
            <th>FECHA DE CONTRATO</th>
            <th>MODO DE NACIONALIDAD</th>
            <th>FECHA DE NACIMIENTO</th>
            <th>ENTIDAD DE NACIMIENTO</th>
            <th>MUNICIPIO DE NACIMIENTO</th>
            <th>COLONIA DE NACIMIENTO</th>
          </tr>  
          @if($employeesFail !== null)
            <tr style="background: orange;">
              <td colspan="18">Errores</td>
            </tr>
            @foreach ($employeesFail as $item)
              <tr>
                @foreach($item as $key => $val)
                  @if($key !== 'index')
                    <td>{{  $val }}</td>
                  @endif
                @endforeach
              </tr>
            @endforeach
          @endif  
          
          @if($employeesSave !== null)
            <tr style="background: blue;">
              <td colspan="18">Guardados</td>
            </tr>
            @foreach ($employeesSave as $item)
              <tr>
                <td>{{$item->names}}</td>
                <td>{{$item->paternal_surname}}</td>
                <td>{{$item->maternal_surname}}</td>
              </tr>
            @endforeach
          @endif  
        </table> 
          
      </div>
  </div>
@endsection