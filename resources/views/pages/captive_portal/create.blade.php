<div class="">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ms-auto">
            <div class="col">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleLargeModal">Add Captive Portal</button>
                <div class="modal fade" id="exampleLargeModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Formulaire d'Ajout de Portail Captive</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="col-md-12 card card-body">
                                <form action="/portail_captive" method="post" id="form" >
                                    @csrf
                                    <div class="row">
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="nasname" class="control-label">Name</label>
                                            <input type="text" class="form-control" name="nasname" id="nasname" required />
                                        </div>
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="auth_port" class="control-label">Network</label>
                                            <input type="text" class="form-control" name="auth_port" id="auth_port" required />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="acct_port" class="control-label">Vendor</label>
                                            <input type="text" class="form-control" name="acct_port" id="acct_port" required />
                                        </div>
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="region" class="control-label">Nasname</label>
                                            <input type="text" class="form-control" name="region" id="region" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-danger mr-2" data-bs-dismiss="modal" value="annuler">Annuler</button>
                                        <input type="submit" class="btn btn-primary" value="Enregistrer" />
                                    </div>
                                </form>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>