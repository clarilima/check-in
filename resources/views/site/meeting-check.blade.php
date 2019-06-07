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
        <button class="btn btn-success m-b-2" data-toggle="modal" data-target="#modal_default">
            <span class="btn-label-icon left fa fa-plus mr-3"></span>Novo Participante
        </button>
    </div>

    {{--<!-- Modal Create -->--}}
    <div class="modal fade in" id="modal_default" style="display: none;">
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
                        <form action="/admin/emmiters" method="POST" id="formCreate">
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
                                    <label>Disabled Result</label>
                                    <select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                        <option selected="selected">Alabama</option>
                                        <option>Alaska</option>
                                        <option disabled="disabled">California (disabled)</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
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
    {{--<div class="modal fade" id="modal_create" tabindex="-1">--}}
    {{--<div class="modal-dialog">--}}
    {{--<div class="modal-content">--}}
    {{--<div class="modal-header">--}}
    {{--<button type="button" class="close" data-dismiss="modal">×</button>--}}
    {{--<h4 class="modal-title" id="myModalLabel">Criar novo Emissor</h4>--}}
    {{--</div>--}}

    {{--<section class="w-100" id="modal-teste" style="position: absolute; z-index: 1; background: transparent; opacity: 1;">--}}
    {{--<div class="form-create-participant">--}}
    {{--<form action="/admin/emmiters" method="POST" id="formCreate">--}}
    {{--@csrf--}}
    {{--<div class="modal-body">--}}

    {{--<div class="form-group">--}}
    {{--<label for="emailEmissor">Nome</label>--}}
    {{--<input type="text" class="form-control" name="name" id="nameEmissor" placeholder="Digite seu nome">--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
    {{--<label for="tokenEmissor">Token</label>--}}
    {{--<input type="text" class="form-control" name="token" id="tokenEmissor" placeholder="Token">--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
    {{--<label for="validadeEmissor">Validade</label>--}}
    {{--<input type="text" class="form-control" name="maturity" id="validadeEmissor" placeholder="Data de validade">--}}
    {{--</div>--}}

    {{--</div>--}}
    {{--<div class="modal-footer">--}}
    {{--<button type="button" class="btn" data-dismiss="modal">Fechar</button>--}}
    {{--<button type="submit" class="btn btn-primary">Enviar</button>--}}
    {{--</div>--}}
    {{--</form>--}}
    {{--</div>--}}
    {{--</section>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

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


            $('#datatables').DataTable({
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
        });
    </script>
@stop
