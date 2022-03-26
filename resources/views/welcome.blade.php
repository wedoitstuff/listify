<?php
use App\Models\Listify;
$list=Listify::all();
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Todo List</title>

        <link rel="stylesheet" href="assets/style.css">
        <link rel="stylesheet" href="assets/custom.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
    <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-primary" id="sidebar-wrapper">
                <div class="sidebar-heading bg-primary todo_title text-center text-white border-0">Listify</div>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action list-group-item-light text-white bg-primary p-3 border-0" href="#!">Dashboard</a>
                    <a class="list-group-item list-group-item-action list-group-item-light text-white bg-primary p-3 border-0" href="#!">Shortcuts</a>
                    <a class="list-group-item list-group-item-action list-group-item-light text-white bg-primary p-3 border-0" href="#!">Overview</a>
                    <a class="list-group-item list-group-item-action list-group-item-light text-white bg-primary p-3 border-0" href="#!">Events</a>
                    <a class="list-group-item list-group-item-action list-group-item-light text-white bg-primary p-3 border-0" href="#!">Profile</a>
                    <a class="list-group-item list-group-item-action list-group-item-light text-white bg-primary p-3 border-0" href="#!">Status</a>
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                
                <!-- Page content-->
                <div class="container">
                    <div class = 'row mt-4'>
                        <div class = 'col'>
                            <h1 class="">Your List Entries</h1>
                        </div>
                        <div class = 'col text-end'>
                            <button type="button" class="btn btn-primary btn-pill" data-bs-toggle="modal" data-bs-target="#newListItem">
                                New List Item
                            </button>
                              
                        </div>
                    </div>
                    <div class = 'py-3'>
                        <hr>
                    </div>
                    <div class = "mt-2">
                        <div class = "col">
                            <?php
                            if(count($list) < 1){
                                echo "<h1 class = 'text-black-50 display-6 text-center' style = 'margin: 0 auto;'>No List Entries, why not add some tasks...</h1>";
                            }
                            foreach($list as $x){ ?>

                            <div class="card rounded-0 border-0 shadow-sm mt-3">
                                <div class="card-body">
                                  <div class = "row">
                                    <div class = "col-2"><strong><?= $x->date ?></strong></div>
                                    <div class = "col"><?= $x->todo ?></div>
                                    <div class = "col-1 text-end"><a href = "#!" data-bs-toggle="modal" data-bs-target="#editListItem<?= $x->id ?>"><i class = "fa fa-pencil text-info"></i></a> &nbsp; <a href = "/deleteEntry/<?= $x->id ?>"><i class = "fa fa-times text-danger"></i></a></div>
                                  </div>
                                </div>
                              </div>

                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    

    <!-- Modal -->
    <div class="modal fade radius-0" id="newListItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="exampleModalLabel">New List Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body border-0">
                <div class = 'row'>
                    <form action = "/newEntry" method = "POST">
                        {{ csrf_field() }}
                        <div class="form-floating mb-3">
                            <input class="form-control" id="date" type="date" placeholder="Date" name = "date" required />
                            <label for="date">Date</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="iNeedTo" type="text" placeholder="I need to..." style="height: 10rem;" name = "entry" required></textarea>
                            <label for="iNeedTo">I need to...</label>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg" id="submitButton" type="submit">Add List Item</button>
                        </div>
                    </form>
                
                </div>
            </div>
        </div>
        </div>
    </div>

    <?php foreach($list as $x){ ?>
        <div class="modal fade radius-0" id="editListItem<?= $x->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="exampleModalLabel">Edit List Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body border-0">
                    <div class = 'row'>
                        <form action = "/editEntry/<?= $x->id ?>" method = "POST">
                            {{ csrf_field() }}
                            <div class="form-floating mb-3">
                                <input class="form-control" id="date" type="date" placeholder="Date" name = "date" required value = "<?= $x->date ?>" />
                                <label for="date">Date</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="iNeedTo" type="text" placeholder="I need to..." style="height: 10rem;" name = "entry" required><?= $x->todo ?></textarea>
                                <label for="iNeedTo">I need to...</label>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary btn-lg" id="submitButton" type="submit">Edit List Item</button>
                            </div>
                        </form>
                    
                    </div>
                </div>
            </div>
            </div>
        </div>
    <?php } ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        window.addEventListener('DOMContentLoaded', event => {

        // Toggle the side navigation
        const sidebarToggle = document.body.querySelector('#sidebarToggle');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', event => {
                event.preventDefault();
                document.body.classList.toggle('sb-sidenav-toggled');
                localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
            });
        }

        });
    </script>
    </body>
</html>
