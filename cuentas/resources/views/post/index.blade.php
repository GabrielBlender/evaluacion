@extends('layouts.app')
@section('content')
    

<div class="row">
    <div class="table table-responsive">
        <table class="table table-bordered">
            <tr>
                <th width="150px">id</th>
                <th>Alias</th>
                <th>Banco</th>
                <th>ultimos digitos</th>
                <th class="text-center" width="150px">
                    <a href="#" class="create-modal btn btn-success btn-sm">
                        Añadir
                    </a>
                </th>
            </tr>
            {{ csrf_field() }}

            @foreach( $cuentas as $value)
                <tr class="post{{$value->id}}">
                    <td>{{$value->id}}</td>
                    <td> {{$value->alias}} </td>
                    <td>{{$value->id_banco}}</td>
                    <td>{{$value->ultimos_digitos}}</td>
                    <td style="display:flex;">
                    <a href="#" class="edit-modal btn btn-warning btn-sm" style=" margin-right:5px;" data-id="{{$value->id}}" data-alias="{{$value->alias}}" data-banco="{{$value->id_banco}}" data-digitos="{{$value->ultimos_digitos}}">
                        Editar
                    </a>
                    <a href="#" class="delete-modal btn btn-danger btn-sm" data-id="{{$value->id}}" data-alias="{{$value->alias}}" data-banco="{{$value->id_banco}}" data-digitos="{{$value->ultimos_digitos}}">
                        Eliminar
                    </a>
                    </td>
            @endforeach
        </table>
    </div>
</div>


<div class="modal fade" id="create" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" >
                       <div class="container">
                        <div class="form-group row add">
                            <label class="control-label mt-3" for="alias">Alias:</label>
                            <div class="p-2">
                                <input type="text" class="form-control" id="alias" name="alias" placeholder="alias">
                                <p class="error text-center alert alert-danger hidden"></p>
                            </div>
                        </div>

                        <div class="form-group row add">
                                <label class="control-label mt-3" for="banco">Banco:</label>
                                <div class="p-1">
                                    <select type="text" class="form-control" id="id_banco" name="id_banco" placeholder="banco">
                                        <option value="" disabled selected="true">seleccione el banco</option>
                                        @foreach ($bancos as $value)
                                        <option value="{{$value->id}}">{{$value->nombre_corto}}</option>
                                        @endforeach
                                    </select>
                                    <p class="error text-center alertalert-danger hidden"></p>
                                </div>
                        </div>

                        <div class="form-group row add">
                                <label class="control-label mt-3" for="ultimos_digitos">Ultimos digitos:</label>
                                <div class="p-1">
                                    <input type="text" class="form-control" id="ultimos_digitos" name="ultimos_digitos" placeholder="ultimos digitos">
                                    <p class="error text-center alertalert-danger hidden"></p>
                                </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning" type="submit" id="add">
                    Guardar
                </button>
                <button class="btn btn-warning" type="button" data-dismiss="modal" >
                    Cerrar
                </button>
            </div>

        </div>
    </div>
</div>


<div id="myModal"class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="fid">id</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fid" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="ali">Alias:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="ali" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label mt-3 col-sm-2" for="id_banc">Banco:</label>
                        <div class="p-1">
                            <select type="text" class="form-control" id="id_banc" name="id_banc " style="width: 300px;">
                                <option disabled>seleccione el banco</option>
                                @foreach ($bancos as $value)
                                <option value="{{$value->id}}">{{$value->nombre_corto}}</option>
                                @endforeach
                            </select>
                            <p class="error text-center alertalert-danger hidden"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="digitos">ultimos digitos</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="digitos">
                        </div>
                    </div>
                </form>



                {{-- Form Delete Post --}}
                <div class="deleteContent">
                    ¿Estas seguro de que quieres eliminarlo?
                </div>
            </div>

            <div class="modal-footer">

                <button type="button" class="btn actionBtn"  data-dismiss="modal">
                    Aceptar
                </button>

                <button type="button" class="btn btn-warning" data-dismiss="modal">
                    Cerrar
                </button>

            </div>
        </div>
    </div>
</div>


@endsection
