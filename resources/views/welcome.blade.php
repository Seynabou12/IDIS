<!doctype html>
<html lang="en" class="light-theme">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/assets/images/favicon-32x32.png" type="image/png" />
    <link href="/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link href="/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
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

    <title>IDIS</title>
</head>

<body>

    <div class="wrapper">

        @include('./layouts.header')
        @include('./layouts.sidebar')

        <main class="page-content">

            <div class="card">
                <div class="card-header py-3">
                    <div class="row g-3 align-items-center">
                        <div class="col-12 col-lg-4 col-md-6 me-auto">
                            <h5 class="mb-1"><strong>Nom de L'Entreprise: &nbsp</strong>{{ $customer->company_name }}</h5>
                            <p class="mb-0">Num??ro Entreprise : #{{ $customer->id }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-xl-2 row-cols-xxl-3">
                        <div class="col">
                            <div class="card border shadow-none radius-10">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="icon-box bg-light-primary border-0">
                                            <i class="bi bi-building text-primary"></i>
                                        </div>
                                        <div class="info">
                                            <p class="mb-1"><strong>Email:</strong> {{ $customer->username }}</p>
                                            <p class="mb-1"><strong>T??l??phone:</strong> {{ $customer->phone }}</p>
                                            <p class="mb-1"><strong>Creer par:</strong> {{ $customer->creationby }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card border shadow-none radius-10">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="icon-box bg-light-success border-0">
                                            <i class="bi bi-plus-circle text-success"></i>
                                        </div>
                                        <div class="info">
                                            <p class="mb-1"><strong>Nombre Sessions</strong> : {{ $customer->total_users }}</p>
                                            <p class="mb-1"><strong>Nombre Visiteur</strong> : {{ count($list) }}</p>
                                            <p class="mb-1"><strong>Nombre APS</strong> : {{ $customer->total_aps }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card border shadow-none radius-10">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="icon-box bg-light-danger border-0">
                                            <i class="bi bi-calendar-date text-danger"></i>
                                        </div>
                                        <div class="info">
                                            <p class="mb-1"><strong>Date de Creation</strong> : {{ $customer->creationdate }}</p>
                                            <p class="mb-1"><strong>Expiration</strong> : {{ $customer->plan_expiration }} </p>
                                            <p class="mb-1"><strong>Region</strong> : {{ $customer->region }} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex">

                <div class="col-12 col-lg-8 col-xl-8 d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-body">
                            <div class="row row-cols-1 row-cols-lg-2 g-3 align-items-center">
                                <div class="col">
                                    <h5 class="mb-0">Evolution des 12 premiers mois</h5>
                                </div>
                                <div class="col">
                                    <div class="d-flex align-items-center justify-content-sm-end gap-3 cursor-pointer">
                                        <div class="font-13" id="visiteur"><i class="bi bi-circle-fill text-primary"></i><span class="ms-2">Visiteurs</span></div>
                                        <div class="font-13"><i class="bi bi-circle-fill text-success"></i><span class="ms-2">Sessions</span></div>
                                    </div>
                                </div>
                            </div>
                            <div id="chart1"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xl-4 d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-header bg-transparent">
                            <div class="row g-3 align-items-center">
                                <div class="col">
                                    <h5 class="mb-0">Statistiques</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-lg-flex align-items-center justify-content-center gap-4">
                                <div id="chart3"></div>
                                <ul class="list-group list-group-flush" style="margin-right: 10px;">
                                    <li class="list-group-item"><i class="bi bi-circle-fill text-pink me-1"></i> Visiteurs: <span class="me-1">{{count($list)}}</span></li>
                                    <li class="list-group-item"><i class="bi bi-circle-fill text-info me-1"></i> Sessions: <span class="me-1">{{ $customer->total_users }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row d-flex">
            
                <div class="col-12 col-lg-6 col-xl-6 d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-body">
                            <div class="row row-cols-1 row-cols-lg-2 g-3 align-items-center">
                                <div class="col">
                                    <h5 class="mb-0">Barre d'??volution</h5>
                                </div>
                                <div class="col">
                                    <div class="d-flex align-items-center justify-content-sm-end gap-3 cursor-pointer">
                                        <div class="font-13"><i class="bi bi-circle-fill text-primary"></i><span class="ms-2">Sessions</span></div>
                                        <div class="font-13"><i class="bi bi-circle-fill text-pink"></i><span class="ms-2">Visiteurs</span></div>
                                    </div>
                                </div>
                            </div>
                            <div id="chart4"></div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6 col-xl-6 d-flex">

                    <div class="card radius-10 w-100">
                        <div class="card-header bg-transparent">
                            <div class="row g-3 align-items-center">
                                <div class="col">
                                    <h5 class="mb-0">Table des Mati??res </h5>
                                </div>
                                <div class="card-body">
                                    <table class="table mb-0">
                                        <thead class="table-dark">

                                            <tr>
                                                <th scope="col">Authentication</th>
                                                <th scope="col">Nombre</th>
                                            </tr>

                                        </thead>
                                        <tbody>

                                            <tr>
                                                <th scope="row">Sessions</th>
                                                <td>{{ $customer->total_users }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Visiteurs</th>
                                                <td>{{ count($list) }}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>

        <div class="overlay nav-toggle-icon"></div>
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <div class="switcher-body">
            <button class="btn btn-primary btn-switcher shadow-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="bi bi-paint-bucket me-0"></i></button>
            <div class="offcanvas offcanvas-end shadow border-start-0 p-2" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling">
                <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Theme Customizer</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <h6 class="mb-0">Theme Variation</h6>
                    <hr>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="LightTheme" value="option1" checked>
                        <label class="form-check-label" for="LightTheme">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="DarkTheme" value="option2">
                        <label class="form-check-label" for="DarkTheme">Dark</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="SemiDarkTheme" value="option3">
                        <label class="form-check-label" for="SemiDarkTheme">Semi Dark</label>
                    </div>
                    <hr>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="MinimalTheme" value="option3">
                        <label class="form-check-label" for="MinimalTheme">Minimal Theme</label>
                    </div>
                    <hr />
                    <h6 class="mb-0">Header Colors</h6>
                    <hr />
                    <div class="header-colors-indigators">
                        <div class="row row-cols-auto g-3">
                            <div class="col">
                                <div class="indigator headercolor1" id="headercolor1"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor2" id="headercolor2"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor3" id="headercolor3"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor4" id="headercolor4"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor5" id="headercolor5"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor6" id="headercolor6"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor7" id="headercolor7"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor8" id="headercolor8"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="/assets/plugins/easyPieChart/jquery.easypiechart.js"></script>
    <script src="/assets/plugins/peity/jquery.peity.min.js"></script>
    <script src="/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="/assets/js/pace.min.js"></script>
    <script src="/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="/assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
    <script src="/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>


    <script>
            var tab = @json($tab);
            var tab1 = @json($tab1);
    </script>

    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/index.js"></script>

    <script>
        new PerfectScrollbar(".best-product")
        new PerfectScrollbar(".top-sellers-list")
    </script>


</body>

</html>