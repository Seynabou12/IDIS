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


<h6 class="mb-0 text-uppercase">Liste des Portails Captifs</h6>
<hr />
<div class="">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ms-auto">
            <div class="col">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleLargeModal">Add Captive Portal</button>
                <div class="modal fade" id="exampleLargeModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Formulaire d'Ajout de Portail Captive</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="col-md-12 card card-body">
                                <form action="/portail_captive" method="post" id="form">

                                    @csrf
                                    <div class="row">
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="nasname" class="control-label">Name</label>
                                            <input type="text" class="form-control" name="nasname" id="nasname" required />
                                        </div>
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="auth_port" class="control-label">Network</label>
                                            <input type="text" class="form-control" name="auth_port" id="auth_port" required />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="acct_port" class="control-label">Vendor</label>
                                            <input type="text" class="form-control" name="acct_port" id="acct_port" required />
                                        </div>
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="region" class="control-label">Nasname</label>
                                            <input type="text" class="form-control" name="region" id="region" required />
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger mr-2" data-bs-dismiss="modal" value="annuler">Close</button>
                                <button type="button" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="">
    <div class="col-md-12" style="margin-top: 20px;">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Name</th>
                                <th>Networks</th>
                                <th>Vendor</th>
                                <th>Nasname</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($captifportals as $captifportal)
                            <tr>
                                <td>{{ $captifportal->id }}</td>
                                <td>{{ $captifportal->name }}</td>
                                <td>{{ $captifportal->network_id }}</td>
                                <td>{{ $captifportal->vendor }}</td>
                                <td>{{ $captifportal->nasname  }}</td>
                                <td class="text-center text-primary cursor-event">
                                    {{-- <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" title=""
                                            data-bs-original-title="View detail" aria-label="Views"><i
                                                class="fs-5 bi bi-eye-fill"></i></a> --}}
                                    <span onclick="$(this).edit('{{ $captifportal->id }}')"><i class="fs-5 bi bi-pencil-fill"></i></span>
                                    <span class="text-danger" onclick="$(this).delete('{{ $captifportal->id }}')"><i class="fs-5 bi bi-trash-fill"></i></span>
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
            $("#form").attr("action", "/pointacces");
        }

        $.fn.edit = function(id) {
            $.get(document.location.origin + "/pointacces/" + id, {
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
                    // $("#form").attr("action", "/pointacces/" + data.uuid);
                },
                "json"
            );
        }
        $.fn.delete = function(id) {

            Swal.fire({
                title: 'Voulez-vous supprimer ce pointacces?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Supprimer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = document.location.origin + "/pointacces/" + id +
                        "/delete";
                }
            })
        }

    });
</script>
@endsection