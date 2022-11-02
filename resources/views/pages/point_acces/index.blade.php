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


<h6 class="mb-0 text-uppercase">Liste des pointaccess</h6>
<hr />
<div class="">
    <div class="col-md-12 card card-body">
        <form action="/pointacces" method="post" id="form">

            @csrf
            <div class="row">
                <div class="form-group mb-3 col-md-6">
                    <label for="nasname" class="control-label">nasname</label>
                    <input type="text" class="form-control" name="nasname" id="nasname" required />
                </div>
                <div class="form-group mb-3 col-md-6">
                    <label for="auth_port" class="control-label">Auth Port</label>
                    <input type="text" class="form-control" name="auth_port" id="auth_port" required />
                </div>
            </div>
            <div class="row">
                <div class="form-group mb-3 col-md-6">
                    <label for="acct_port" class="control-label">Acct Port</label>
                    <input type="text" class="form-control" name="acct_port" id="acct_port" required />
                </div>
                <div class="form-group mb-3 col-md-6">
                    <label for="region" class="control-label">Region</label>
                    <input type="text" class="form-control" name="region" id="region" required />
                </div>
            </div>
            <div class="row">
                <div class="form-group mb-3 col-md-6">
                    <label for="secret" class="control-label">Secret</label>
                    <input type="text" class="form-control" name="secret" id="secret" required />
                </div>
                <div class="form-group mb-3 col-md-6">
                    <label for="primary_ip" class="control-label">Primary Ip</label>
                    <input type="text" class="form-control" name="primary_ip" id="primary_ip" required />
                </div>
            </div>
            <div class="row">
                <div class="form-group mb-3 col-md-6">
                    <label for="backup_ip" class="control-label">Backup Ip</label>
                    <input type="text" class="form-control" name="backup_ip" id="backup_ip" required />
                </div>
            </div>
            <div class="form-group mt-4">
                <input type="reset" value="Annuler" class="btn btn-danger mr-2" onclick="$(this).resetform()">
                <input type="submit" value="Enregistrer" class="btn btn-primary">
            </div>

        </form>
    </div>
    <div class="col-md-12" style="margin-top: 20px;">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Firmwane</th>
                                <th>Name</th>
                                <th>Mac</th>
                                <th>Identifier</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Wan Ip</th>
                                <th>First Seen</th>
                                <th>Last Seen</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
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