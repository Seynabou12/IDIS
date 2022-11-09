<div class="">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ms-auto">
            <div class="col">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleLargeModal">Add User</button>
                <div class="modal fade" id="exampleLargeModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Formulaire d'ajout d'utilisateur</h5>
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
