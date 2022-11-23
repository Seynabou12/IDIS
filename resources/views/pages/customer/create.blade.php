<div class="">

	<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
		<div class="ms-auto">

			<div class="col">
				<!-- <a href="/accueil">
					<button type="submit" class="btn btn-primary">Select Customer</button>
				</a> -->
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleLargeModal">Add Customer</button>

				<div class="modal fade" id="exampleLargeModal" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Formulaire d'Ajout d'entreprise</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="col-md-12 card card-body ">
								<form action="/customers/create" method="POST" id="form" enctype="multipart/form-data">
									@csrf
									<div class="row">
										<div class="form-group mb-3 col-md-6">
											<label for="username" class="control-label">Username</label>
											<input type="text" class="form-control" name="username" id="username" required />
										</div>
										<div class="form-group mb-3 col-md-6">
											<label for="company_name" class="control-label">Company Name</label>
											<input type="text" class="form-control" name="company_name" id="company_name" required />
										</div>
									</div>
									<div class="row">
										<div class="form-group mb-3 col-md-6">
											<label for="phone" class="control-label">Phone</label>
											<input type="text" class="form-control" name="phone" id="phone" required />
										</div>
										<div class="form-group mb-3 col-md-6">
											<label for="plan_quantity" class="control-label">Plan Quantity</label>
											<input type="text" class="form-control" name="plan_quantity" id="plan_quantity" required />
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