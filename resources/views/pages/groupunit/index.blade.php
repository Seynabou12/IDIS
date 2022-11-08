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


<h6 class="mb-0 text-uppercase">Liste de l'Organisation</h6>
<hr />
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Name</th>
                                <th>Members</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orgunits as $orgunit)
                            <tr>
                                <td>{{ $orgunit->id }}</td>
                                <td>{{ $orgunit->name }}</td>
                                <td>{{ $orgunit->members }}</td>
                                <td class="text-center text-primary cursor-event">
                                    {{-- <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" title=""
                                                data-bs-original-title="View detail" aria-label="Views"><i
                                                    class="fs-5 bi bi-eye-fill"></i></a> --}}
                                    <span onclick="$(this).edit('{{ $orgunit->id }}')"><i class="fs-5 bi bi-pencil-fill"></i></span>
                                    <span class="text-danger" onclick="$(this).delete('{{ $orgunit->id }}')"><i class="fs-5 bi bi-trash-fill"></i></span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <form action="/orgunits" method="post" id="form">
            @csrf
            <div class="form-orgunit mb-2">
                <label for="name" class="control-label">Nom de la orgunit</label>
                <input type="text" class="form-control" name="name" id="name" required />
            </div>
            <div class="form-orgunit mt-4">
                <input type="reset" value="Annuler" class="btn btn-danger mr-2" onclick="$(this).resetform()">
                <input type="submit" value="Enregistrer" class="btn btn-primary">
            </div>
        </form>
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
            $("#form").attr("action", "/orgunits");
        }

        $.fn.edit = function(id) {
            $.get(document.location.origin + "/orgunits/" + id, {
                    json: "json"
                },
                function(data, textStatus, jqXHR) {
                    $("#name").val(data.name).change();
                    $("#form").attr("action", "/orgunits/" + data.id);
                },
                "json"
            );
        }

        $.fn.delete = function(id) {
            Swal.fire({
                title: 'Voulez-vous supprimer cette Organisation?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Supprimer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = document.location.origin + "/orgunits/" + id +
                        "/delete";
                }
            })
        }

    });
</script>
@endsection