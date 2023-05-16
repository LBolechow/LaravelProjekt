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
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>Brand</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                <li class="nav-item"><a class="nav-link" href="studenci"><i class="fas fa-tachometer-alt"></i><span>Studenci</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="pytania"><i class="fas fa-tachometer-alt"></i><span>Pytania</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="testy"><i class="fas fa-tachometer-alt"></i><span>Tworzenie testów</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="wynikiStudentow"><i class="fas fa-tachometer-alt"></i><span>Wyniki studentow</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid">
                        <button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group"></div>
                        </form>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                        <div class="shadow dropdown-list dropdown-menu dropdown-menu-end" aria-labelledby="">
                            </div>
                            </li>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                        <span class="d-none d-lg-inline me-2 text-gray-600 small">{{ Auth::user()->name }}</span>
                                    </a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                        <a class="dropdown-item" href="profil">
                                            <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile
                                        </a>
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
                    <div class="container">
                        <h1>Testy</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nazwa</th>
                                    <th>Klasa</th>
                                    <th>Akcje</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tests as $test)
                                <tr>
                                    <td>{{ $test->title }}</td>
                                    <td>{{ $test->klasa }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary view-questions" data-test-id="{{ $test->id }}">Pokaż pytania</button>
                                        <button type="button" class="btn btn-primary view-users" data-test-id="{{ $test->id }}">Pokaż studentów</button>
                                        <button class="edit-btn btn btn-success" data-id="{{ $test->id }}" style="margin-left: 0px;"><i class="far fa-edit" style="font-size: 15px;"></i></button>
                               <button class="remove-btn btn btn-danger" data-id="{{ $test->id }}" style="margin-left: 0px;" type="submit"><i class="fa fa-trash" style="font-size: 15px;"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                   
                </div>
				 <!-- Modal -->
                    <div class="modal fade" id="questionsModal" tabindex="-1" aria-labelledby="questionsModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="questionsModalLabel">Pytania</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                              

                             <h2>Pytania:</h2>
                             <ul>
    @foreach ($pytania as $pytanie)
        <li>{{ $pytanie->pytanie }}</li>
    @endforeach
</ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="userModalLabel">Pytania</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                

                             <h2>Studenci:</h2>
                             <ul>
    @foreach ($users as $user)
        <li>{{ $user->name }}</li>
    @endforeach
</ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                                </div>
                            </div>
                        </div>
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
    <script>
    $('.view-questions').click(function () {
        var Testy = $(this).data('test-id');
        $.ajax({
            url: '/tests/' + Testy,
            type: 'GET',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                var test = response.test;
            var pytania = response.pytania;
            $('#questionsModal .modal-body h1').text(test.title); // Ustaw tytuł testu w modalu
            $('#questionsModal .modal-body ul').empty(); // Wyczyść listę przed dodaniem nowych pytań
            $.each(pytania, function (index, pytanie) {
                var listItem = $('<li>').text(pytanie.pytanie);
                $('#questionsModal .modal-body ul').append(listItem);
            });
            $('#questionsModal').modal('show');
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });
    });
</script>
<script>
    $('.view-users').click(function () {
        var id = $(this).data('test-id');
        $.ajax({
            url: '/testsUsers/' + id,
            type: 'GET',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                var test = response.test;
            var users = response.users;
            $('#userModal .modal-body h1').text(test.title); // Ustaw tytuł testu w modalu
            $('#userModal .modal-body ul').empty(); // Wyczyść listę przed dodaniem nowych pytań
            $.each(users, function (index, user) {
                var listItem = $('<li>').text(user.name);
                $('#userModal .modal-body ul').append(listItem);
            });
            $('#userModal').modal('show');
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.edit-btn').click(function() {
            var btn = $(this);
            var id = btn.data('id');
            var row = btn.closest('tr');
            var title = row.find('td:eq(0)').text();
            var klasa = row.find('td:eq(1)').text();

            if (btn.hasClass('btn-success')) {
                // Przycisk "Edytuj"
                btn.removeClass('btn-success').addClass('btn-primary').html('<i class="fas fa-check"></i>');
                row.find('td:eq(0)').html('<input type="text" class="form-control" value="'+title+'" />');
                row.find('td:eq(1)').html('<input type="text" class="form-control" value="'+klasa+'" />');
            } else {
                // Przycisk "Zatwierdź"
                btn.removeClass('btn-primary').addClass('btn-success').html('<i class="far fa-edit"></i>');
                var newTitle = row.find('td:eq(0) input').val();
                var newKlasa = row.find('td:eq(1) input').val();
                $.ajax({
                    url: '/tests/'+id,
                    type: 'PUT',
                    data: {
                        title: newTitle,
                        klasa: newKlasa,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        row.find('td:eq(0)').html(newTitle);
                        row.find('td:eq(1)').html(newKlasa);
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
            url: '/tests/' + id,
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