<!doctype html>
<html lang="en" class="light-theme">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="/assets/images/favicon-32x32.png" type="image/png" />

	<link href="/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
	<link href="/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
	<link href="/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />

	<link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/assets/css/bootstrap-extended.css" rel="stylesheet" />
	<link href="/assets/css/style.css" rel="stylesheet" />
	<link href="/assets/css/icons.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link href="/assets/css/pace.min.css" rel="stylesheet" />
	<link href="/assets/css/dark-theme.css" rel="stylesheet" />
	<link href="/assets/css/light-theme.css" rel="stylesheet" />
	<link href="/assets/css/semi-dark.css" rel="stylesheet" />
	<link href="/assets/css/header-colors.css" rel="stylesheet" />

	<title>Selectionner une Entreprise</title>
</head>

<body>
	<div class="wrapper">
		<main class="page-content ">
			<div class="">
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="ms-auto">
						<div class="col">
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleLargeModal">Add Customer</button>
							<div class="modal fade" id="exampleLargeModal" tabindex="-1" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Formulaire d'Ajout d'entreprise</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="col-md-12 card card-body ">
											<form action="/customers" method="post" id="form">
												@csrf
												<div class="row">
													<div class="form-group mb-3 col-md-6">
														<label for="company_name" class="control-label">Company Name</label>
														<input type="text" class="form-control" name="company_name" id="company_name" required />
													</div>
													<div class="form-group mb-3 col-md-6">
														<label for="creationdate" class="control-label">Creation Date</label>
														<input type="text" class="form-control" name="creationdate" id="creationdate" required />
													</div>
												</div>
												<div class="row">
													<div class="form-group mb-3 col-md-6">
														<label for="creationby" class="control-label">Creation By</label>
														<input type="text" class="form-control" name="creationby" id="creationby" required />
													</div>
													<div class="form-group mb-3 col-md-6">
														<label for="region" class="control-label">Region</label>
														<input type="text" class="form-control" name="region" id="region" required />
													</div>
												</div>
												<div class="row">
													<div class="form-group mb-3 col-md-6">
														<label for="username" class="control-label">Username</label>
														<input type="text" class="form-control" name="username" id="username" required />
													</div>
													<div class="form-group mb-3 col-md-6">
														<label for="phone" class="control-label">Phone</label>
														<input type="text" class="form-control" name="phone" id="phone" required />
													</div>
												</div>
												<div class="row">
													<div class="form-group mb-3 col-md-6">
														<label for="plan_expiration" class="control-label">Plan Expiration</label>
														<input type="text" class="form-control" name="plan_expiration" id="plan_expiration" required />
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
			<div class="row">
				<div class="col-xl-9 mx-auto">
					<h6 class="mb-0 text-uppercase">Selectionner une Entreprise</h6>
					<hr />
					<div class="card">
						<div class="card-body">
							<div class="border p-3 rounded">
								<form action="/acceuil" method="post" id="form">
									@csrf
									<div class="mb-3">
										<label class="form-label">Select Customer</label>
										<select class="single-select" id="customer" onchange="selection()">
											<option value="">Customer</option>
											@foreach($customers as $customer)
											<option value="{{ $customer->id }}">{{ $customer->company_name }}</option>
											@endforeach
										</select>
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary">Selectionner</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		<div class="overlay nav-toggle-icon"></div>
		<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
	</div>

	<script src="/assets/js/bootstrap.bundle.min.js"></script>
	<script src="/assets/js/jquery.min.js"></script>
	<script src="/assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="/assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="/assets/js/pace.min.js"></script>
	<script src="/assets/plugins/select2/js/select2.min.js"></script>
	<script src="/assets/js/form-select2.js"></script>
	<script src="/assets/js/app.js"></script>

	<script>
		function selection() {
			document.location.href = document.location.origin + "/selected-customer/"+document.getElementById("customer").value;
		}
	</script>
</body>

</html>