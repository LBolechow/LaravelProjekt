<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Brand</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
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
                    <li class="nav-item"><a class="nav-link" href="pytania"><i class="fas fa-tachometer-alt"></i><span>Pytania</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="testy"><i class="fas fa-tachometer-alt"></i><span>Tworzenie testów</span></a></li>
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
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
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
                            <h3 class="text-dark mb-4">Studenci</h3>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 text-end" style="margin-bottom: 30px;"><a class="btn btn-primary" role="button" data-bs-target="#modal-1" data-bs-toggle="modal"><i class="fa fa-plus"></i>&nbsp;Dodaj studenta</a></div>
                        <div class="modal fade" role="dialog" tabindex="-1" id="modal-1">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Dodaj studenta</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form method="POST" action="{{ route('home.addUser') }}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="text">Nazwa:</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="class">Klasa:</label>
                                    <input type="text" class="form-control" id="class" name="class" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Hasło:</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                           
                            </div>
                            <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button> <button type="submit" class="btn btn-primary">Dodaj</button>
                            </form>
                        </div>
                    </div>
                </div>

                    </div>
                   </div>
                    <div class="card" id="TableSorterCard">
                        <div class="card-header py-3"></div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table tablesorter" id="ipi-table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center">Imie</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Klasa</th>
                                                <th class="text-center filter-false sorter-false">Akcje</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td contenteditable="true">{{ $user->name }}</td>
                                <td contenteditable="true">{{ $user->email }}</td>
                                <td>{{ $user->class }}</td>
                               <td class="text-center align-middle"  style="max-height: 60px;height: 60px;">
                               <button class="edit-btn btn btn-success" data-id="{{ $user->id }}" style="margin-left: 0px;"><i class="far fa-edit" style="font-size: 15px;"></i></button>
                               <button class="remove-btn btn btn-danger" data-id="{{ $user->id }}" style="margin-left: 0px;" type="submit"><i class="fa fa-trash" style="font-size: 15px;"></i></button>
            </td>
                            </tr>
                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
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
    <script>
    $(document).ready(function() {
        $('.edit-btn').click(function() {
            var btn = $(this);
            var id = btn.data('id');
            var row = btn.closest('tr');
            var name = row.find('td:eq(1)').text();
            var email = row.find('td:eq(2)').text();
            var klasa = row.find('td:eq(3)').text();

            if (btn.hasClass('btn-success')) {
                // Przycisk "Edytuj"
                btn.removeClass('btn-success').addClass('btn-primary').html('<i class="fas fa-check"></i>');
                row.find('td:eq(1)').html('<input type="text" class="form-control" value="'+name+'" />');
                row.find('td:eq(2)').html('<input type="text" class="form-control" value="'+email+'" />');
                row.find('td:eq(3)').html('<input type="text" class="form-control" value="'+klasa+'" />');
            } else {
                // Przycisk "Zatwierdź"
                btn.removeClass('btn-primary').addClass('btn-success').html('<i class="far fa-edit"></i>');
                var newName = row.find('td:eq(1) input').val();
                var newEmail = row.find('td:eq(2) input').val();
                var newClass = row.find('td:eq(3) input').val();
                $.ajax({
                    url: '/studenci/'+id,
                    type: 'PUT',
                    data: {
                        name: newName,
                        email: newEmail,
                        class: newClass,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        row.find('td:eq(1)').html(newName);
                        row.find('td:eq(2)').html(newEmail);
                        row.find('td:eq(3)').html(newClass);
                    },
                    error: function() {
                        alert('Wystąpił błąd przy zapisywaniu zmian.');
                    }
                });
            }
        });
    });
</script>
    <script>
   $(document).ready(function() {
    $('.remove-btn').click(function () {
        var btn = $(this);
        var id = btn.data('id');
        $.ajax({
            url: '/studenci/' + id,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function () {
                location.reload(); 
            },
            error: function () {
                alert('Wystąpił błąd przy zapisywaniu zmian.');
            }
        });
    });
});
</script>
</body>

</html>