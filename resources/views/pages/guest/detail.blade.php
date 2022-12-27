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

<div class="card">

    <div class="card-header py-3">
        <div class="row g-3 align-items-center">
            <div class="col-12 col-lg-4 col-md-6 me-auto">

                <h5 class="mb-1"><strong>Nom & Prénom: </strong> {{ $firstValue->firstname }} {{ $firstValue->lastname }}</h5>
                <h5 class="mb-0"><strong> Téléphone: </strong> {{ $firstValue->phone}}</h5>
                <h5 class="mb-0"><strong>Email: </strong> {{ $firstValue->email }}</h5>

            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="row row-cols-1 row-cols-xl-2 row-cols-xxl-3">
            <div class="col">
                <div class="card border shadow-none radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3">
                            <div class="info">
                                <p class="mb-1"><strong>Premiére Connexion: </strong>{{ $guest->creationdate }}</p>
                                <p class="mb-1"><strong>Derniére Connexion : </strong>{{ $guest->authdate }}</p>
                                <p class="mb-1"><strong>Durée de Connexion: </strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border shadow-none radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3">
                            <div class="info">
                                <p class="mb-1"><strong>Etat</strong> : {{ $firstValue->state ?? ''  }} </p>
                                <p class="mb-1"><strong>La Source</strong> : {{ $firstValue->auth_provider  ?? '' }} </p>
                                <p class="mb-1"><strong>Unité Organisationnelle</strong> : {{ $firstValue->country ?? ''  }} </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border shadow-none radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3">
                            <div class="info">
                                <p class="mb-1"><strong>Ville</strong> : {{ $firstValue->city ?? ''  }}</p>
                                <p class="mb-1"><strong>Pays</strong> : {{ $firstValue->country ?? '' }} </p>
                                <p class="mb-1"><strong>Département</strong> : {{ $firstValue->department ?? '' }} </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row p-3">
        <div class="col-12 col-lg-12">
            <div class="card border shadow-none radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0"></h5>
                    </div>
                    <div class="table-responsive" style="margin-top: 20px; ">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>

                                    <th>Adresse Mac</th>
                                    <th>Debut Connexion</th>
                                    <th>Fin Connexion</th>
                                    <th>Premiére Connexion</th>
                                    <th>Derniére Connexion</th>
                                    <th>Source</th>
                                    <th>Source Auth</th>
                                    <th>Portail Captif</th>
                                    <th>Ville</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach($device_data as $guests)
                                @if($guests->device_data)
                                <tr>

                                    <td>{{ $guests->device_data?->client_mac }}</td>
                                    <td>{{ $guests->device_data?->first_seen }}</td>
                                    <td>{{ $guests->device_data?->last_seen }}</td>
                                    <td>{{ $guests->creationdate }}</td>
                                    <td>{{ $guests->authdate }}</td>
                                    <td>{{ $guests->auth_provider }}</td>
                                    <td>{{ $guests->authsource}}</td>
                                    <td>{{ $guests->captive_portal }}</td>
                                    <td>{{ $guests->city  ?? '' }}</td>


                                </tr>
                                @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>

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