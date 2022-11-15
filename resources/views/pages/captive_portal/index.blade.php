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

@include('pages.captive_portal.create')

<h6 class="mb-0 text-uppercase">Liste des Portails Captifs</h6>
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
                                <th>Name</th>
                                <th>Networks Id</th>
                                <th>Vendor</th>
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
                    $("#form").attr("action", "/portail_captifs/" + data.id);
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