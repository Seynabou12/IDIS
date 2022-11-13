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
                                <form action="/portail_captifs" method="POST" id="form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="nasname" class="control-label">Name</label>
                                            <input type="text" class="form-control" name="nasname" id="nasname" required />
                                        </div>
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="network_id" class="control-label">Network</label>
                                            <input type="text" class="form-control" name="network_id" id="network_id" required />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="vendor" class="control-label">Vendor</label>
                                            <input type="text" class="form-control" name="vendor" id="vendor" required />
                                        </div>
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="nasname" class="control-label">Nasname</label>
                                            <input type="text" class="form-control" name="nasname" id="nasname" required />
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger mr-2" data-bs-dismiss="modal" value="annuler">Close</button>
                                        <input type="submit" class="btn btn-primary" value="Enregistrer" />
                                    </div>
                                </form>
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
            $("#form").attr("action", "/portail_captifs");
        }

        $.fn.edit = function(id) {
            $.get(document.location.origin + "/portail_captifs/" + id, {
                    json: "json"
                },
                function(data, textStatus, jqXHR) {
                    $("#nasname").val(data.nasname).change();
                    $("#network_id").val(data.network_id).change();
                    $("#vendor").val(data.vendor).change();
                    $("#nasname").val(data.nasname).change();;
                    $("#form").attr("action", "//portail_captifs/" + data.id);
                },
                "json"
            );
        }
        $.fn.delete = function(id) {

            Swal.fire({
                title: 'Voulez-vous supprimer ce portail_captifs?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Supprimer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = document.location.origin + "/portail_captifs/" + id +
                        "/delete";
                }
            })
        }

    });
</script>
@endsection