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

<h6 class="mb-0 text-uppercase">Liste des Utilisateurs</h6>
<hr />
<div class="">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ms-auto">
            <div class="col">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleLargeModal">Add User</button>
                <div class="modal fade" id="exampleLargeModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Formulaire d'ajout de User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="col-md-12 card card-body">
                                <form action="/networks" method="post" id="form">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="username" class="control-label">Username</label>
                                            <input type="text" class="form-control" name="username" id="username" required />
                                        </div>
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="email" class="control-label">Email</label>
                                            <input type="text" class="form-control" name="email" id="email" required />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="firstname" class="control-label">Firstname</label>
                                            <input type="text" class="form-control" name="firstname" id="firstname" required />
                                        </div>
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="lastname" class="control-label">Lastname</label>
                                            <input type="text" class="form-control" name="lastname" id="lastname" required />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="fullname" class="control-label">Fullname</label>
                                            <input type="text" class="form-control" name="fullname" id="fullname" required />
                                        </div>
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="phone" class="control-label">Phone</label>
                                            <input type="text" class="form-control" name="phone" id="phone" required />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="creationdate" class="control-label">Creation Date</label>
                                            <input type="date" class="form-control" name="creationdate" id="creationdate" required />
                                        </div>
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="creationby" class="control-label">Creation By</label>
                                            <input type="email" class="form-control" name="creationby" id="creationby" required />
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
                            <th>Username</th>
                            <th>Email</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Fullname</th>
                            <th>Phone</th>
                            <th>Creation Date</th>
                            <th>Aut Date Orig</th>
                            <th>Aut Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->firstname }}</td>
                            <td>{{ $user->lastname }}</td>
                            <td>{{ $user->fullname  }}</td>
                            <td>{{ $user->phone}}</td>
                            <td>{{ $user->creationdate  }}</td>
                            <td>{{ $user->authdate_orig  }}</td>
                            <td>{{ $user->authdate }}</td>
                            <td class="text-center text-primary cursor-event">
                                {{-- <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" title=""
                                            data-bs-original-title="View detail" aria-label="Views"><i
                                                class="fs-5 bi bi-eye-fill"></i></a> --}}
                                <span onclick="$(this).edit('{{ $user->id }}')"><i class="fs-5 bi bi-pencil-fill"></i></span>
                                <span class="text-danger" onclick="$(this).delete('{{ $user->id }}')"><i class="fs-5 bi bi-trash-fill"></i></span>
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
            $("#form").attr("action", "/users");
        }

        $.fn.edit = function(id) {
            $.get(document.location.origin + "/users/" + id, {
                    json: "json"
                },
                function(data, textStatus, jqXHR) {
                    $("#username").val(data.username).change();
                    $("#email").val(data.email).change();
                    $("#firstname").val(data.firstname).change();
                    $("#lastname").val(data.lastname).change();
                    $("#fullname").val(data.fullname).change();
                    $("#phone").val(data.phone).change();
                    $("#creationdate").val(data.creationdate).change();
                    $("#source").val(data.source).change();
                    $("#authdate_orig").val(data.authdate_orig).change();
                    $("#authdate").val(data.authdate).change();
                    // $("#form").attr("action", "/users/" + data.uuid);
                },
                "json"
            );
        }
        $.fn.delete = function(id) {

            Swal.fire({
                title: 'Voulez-vous supprimer ce users?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Supprimer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = document.location.origin + "/users/" + id +
                        "/delete";
                }
            })
        }

    });
</script>
@endsection