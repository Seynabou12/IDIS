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

<h6 class="mb-0 text-uppercase">Liste des Vouchers</h6>
<hr />

<div class="">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ms-auto">
            <div class="col">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleLargeModal">Add Voucher</button>
                <div class="modal fade" id="exampleLargeModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Formulaire d'ajout de Vouchers</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="col-md-12 card card-body">
                                <form action="/vouchers" method="post" id="form">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="code" class="control-label">code</label>
                                            <input type="text" class="form-control" name="code" id="code" required />
                                        </div>
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="username" class="control-label">Username</label>
                                            <input type="text" class="form-control" name="username" id="username" required />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="notes" class="control-label">Notes</label>
                                            <input type="text" class="form-control" name="notes" id="notes" required />
                                        </div>
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="authdate" class="control-label">Auth Date</label>
                                            <input type="text" class="form-control" name="authdate" id="authdate" required />
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="deletiondate" class="control-label">Deletion Date</label>
                                            <input type="text" class="form-control" name="deletiondate" id="deletiondate" required />
                                        </div>
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="creationdate" class="control-label">Creation Date</label>
                                            <input type="text" class="form-control" name="creationdate" id="creationdate" required />
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger mr-2" data-bs-dismiss="modal" value="annuler">Annuler</button>
                                <button type="button" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12" style="margin-top: 20px;">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Numero</th>
                            <th>Code</th>
                            <th>Username</th>
                            <th>Notes</th>
                            <th>Creation Date</th>
                            <th>Deletion Date</th>
                            <th>Auth Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($vouchers as $voucher)
                        <tr>
                            <td>{{ $voucher->id }}</td>
                            <td>{{ $voucher->code }}</td>
                            <td>{{ $voucher->username }}</td>
                            <td>{{ $voucher->notes }}</td>
                            <td>{{ $voucher->creationdate }}</td>
                            <td>{{ $voucher->deletiondate  }}</td>
                            <td>{{ $voucher->authdate }}</td>

                            <td class="text-center text-primary cursor-event">
                                {{-- <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" title=""
                                            data-bs-original-title="View detail" aria-label="Views"><i
                                                class="fs-5 bi bi-eye-fill"></i></a> --}}
                                <span onclick="$(this).edit('{{ $voucher->id }}')"><i class="fs-5 bi bi-pencil-fill"></i></span>
                                <span class="text-danger" onclick="$(this).delete('{{ $voucher->id }}')"><i class="fs-5 bi bi-trash-fill"></i></span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
            $("#form").attr("action", "/vouchers");
        }

        $.fn.edit = function(id) {
            $.get(document.location.origin + "/vouchers/" + id, {
                    json: "json"
                },
                function(data, textStatus, jqXHR) {
                    $("#code").val(data.code).change();
                    $("#username").val(data.username).change();
                    $("#notes").val(data.notes).change();
                    $("#creationdate").val(data.creationdate).change();
                    $("#deletiondate").val(data.deletiondate).change();
                    $("#authdate").val(data.authdate).change();
                    // $("#form").attr("action", "/vouchers/" + data.uuid);
                },
                "json"
            );
        }
        $.fn.delete = function(id) {

            Swal.fire({
                title: 'Voulez-vous supprimer ce vouchers?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Supprimer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = document.location.origin + "/vouchers/" + id +
                        "/delete";
                }
            })
        }

    });
</script>
@endsection