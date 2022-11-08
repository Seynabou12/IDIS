<div class="">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ms-auto">
            <div class="col">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleLargeModal">Add Network</button>
                <div class="modal fade" id="exampleLargeModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Formulaire d'Ajout de Networks</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="col-md-12 card card-body">
                                <form action="/networks/add" method="POST" id="form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="nasname" class="control-label">Nasname</label>
                                            <input type="text" class="form-control" name="nasname" id="nasname" required />
                                        </div>
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="region" class="control-label">Région</label>
                                            <input type="text" class="form-control" name="region" id="region" required />
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger mr-2" data-bs-dismiss="modal" value="annuler">Annuler</button>
                                <button type="submit" class="btn btn-primary" value="enregistrer">Enregistrer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>