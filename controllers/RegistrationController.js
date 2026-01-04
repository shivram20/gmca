angular
  .module("myApp")
  .controller("RegistrationController", function ($scope, $http, $window) {
    $scope.user = {};
    $scope.errorMsg = "";
    $scope.registerUser = function () {
      if ($scope.registerForm.$invalid) {
        return;
      }

      if ($scope.user.password !== $scope.user.cpassword) {
        $scope.errorMsg = "Passwords do not match!";
        return;
      }

      $http.post("Pages/register_action.php", $scope.user).then(function (res) {
        if (res.data.status === "success") {
          $window.location.href = "#!/login";
        } else {
          $scope.errorMsg = res.data.message;
        }
      });
    };
  });
