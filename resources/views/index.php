<!DOCTYPE html>
<html lang="en" ng-app='App'>

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="<?php echo URL::asset('bower_components/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?php echo URL::asset('bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <link rel="stylesheet" href="<?php echo URL::asset('css/style.css') ?>">
    <link rel="stylesheet" href="<?php echo URL::asset('bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo URL::asset('bower_components/components-font-awesome/css/font-awesome.min.css') ?>">
    <script src="<?php echo URL::asset('bower_components/lodash/dist/lodash.min.js') ?>"></script>
</head>

<body>
    <div class="container main">
        <div class="col-xs-12">
            <div class="col-xs-12">
                <h4>LIst User</h4>
            </div>
        </div>
        <div ng-controller="ListController" class="col-xs-12 list-user">
            <div class="col-xs-12 create-new-user">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Create">Create New User</button>
            </div>
            <div class="col-xs-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Age</th>
                            <th>Photo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="employee in employees">
                            <td>{{ employee.name }}</td>
                            <td>{{ employee.address }}</td>
                            <td>{{ employee.age }}</td>
                            <td class="avatar"><img ng-src="avatar/{{ employee.photo }}" alt=""></td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Edit" ng-click="edit(employee.id)">Edit</button>
                                <button type="button" class="btn btn-danger" ng-click="confirmDelete(employee.id)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- edit -->
            <div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit User</h4>
                        </div>
                        <div class="modal-body">
                            <form name="Edit" class="form-horizontal" novalidate="" enctype="multipart/form-data">
                                <input type="hidden" name="_token" id="csrf-token" value="<?php Session::token() ?>" ng-model="employee.token" />
                                <div class="form-group error">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="name" name="name" placeholder="{{ datauser.name }}" ng-model="employee.name" required maxlength="100">
                                    </div>
                                    <div class="col-xs-9 col-xs-offset-3">
                                        <span class="help-inline" ng-show="Edit.name.$invalid && Edit.name.$touched">Name field is required</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="address" name="address" placeholder="{{ datauser.address }}" ng-model="employee.address" required maxlength="300">
                                    </div>
                                    <div class="col-xs-9 col-xs-offset-3">
                                        <span class="help-inline" ng-show="Edit.address.$invalid && Edit.address.$touched">Address field is required</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Age</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="age" name="age" placeholder="{{ datauser.age  }}" ng-model="employee.age" required max="99" min="1">
                                    </div>
                                    <div class="col-xs-9 col-xs-offset-3">
                                        <span class="help-inline" ng-show="Edit.age.$error.max && Edit.age.$touched">Age field is max 2 characters</span>
                                        <span class="help-inline" ng-show="Edit.age.$error.number && Edit.age.$touched">Age field is number</span>
                                        <span class="help-inline" ng-show="Edit.age.$error.required && Edit.age.$touched">Age field is require</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="photo" class="col-sm-3 control-label">Photo</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*" ng-model="employee.photo" file-model="myFile">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" ng-click="save(employee,datauser.id)" ng-disabled="Edit.$invalid">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end edit -->
            <!-- create -->
            <div class="modal fade" id="Create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">Create New User</h4>
                        </div>
                        <div class="modal-body">
                            <form name="Create" class="form-horizontal" novalidate="" enctype="multipart/form-data">
                                <input type="hidden" name="_token" id="csrf-token" value="<?php Session::token() ?>" ng-model="create.token" />
                                <div class="form-group error">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="name" name="name" placeholder="Name" ng-model="create.name" required maxlength="100">
                                    </div>
                                    <div class="col-xs-9 col-xs-offset-3">
                                        <span class="help-inline" ng-show="Create.name.$invalid && Create.name.$touched">Name field is required</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address" class="col-sm-3 control-label">Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" ng-model="create.address" required maxlength="300">
                                    </div>
                                    <div class="col-xs-9 col-xs-offset-3">
                                        <span class="help-inline" ng-show="Create.address.$invalid && Create.address.$touched">Address field is required</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Age</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="age" name="age" placeholder="Age" ng-model="create.age" required max="99" min="1">
                                    </div>
                                    <div class="col-xs-9 col-xs-offset-3">
                                        <span class="help-inline" ng-show="Create.age.$error.max && Create.age.$touched">Age field is max 2 characters</span>
                                        <span class="help-inline" ng-show="Create.age.$error.number && Create.age.$touched">Age field is number</span>
                                        <span class="help-inline" ng-show="Create.age.$error.required && Create.age.$touched">Age field is require</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="photo" class="col-sm-3 control-label">Photo</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*" ng-model="create.photo" file-model="myFileCreate">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" ng-click="save(create)" ng-disabled="Create.$invalid">Create New User</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end create -->
        </div>
    </div>
    <script src="<?php echo  URL::asset('bower_components/angular/angular.min.js') ?>"></script>
    <script src="<?php echo  URL::asset('js/app.js') ?>"></script>
    <script src="<?php echo  URL::asset('js/controllers/employees.js') ?>"></script>
    <script>
    </script>
</body>

</html>
