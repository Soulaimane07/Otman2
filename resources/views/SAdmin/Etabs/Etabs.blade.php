@extends('SAdmin/General.General')

@section('content')
<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
        <div class="card-body Header">
            <h2 class="fw-semibold">Etablissements ( {{$etabs->count()}} ) </h2>
            <a href="/admin/etablissements/create" type="button" class="btn btn-primary m-1">Create Etablissement</a>
        </div>
    </div>
    <div class="mx-auto">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Etablissement</th>
                <th scope="col">Breviation</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($etabs as $etab)
                    <tr>
                        <th scope="row">{{$etab['id']}}</th>
                        <td>{{$etab['etab']}}</td>
                        <td>{{$etab['bref']}}</td>
                        <td class="TableButtons">
                            <a href="/admin/etablissements/{{$etab['id']}}"type="button" class="btn btn-success mx-2" >
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                                    <path d="M13.5 6.5l4 4"></path>
                                 </svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection