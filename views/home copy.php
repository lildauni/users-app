<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Users table</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="style/styles.css" rel="stylesheet">

    <div class="container">
        <div class="row flex-lg-nowrap">
            <div class="col">
                <div class="row flex-lg-nowrap">
                    <div class="col mb-3">
                        <? include "form.php" ?>
                        <div class="e-panel card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h6 class="mr-2"><span>Users</span></h6>
                                </div>
                                <div class="e-table">
                                    <div class="table-responsive table-lg mt-3">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="align-top">
                                                        <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0">
                                                            <input type="checkbox" class="custom-control-input" id="all-items">
                                                            <label class="custom-control-label" for="all-items"></label>
                                                        </div>
                                                    </th>
                                                    <th class="max-width">Name</th>
                                                    <th class="sortable">Role</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="align-middle">
                                                        <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                                            <input type="checkbox" class="custom-control-input" id="item-1">
                                                            <label class="custom-control-label" for="item-1"></label>
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap align-middle">Adam Cotter</td>
                                                    <td class="text-nowrap align-middle"><span>Active</span></td>
                                                    <td class="text-center align-middle"><i class="fa fa-circle active-circle"></i></td>
                                                    <td class="text-center align-middle">
                                                        <div class="btn-group align-top">
                                                            <button class="btn btn-sm btn-outline-secondary badge" type="button" data-toggle="modal" data-target="#user-form-modal">Edit</button>
                                                            <button class="btn btn-sm btn-outline-secondary badge" type="button"><i class="fa fa-trash"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="align-middle">
                                                        <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                                            <input type="checkbox" class="custom-control-input" id="item-2">
                                                            <label class="custom-control-label" for="item-2"></label>
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap align-middle">Pauline Noble</td>
                                                    <td class="text-nowrap align-middle"><span>User</span></td>
                                                    <td class="text-center align-middle"><i class="fa fa-circle active-circle"></i></td>
                                                    <td class="text-center align-middle">
                                                        <div class="btn-group align-top">
                                                            <button class="btn btn-sm btn-outline-secondary badge" type="button" data-toggle="modal" data-target="#user-form-modal">Edit</button>
                                                            <button class="btn btn-sm btn-outline-secondary badge" type="button"><i class="fa fa-trash"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="align-middle">
                                                        <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                                            <input type="checkbox" class="custom-control-input" id="item-3">
                                                            <label class="custom-control-label" for="item-3"></label>
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap align-middle">Sherilyn Metzel</td>
                                                    <td class="text-nowrap align-middle"><span>Admin</span></td>
                                                    <td class="text-center align-middle"><i class="fa fa-circle not-active-circle"></i></td>
                                                    <td class="text-center align-middle">
                                                        <div class="btn-group align-top">
                                                            <button class="btn btn-sm btn-outline-secondary badge" type="button" data-toggle="modal" data-target="#user-form-modal">Edit</button>
                                                            <button class="btn btn-sm btn-outline-secondary badge" type="button"><i class="fa fa-trash"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="align-middle">
                                                        <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                                            <input type="checkbox" class="custom-control-input" id="item-4">
                                                            <label class="custom-control-label" for="item-4"></label>
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap align-middle">Terrie Boaler</td>
                                                    <td class="text-nowrap align-middle"><span>Admin</span></td>
                                                    <td class="text-center align-middle"><i class="fa fa-circle active-circle"></i></td>
                                                    <td class="text-center align-middle">
                                                        <div class="btn-group align-top">
                                                            <button class="btn btn-sm btn-outline-secondary badge" type="button" data-toggle="modal" data-target="#user-form-modal">Edit</button>
                                                            <button class="btn btn-sm btn-outline-secondary badge" type="button"><i class="fa fa-trash"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="align-middle">
                                                        <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                                            <input type="checkbox" class="custom-control-input" id="item-5">
                                                            <label class="custom-control-label" for="item-5"></label>
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap align-middle">Rutter Pude</td>
                                                    <td class="text-nowrap align-middle"><span>User</span></td>
                                                    <td class="text-center align-middle"><i class="fa fa-circle active-circle"></i></td>
                                                    <td class="text-center align-middle">
                                                        <div class="btn-group align-top">
                                                            <button class="btn btn-sm btn-outline-secondary badge" type="button" data-toggle="modal" data-target="#user-form-modal">Edit</button>
                                                            <button class="btn btn-sm btn-outline-secondary badge" type="button"><i class="fa fa-trash"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <? include "form.php" ?>

                <? include "window.php" ?>

            </div>
        </div>
    <div id="result"></div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <div id="fetch"></div>
        </div>
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../script/main.js"></script>
</body>

</html>