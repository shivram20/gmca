var app = angular.module("myApp", ["ngRoute"]);

function authResolve($q, $http, $location, $rootScope) {
  var defer = $q.defer();

  $http.get("Pages/check_session.php").then(function (res) {
    if (res.data.loggedIn) {
      $rootScope.loggedInUser = res.data.user_email;
      defer.resolve();
    } else {
      defer.reject();
      $location.path("/login");
    }
  });

  return defer.promise;
}

app.config(function ($routeProvider) {
  $routeProvider
    .when("/", { templateUrl: "Pages/home.html" })

    .when("/login", {
      templateUrl: "Pages/login_page.php",
      controller: "LoginController",
    })

    .when("/register", {
      templateUrl: "Pages/Registration.php"
    })

    .when("/about", {
      templateUrl: "Pages/About.php",
      resolve: { auth: authResolve },
    })

    .when("/Reservation", {
      templateUrl: "Pages/Reservation.php",
      controller: "ReservationController",
      resolve: { auth: authResolve },
    })

    .when("/reservation_all", {
      templateUrl: "Pages/reservation_all.php",
      controller: "ReservationHistoryController",
      resolve: { auth: authResolve },
    })

    .when("/editreservation/:id", {
      templateUrl: "Pages/edit_reservation.php",
      controller: "EditReservationController",
      resolve: { auth: authResolve },
    })

    .when("/MyCalculator", {
      templateUrl: "Pages/MyCalculator.html",
      controller: "CalculatorController",
      resolve: { auth: authResolve },
    })

    .otherwise({ redirectTo: "/" });
});

app.controller(
  "MainController",
  function ($scope, $rootScope, $http, $location) {
    // Restore session on refresh
    $http.get("Pages/check_session.php").then(function (res) {
      if (res.data.loggedIn) {
        $rootScope.loggedInUser = res.data.user_email;
        $scope.loggedInUser = res.data.user_email;
      }
    });

    $scope.$watch(
      () => $rootScope.loggedInUser,
      (val) => ($scope.loggedInUser = val)
    );

    /* IMAGE LOGIN */
    $scope.imageLogin = function (user_email) {
      $http.post("Pages/image_login.php", { user_email }).then(function (res) {
        if (res.data.status === "success") {
          $rootScope.loggedInUser = user_email;
          $location.path("/");
        } else {
          alert(res.data.message);
        }
      });
    };

    /* LOGOUT */
    $scope.logout = function () {
      $http.get("Pages/logout.php").then(function () {
        $rootScope.loggedInUser = null;
        $location.path("/login");
      });
    };
  }
);

// Registration
app.controller("RegisterController", function ($scope, $http, $window) {

  $scope.registerUser = function () {

    $http({
      method: "POST",
      url: "Pages/register_action.php",
      data: angular.toJson($scope.user),
      headers: {
        "Content-Type": "application/json"
      }
    }).then(function (res) {

      if (res.data.status === "success") {
        alert("Registration successful!");
        $window.location.href = "#!/login";
      } else {
        alert("❌ " + res.data.message);
      }

    }, function () {
      alert("All fields are required.");
    });

  };

});
  

// app.controller("RegisterController", function ($scope, $http, $window) {
//   $scope.registerUser = function (form) {
//     $http({
//       method: "POST",
//       url: "Pages/register_action.php",
//       data: angular.toJson($scope.user),
//       headers: {
//         "Content-Type": "application/json"
//       }
//     }).then(function (res) {

//       if (res.data.status === "success") {
//         $window.location.href = "#!/login";
//       } else {
//         $scope.errorMsg = res.data.message;
//       }

//     }, function () {
//       $scope.errorMsg = "Server error";
//     });
//   };

// });
