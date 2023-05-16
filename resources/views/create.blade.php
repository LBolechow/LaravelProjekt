<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Nauczyciel</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/Ludens---1-Index-Table-with-Search--Sort-Filters-v20.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
        <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>Brand</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="studenci"><i class="fas fa-tachometer-alt"></i><span>Studenci</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="pytania"><i class="fas fa-tachometer-alt"></i><span>Pytania</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="tests"><i class="fas fa-tachometer-alt"></i><span>Wszystkie testy</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="wynikiStudentow"><i class="fas fa-tachometer-alt"></i><span>Wyniki studentow</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group"></div>
                        </form>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                    
                                <div class="shadow dropdown-list dropdown-menu dropdown-menu-end" aria-labelledby="alertsDropdown"></div>
                            </li>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">{{ Auth::user()->name }}</span></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="profil"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a>
                                        <div class="dropdown-divider">         
                                        </div>
                                        <a class="dropdown-item" href="{{ route('logout') }}">
    <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout
</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6">
                            <h3 class="text-dark mb-4">Testy</h3>
                        </div>
                    </div>
                    
                    <!-- Content for creating tests -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Tworzenie testu</h5>
                                    
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form action="{{ route('testy.store') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label for="title">Tytuł:</label>
                                            <input type="text" name="title" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="klasa">Klasa:</label>
                                            <input type="text" name="klasa" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                        <div class="form-group">
    <label for="users">Uczniowie:</label>
    @foreach ($users as $user)
        @if ($user->name !== 'Nauczyciel')
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="users[]" value="{{ $user->id }}">
                <label class="form-check-label" for="user{{ $user->id }}">
                    {{ $user->name }}
                </label>
            </div>
        @endif
    @endforeach
</div>

                                        <div class="form-group">
                                            <label for="pytania">Pytania:</label>
                                            @foreach ($pytania as $pytanie)
                                                <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="pytania[]" value="{{ $pytanie->id }}">
                                                    <label class="form-check-label" for="pytanie{{ $pytanie->id }}">
                                                        {{ $pytanie->pytanie }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>

                                        <button type="submit" class="btn btn-primary">Utwórz test</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of content for creating tests -->
                </div>
            </div>
        </div>
        <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/jquery.tablesorter.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-filter.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-storage.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-1.js"></script>
    <script src="assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>