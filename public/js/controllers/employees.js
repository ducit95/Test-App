app.controller('ListController', function($scope, $http, API_URL) {
    $http.get(API_URL + "getdata")
        .success(function(response) {
            $scope.employees = response;
        });
    $scope.edit = function(id) {
        // console.log(id);
        $http.get(API_URL + "getdatauser/" + id)
            .success(function(response) {
                $scope.datauser = response;
            });
    }
    $scope.save = function(employee, id) {
        if (id != null) {
            var url = API_URL + "update/" + id;
            var file = $scope.myFile;
            if (file.size > 10000000) {
                alert('file max size 10MB');
                return false;
            }
            var namefile = file.name;
            switch (namefile.substring(namefile.lastIndexOf('.') + 1).toLowerCase()) {
                case 'gif':
                case 'jpg':
                case 'png':
                    break;
                default:
                    alert("Please chose fomat .gif or .jpg or .png");
                    return false;
                    break;
            }
            var fd = new FormData();
            if (file !== undefined) {
                fd.append('photo', file);
            }
            fd.append('name', employee.name);
            fd.append('address', employee.address);
            fd.append('age', employee.age);
            $http({
                method: 'POST',
                url: url,
                data: fd,
                headers: { 'Content-Type': undefined }
            }).success(function(response) {
                alert('Edit Complete');
                location.reload();
            }).error(function(response) {
                alert('This is embarassing. An error has occured. Please check the log for details');
            });
        } else {
            var url = API_URL + "create";
            var file = $scope.myFileCreate;
            var fd = new FormData();
            if (file !== undefined) {
                fd.append('photo', file);
            }
            fd.append('name', employee.name);
            fd.append('address', employee.address);
            fd.append('age', employee.age);
            $http({
                method: 'POST',
                url: url,
                data: fd,
                headers: { 'Content-Type': undefined }
            }).success(function(response) {
                alert('Create New User Complete');
                location.reload();
            }).error(function(response) {
                alert('This is embarassing. An error has occured. Please check the log for details');
            });
        }
    }
    $scope.confirmDelete = function(id) {
        var isConfirmDelete = confirm('Are you sure you want this record?');
        if (isConfirmDelete) {

            $http({
                method: 'GET',
                url: API_URL + 'detele/' + id
            }).
            success(function(data) {
                alert('Detele complete');
                location.reload();
            }).
            error(function(data) {
                alert('Unable to delete');
            });
        } else {
            return false;
        }
    }
});
