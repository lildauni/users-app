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
                        <div class="form mb-3">
                            <button type="button" class="btn btn-primary" id="add" data-toggle="modal" data-target="#user-form-modal">Add</button>
                            <select class="form-select option-select-1" aria-label="Пример выбора по умолчанию">
                                <option selected>Please select</option>
                                <option value="activeUsers">Set active</option>
                                <option value="unactiveUsers">Set not active</option>
                                <option value="deleteUsers">Delete</option>
                            </select>
                            <button type="button" class="btn btn-primary checkbox-action-1">Ok</button>
                        </div>
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
                                                            <input type="checkbox" class="custom-control-input main-checkbox" id="all-items">
                                                            <label class="custom-control-label" for="all-items"></label>
                                                        </div>
                                                    </th>
                                                    <th class="max-width">Name</th>
                                                    <th class="sortable">Role</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form">
                    <button type="button" class="btn btn-primary" id="add" data-toggle="modal" data-target="#user-form-modal">Add</button>
                    <select class="form-select option-select-2" aria-label="Пример выбора по умолчанию">
                        <option selected>Please select</option>
                        <option value="activeUsers">Set active</option>
                        <option value="unactiveUsers">Set not active</option>
                        <option value="deleteUsers">Delete</option>
                    </select>
                    <button type="button" class="btn btn-primary checkbox-action-2">Ok</button>
                </div>

                <? include "window.php" ?>
                <? include "message-window.php" ?>
                <? include "confirm-window.php" ?>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="result"></div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../script/main.js"></script>
</body>

</html>