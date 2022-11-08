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

<h6 class="mb-0 text-uppercase">Liste des Comptes</h6>
<hr />

<div class="">
   
    <div class="col-md-12" style="margin-top: 20px;">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Company Name</th>
                                <th>Creation Date</th>
                                <th>Creation By</th>
                                <th>Region</th>
                                <th>Total Users</th>
                                <th>Username</th>
                                <th>Phone</th>
                                <th>Plan</th>
                                <th>Plan Expiration</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($customers as $customer)
                            <tr>
                                <td><a href="#">{{ $customer->id }}</a></td>
                                <td>{{ $customer->company_name }}</td>
                                <td>{{ $customer->creationdate }}</td>
                                <td>{{ $customer->creationby }}</td>
                                <td>{{ $customer->region }}</td>
                                <td>{{ $customer->total_users  }}</td>
                                <td>{{ $customer->username}}</td>
                                <td>{{ $customer->phone  }}</td>
                                <td>{{ $customer->plan  }}</td>
                                <td>{{ $customer->plan_expiration }}</td>
                                <td class="text-center text-primary cursor-event">
                                    {{-- <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" title=""
                                            data-bs-original-title="View detail" aria-label="Views"><i
                                                class="fs-5 bi bi-eye-fill"></i></a> --}}
                                    <span onclick="$(this).edit('{{ $customer->id }}')"><i class="fs-5 bi bi-pencil-fill"></i></span>
                                    <span class="text-danger" onclick="$(this).delete('{{ $customer->id }}')"><i class="fs-5 bi bi-trash-fill"></i></span>
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
            $("#form").attr("action", "/customers");
        }

        $.fn.edit = function(id) {
            $.get(document.location.origin + "/customers/" + id, {
                    json: "json"
                },
                function(data, textStatus, jqXHR) {
                    $("#company_name").val(data.company_name).change();
                    $("#creationdate").val(data.creationdate).change();
                    $("#creationby").val(data.creationby).change();
                    $("#region").val(data.region).change();
                    $("#total_users").val(data.total_users).change();
                    $("#username").val(data.username).change();
                    $("#phone").val(data.phone).change();
                    $("#plan").val(data.plan).change();
                    $("#plan_expiration").val(data.plan_expiration).change();
                    // $("#form").attr("action", "/customers/" + data.uuid);
                },
                "json"
            );
        }
        $.fn.delete = function(id) {

            Swal.fire({
                title: 'Voulez-vous supprimer ce customers?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Supprimer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = document.location.origin + "/customers/" + id +
                        "/delete";
                }
            })
        }

    });
</script>
@endsection