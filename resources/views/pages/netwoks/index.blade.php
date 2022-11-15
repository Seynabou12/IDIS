@extends('layouts.app')


@section('content')

@if ($errors->any())
@foreach ($errors->all() as $error)
<script>
    Lobibox.notify('error', {
        pauseDelayOnHover: true,
        size: 'mini',
        rounded: true,
        icon: 'bi bi-x-circle',
        delayIndicator: false,
        continueDelayOnInactiveTab: false,
        position: 'top right',
        msg: "{{ $error }}"
    });
</script>
@endforeach
@endif

@if (Session::has('success'))
<script>
    Lobibox.notify('success', {
        pauseDelayOnHover: true,
        size: 'mini',
        rounded: true,
        icon: 'bi bi-x-circle',
        delayIndicator: false,
        continueDelayOnInactiveTab: false,
        position: 'top right',
        msg: "{{ Session::get('success') }}"
    });
</script>
@endif
@include('pages.netwoks.create')
<h6 class="mb-0 text-uppercase">Liste des Networks</h6>
<hr />



<div class="col-md-12" style="margin-top: 20px;">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Numero</th>
                            <th>Nasname</th>
                            <th>Auth Port</th>
                            <th>Acct Port</th>
                            <th>Region</th>
                            <th>Secret</th>
                            <th>Ip Primary</th>
                            <th>Ip Backup</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($networks as $network)
                        <tr>
                            <td>{{ $network->id }}</td>
                            <td>{{ $network->nasname }}</td>
                            <td>{{ $network->auth_port }}</td>
                            <td>{{ $network->acct_port }}</td>
                            <td>{{ $network->region }}</td>
                            <td>{{ $network->secret }}</td>
                            <td>{{ $network->primary_ip }}</td>
                            <td>{{ $network->backup_ip }}</td>

                            <td class="text-center text-primary cursor-event">
                                {{-- <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" title=""
                                            data-bs-original-title="View detail" aria-label="Views"><i
                                                class="fs-5 bi bi-eye-fill"></i></a> --}}
                                <span onclick="$(this).edit('{{ $network->id }}')"><i class="fs-5 bi bi-pencil-fill"></i></span>
                                <span class="text-danger" onclick="$(this).delete('{{ $network->id }}')"><i class="fs-5 bi bi-trash-fill"></i></span>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $(document).ready(function() {
            $('#example').DataTable();
        });

        $.fn.resetform = function() {
            $("#form").attr("action", "/networks");
        }

        $.fn.edit = function(id) {
            $.get(document.location.origin + "/networks/" + id, {
                    json: "json"
                },
                function(data, textStatus, jqXHR) {
                    $("#nasname").val(data.nasname).change();
                    $("#auth_port").val(data.auth_port).change();
                    $("#acct_port").val(data.acct_port).change();
                    $("#region").val(data.region).change();
                    $("#secret").val(data.secret).change();
                    $("#primary_ip").val(data.primary_ip).change();
                    $("#backup_ip").val(data.backup_ip).change();
                    $("#form").attr("action", "/networks/" + data.id);
                },
                "json"
            );
        }

        $.fn.delete = function(id) {

            Swal.fire({
                title: 'Voulez-vous supprimer ce network?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Supprimer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = document.location.origin + "/networks/" + id +
                        "/delete";
                }
            })
        }

    });
</script>
@endsection