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

<h6 class="mb-0 text-uppercase">Liste des Sessions</h6>
<hr />
<div class="col-md-12" style="margin-top: 20px;">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>

                            <th>Numéro</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Nom & Prénom</th>
                            <th>Telephone</th>
                            <th>Date de Creation</th>
                            <th>Dernière Authentification</th>
                            <th>Date Authentification</th>
                            <th>Action</th>

                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($guests as $guest)
                        <tr>

                            <td>{{ $guest->id }}</td>
                            <td>{{ $guest->username }}</td>
                            <td>{{ $guest->email }}</td>
                            <td>{{ $guest->fullname  }}</td>
                            <td>{{ $guest->phone }}</td>
                            <td>{{ $guest->creationdate  }}</td>
                            <td>{{ $guest->authdate_orig }}</td>
                            <td>{{ $guest->authdate }}</td>

                            <td class="text-center text-primary cursor-event">

                                <a href="/guests/{{ $guest->id }}/details" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" aria-label="Views"><i class="fs-5 bi bi-eye-fill"></i></a>
                                <span class="text-warning" onclick="$(this).edit('{{ $guest->id }}')"><i class="fs-5 bi bi-pencil-fill"></i></span>
                                <span class="text-danger" onclick="$(this).delete('{{ $guest->id }}')"><i class="fs-5 bi bi-trash-fill"></i></span>
                                
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
                    $("#authdate_orig").val(data.authdate_orig).change();
                    $("#authdate").val(data.authdate).change();
                    $("#form").attr("action", "/users/" + id);
                },
                "json"
            );
        }

        $.fn.delete = function(id) {

            Swal.fire({
                title: 'Voulez-vous supprimer cet utilisateur?',
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