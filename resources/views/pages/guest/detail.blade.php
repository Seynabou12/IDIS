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

@php

    $guest = $list[0];

@endphp

<div class="card">
    <div class="card-header py-3">
        <div class="row g-3 align-items-center">
            <div class="col-12 col-lg-4 col-md-6 me-auto">
                <h5 class="mb-1"><strong>Nom & Prénom: </strong> {{ $guest['firstname'] }} {{ $guest['lastname'] }}</h5>
                <h5 class="mb-0"><strong> Téléphone: </strong> {{ $guest['phone']}}</h5>
                <h5 class="mb-0"><strong>Email: </strong> {{ $guest['email']}}</h5>
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
                                <p class="mb-1"><strong>Date de Création </strong> : {{ $guest['creationdate'] }}</p>
                                <p class="mb-1"><strong>Dernière Authentification</strong> : {{ $guest['authdate_orig'] }}</p>
                                <p class="mb-1"><strong>Date de Suppression</strong> : </p>
                                <p class="mb-1"><strong>Heure de Connexion</strong> : </p>
                                <p class="mb-1"><strong>Temp Total</strong> : </p>
                            </div>
                        </div>
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