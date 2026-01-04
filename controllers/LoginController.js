angular.module("myApp").controller("LoginController",
  function ($scope, $http, $window) {

    $scope.user = {};

    $scope.loginUser = function (form) {

      // Browser validation handles empty/invalid input
      if (form.$invalid) return;

      $http.post("Pages/login_action.php", $scope.user)
        .then(function (res) {

          if (res.data.status === "success") {

            $window.location.href = "index.php";

          } else {

            // 🔔 PHP error popup
            alert(res.data.message);

            // 🔄 Clear inputs
            $scope.user = {};

            // 🔄 Reset form state
            form.$setPristine();
            form.$setUntouched();
          }

        }, function () {

          alert("Server error. Please try again.");

          // clear form even on server error
          $scope.user = {};
          form.$setPristine();
          form.$setUntouched();
        });
    };
  }
);
