@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>ENCONTRO {{ $meeting->day }}</h1>
    @if($meeting->description != null)
        <p>
            {{$meeting->description}}
        </p>
    @endif
@stop

@section('content')
    <div class="btn-group">
        <button class="btn btn-success m-b-2" data-toggle="modal" data-target="#modal_create">
            <span class="btn-label-icon left fa fa-plus mr-3"></span>Novo Participante
        </button>
    </div>

    {{--<!-- Modal Create -->--}}
    <div class="modal fade in" id="modal_create" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Cadastrar novo Participante</p>
                    <div class="form-create-participant">
                        <form action="/participants" method="POST" id="formCreate">
                            @csrf
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="emailEmissor">Nome</label>
                                    <input type="text" class="form-control" name="name" id="nameEmissor" placeholder="Digite seu nome">
                                </div>
                                <div class="form-group">
                                    <label for="tokenEmissor">Idade</label>
                                    <input type="text" class="form-control" name="age" id="tokenEmissor" placeholder="Token">
                                </div>
                                <div class="form-group">
                                    <label for="validadeEmissor">Data de nascimento</label>
                                    <input type="date" class="form-control" name="birth" id="validadeEmissor" placeholder="Data de validade">
                                </div>
                                <div class="form-group">
                                    <label>Projeto</label>
                                    <select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" id="project" name="project_id">
                                        <option selected=""> - </option>
                                        @foreach($projects as $project)
                                            <option value="{{$project->id}}">
                                                {{$project->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Rebanho</label>
                                    <select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" disabled id="rebanho" name="group_id">
                                        <option selected=""> - </option>
                                    </select>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel" id="panel-filter-check">
        <div class="panel-body">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Projeto</label>
                        <select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" id="projectId" name="project_id">
                            <option selected=""> - </option>
                            @foreach($projects as $project)
                                <option value="{{$project->id}}">
                                    {{$project->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Rebanho</label>
                        <select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" disabled id="rebanhoId" name="group_id">
                            <option selected=""> - </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
                <button type="button" class="btn bg-warning" id="btn-filtrar-participants" disabled>Filtrar</button>
                <button type="button" class="btn bg-success" id="btn-clear">Limpar</button>
        </div>
    </div>

    <div class="panel" id="table-check">
        <div class="panel-body">
            <div class="table-primary">
                <table class="table table-striped table-bordered" id="datatables" style="width: 100%">
                    <thead>
                    <tr>
                        <th>Pessoas</th>
                        <th style="color: #000;">Check-in</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('css')

    {{--<link rel="stylesheet" href="/css/admin_custom.css">--}}
@stop
@section('js')
    <script>
        $(document).ready( function () {

            var idMeeting = '{{$meeting->id}}';


            var table = $('#datatables').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: '/meetings/' + idMeeting,
                columns: [
                    {data: 'name'},
                    {render: renderBtnCheck},
                ],
            });

            function renderBtnCheck(data, type, row){
                var check = row.checkMeeting ? 'checked' : '';
                // return `<!--<button class="btn btn-primary btn-edit" data-name="${row.name}" data-token="${row.token}" data-maturity="${row.maturity}" data-id="${row.id}"><i class="fa fa-edit"></i></button>-->`;
                return `<div class="custom-control custom-switch"><input type="checkbox" data-id="${row.id}" ${check} data-check="${row.checkMeeting}" class="custom-control-input btn-check" id="check-${row.id}"><label class="custom-control-label" for="check-${row.id}"></label></div>`;
            }

            $('#datatables').on('change', '.btn-check', function () {
                let participant = $(this).data('id');
                let participantChecked = $(this).data('check');
                let meeting = idMeeting;
                let self = $(this);
                console.log(participantChecked);
                if($(this).is(':checked')){
                    axios.post('/api/check-in', {
                        participant_id: participant,
                        meeting_id: meeting,
                        // opt_in: !$('#opt_in').prop('checked')
                    })
                        .then(function(response){

                        })
                        .catch(function (error) {
                            alert('Não rolou');
                        });
                }else{
                    axios.delete('/api/check-out/'+participant+'/'+meeting)
                        .then(function(response){
                        })
                }

            });

            $('#project').on('change', function (e) {
                var project = $(this).val();
                axios.get(`/api/projects/${project}/groups`)
                    .then(function (response) {
                        $('#rebanho').empty();
                        var groups = response.data;
                        if( groups.length > 0){
                            $('#rebanho').append(`<option value="">Selecione um Rebanho</option>`);
                            $.each(groups, function (key, value) {
                                $('#rebanho').append(`<option value="${value.id}">${value.name}</option>`);
                            });
                            $('#rebanho').prop('disabled', false);

                        }else{
                            $('#rebanho').append(`<option value="">Esse projeto não possui nenhum rebanho</option>`);
                            $('#rebanho').prop('disabled', true);
                        }
                    });
            });
            $('#projectId').on('change', function (e) {
                var project = $(this).val();
                axios.get(`/api/projects/${project}/groups`)
                    .then(function (response) {
                        $('#rebanhoId').empty();
                        var groups = response.data;
                        if( groups.length > 0){
                            $('#rebanhoId').append(`<option value="">Selecione um Rebanho</option>`);
                            $.each(groups, function (key, value) {
                                $('#rebanhoId').append(`<option value="${value.id}">${value.name}</option>`);
                            });
                            $('#rebanhoId').prop('disabled', false);
                            $('#btn-filtrar-participants').prop('disabled', false);

                        }else{
                            $('#rebanhoId').append(`<option value="">Esse projeto não possui nenhum rebanho</option>`);
                            $('#rebanhoId').prop('disabled', true);
                            $('#btn-filtrar-participants').prop('disabled', true);
                        }
                    });
            });
            $('#btn-filtrar-participants').on('click', function (e) {
                var group = $('#rebanhoId').val();
                let url = `/meetings/${idMeeting}`;
                url += `?idGroup=${group}`;
                table.ajax.url(url).load();

            });
            $('#btn-clear').on('click', function(){
                $('#projectId').val('-');
                $('#rebanhoId').val('-')
                $('#rebanhoId').prop('disabled', true);

                let url = `/meetings/${idMeeting}`;
                table.ajax.url(url).load();
            });
        });
    </script>
@stop
