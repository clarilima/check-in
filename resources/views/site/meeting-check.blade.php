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
    <div class="panel" id="table-check">
        <div class="panel-body">
            <div class="table-primary">
                <table class="table table-striped table-bordered" id="datatables" style="width: 100%">
                    <thead>
                    <tr>
                        <th>Pessoas</th>
                        <th>Check-in</th>
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
                let meeting = idMeeting;
                axios.post('/api/check-in', {
                    participant_id: participant,
                    meeting_id: meeting,
                    // opt_in: !$('#opt_in').prop('checked')
                })
                    .then(function(response){
                        alert('Check in com sucesso');
                        // $('#modal-loading2').modal('hide');
                        // $('body').css({'overflow': 'hidden'});
                        // $('#modal-success').css({'overflow-y': 'auto'});
                        // $('#modal-success').modal('show');
                        // $('#form-register-valet-partners')[0].reset();
                        // $('#form-register-valet-partners select').get(0).selectedIndex = 0;
                        // $('input').closest('.form-group').removeClass('input-focus').find('.label-text').removeClass('focus');
                    })
                    .catch(function (error) {
                        alert('Não rolou');
                    });
            });
        });
    </script>
@stop
