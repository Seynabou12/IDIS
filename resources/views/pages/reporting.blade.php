<!doctype html>
<html lang="en" class="light-theme">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link href="/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/css/bootstrap-extended.css" rel="stylesheet" />
    <link href="/assets/css/style.css" rel="stylesheet" />
    <link href="/assets/css/icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- loader-->
    <link href="/assets/css/pace.min.css" rel="stylesheet" />

    <!--Theme Styles-->
    <link href="/assets/css/dark-theme.css" rel="stylesheet" />
    <link href="/assets/css/light-theme.css" rel="stylesheet" />
    <link href="/assets/css/semi-dark.css" rel="stylesheet" />
    <link href="/assets/css/header-colors.css" rel="stylesheet" />

    <title>Cloudi-fi</title>

</head>

<body>

    <div class="wrapper">

        @include('./layouts.header')
        @include('./layouts.sidebar')

        <main class="page-content">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4">
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="mb-0 text-secondary">Max Users</h5>
                                    <h4 class="my-1">{{ count($users) }}</h4>
                                </div>
                                <div class="widget-icon-large bg-gradient-purple text-white ms-auto"><i class="bi bi-people-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="mb-0 text-secondary">Users Connect</h5>
                                    <h4 class="my-1">0</h4>
                                </div>
                                <div class="widget-icon-large bg-gradient-success text-white ms-auto"><i class="bi bi-people-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="mb-0 text-secondary">Total Networks</h5>
                                    <h4 class="my-1">{{ count($networks) }}</h4>
                                </div>
                                <div class="widget-icon-large bg-gradient-danger text-white ms-auto"><i class="bi bi-people-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="mb-0 text-secondary">Total APS</h5>
                                    <h4 class="my-1">{{ count($accespoints) }}</h4>
                                </div>
                                <div class="widget-icon-large bg-gradient-info text-white ms-auto"><i class="bi bi-bar-chart-line-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-8 col-xl-6 d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-header bg-transparent">
                            <div class="row g-3 align-items-center">
                                <div class="col">
                                    <h5 class="mb-0">Devices Users</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-lg-flex align-items-center justify-content-center gap-4">
                                <div id="chart3"></div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><i class="bi bi-circle-fill text-purple me-1"></i> Android: <span class="me-1">89</span></li>
                                    <li class="list-group-item"><i class="bi bi-circle-fill text-info me-1"></i> Windows: <span class="me-1">45</span></li>
                                    <li class="list-group-item"><i class="bi bi-circle-fill text-pink me-1"></i> Iphone: <span class="me-1">35</span></li>
                                    <li class="list-group-item"><i class="bi bi-circle-fill text-success me-1"></i> Autres: <span class="me-1">62</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xl-6 d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-header bg-transparent">
                            <div class="row g-3 align-items-center">
                                <div class="col">
                                    <h5 class="mb-0">Systemes</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="chart2"></div>
                        </div>
                        <ul class="list-group list-group-flush mb-0">
                            <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">New Orders<span class="badge bg-primary badge-pill">25%</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Completed<span class="badge bg-orange badge-pill">65%</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Pending<span class="badge bg-success badge-pill">10%</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--end row-->

            <div class="row">
                
                <div class="col-12 col-lg-6 col-xl-6 d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-body">
                            <div class="row row-cols-1 row-cols-lg-2 g-3 align-items-center">
                                <div class="col">
                                    <h5 class="mb-0">Product Actions</h5>
                                </div>
                                <div class="col">
                                    <div class="d-flex align-items-center justify-content-sm-end gap-3 cursor-pointer">
                                        <div class="font-13"><i class="bi bi-circle-fill text-primary"></i><span class="ms-2">Views</span></div>
                                        <div class="font-13"><i class="bi bi-circle-fill text-pink"></i><span class="ms-2">Clicks</span></div>
                                    </div>
                                </div>
                            </div>
                            <div id="chart4"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->


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
        <!--end switcher-->

    </div>

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
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
    <!--app-->
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/index.js"></script>

    <script>
        new PerfectScrollbar(".best-product")
        new PerfectScrollbar(".top-sellers-list")
    </script>

</body>

</html>