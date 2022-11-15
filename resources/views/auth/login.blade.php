<!doctype html>
<html lang="en" class="light-theme">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="/assets/images/favicon-32x32.png" type="image/png" />

  <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/assets/css/bootstrap-extended.css" rel="stylesheet" />
  <link href="/assets/css/style.css" rel="stylesheet" />
  <link href="/assets/css/icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <link href="/assets/css/pace.min.css" rel="stylesheet" />

  <title>Login</title>
</head>

<body>

  <div class="wrapper">
    <main class="authentication-content">
      <div class="container-fluid">
        <div class="authentication-card">
          <div class="card shadow rounded-0 overflow-hidden">
            <div class="row g-0">
              <div class="col-lg-5 bg-login d-flex align-items-center justify-content-center">
                <img src="/assets/images/products/login.png" class="img-fluid" alt="">
              </div>
              <div class="col-lg-7">
                <div class="card-body p-4 p-sm-5">

                  <h4 class="card-title" style="text-align: center; font-weight: bold; font-size: 30px;">TOTAL_WIFI</h4>
                  <form action="/" method="POST">
                    @csrf
                    <div class="login-separater text-center mb-4"> <span>OU CONECTEZ-VOUS AVEC CLOUDI-FI</span>
                      <hr>
                    </div>
                    @if (Session::has('message'))
                    <p class="alert {{Session::get('class-alert')}}">{{Session::get('message')}}</p>
                    @endif
                    <div class="row g-3">
                      <div class="col-12" style="padding: 20px 0 0 0;">
                        <label for="inputEmailAddress" class="form-label">Adresse Email</label>
                        <div class="ms-auto position-relative">
                          <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-envelope-fill"></i></div>
                          <input type="email" class="form-control radius-30 ps-5" id="inputEmailAddress" placeholder="Adresse Email" name="email">
                        </div>
                      </div>
                      <div class="col-12" style="padding: 20px 0 0 0;">
                        <label for="inputChoosePassword" class="form-label">Enter le Mot de Passe</label>
                        <div class="ms-auto position-relative">
                          <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                          <input type="password" name="password" class="form-control radius-30 ps-5" id="inputChoosePassword" placeholder="Entrer le mot de passe">
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked="">
                          <label class="form-check-label" for="flexSwitchCheckChecked">Souviens toi de moi </label>
                        </div>
                      </div>
                      <div class="col-6 text-end"> <a href="#">Mot de passe oublié ?</a>
                      </div>
                      <div class="col-12">
                        <div class="d-grid">
                          <button type="submit" class="btn btn-primary radius-30">S'Identifier</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

  </div>

  <script src="/assets/js/jquery.min.js"></script>
  <script src="/assets/js/pace.min.js"></script>


</body>

</html>