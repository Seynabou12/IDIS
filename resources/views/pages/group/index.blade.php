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


    <h6 class="mb-0 text-uppercase">Liste des Groups</h6>
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
                                    <th>Group Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groups as $group)
                                    <tr>
                                        <td>{{ $group->id }}</td>
                                        <td>{{ $group->groupname }}</td>
                                        <td class="text-center text-primary cursor-event">
                                            {{-- <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" title=""
                                                data-bs-original-title="View detail" aria-label="Views"><i
                                                    class="fs-5 bi bi-eye-fill"></i></a> --}}
                                            <span onclick="$(this).edit('{{ $group->id }}')"><i
                                                    class="fs-5 bi bi-pencil-fill"></i></span>
                                            <span class="text-danger" onclick="$(this).delete('{{ $group->id }}')"><i
                                                class="fs-5 bi bi-trash-fill"></i>
                                            </span>
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
            <form action="/groups/create" method="POST" id="form" enctype="multipart/form-data">

                @csrf
                <div class="form-group mb-2">
                    <label for="groupname" class="control-label">Groupname</label>
                    <input type="text" class="form-control" name="groupname" id="groupname" required />
                </div>
                <div class="form-group mt-4">
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
                $("#form").attr("action", "/groups");
            }

            $.fn.edit = function(id) {
                $.get(document.location.origin + "/groups/" + id, {
                        json: "json"
                    },
                    function(data, textStatus, jqXHR) {
                        $("#groupname").val(data.groupname).change();
                        $("#form").attr("action", "/groups/" + data.id);
                    },
                    "json"
                );
            }

            $.fn.delete = function(id) {
                Swal.fire({
                    title: 'Voulez-vous supprimer ce groupe?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Supprimer!',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.location.href = document.location.origin + "/groups/" + id +
                            "/delete";
                    }
                })
            }

        });
    </script>
@endsection
