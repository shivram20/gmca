angular
  .module("myApp").controller(
    "EditReservationController",
    function ($scope, $http, $routeParams, $location) {
      $scope.reservation = {};

      const today = new Date();
      $scope.minCheckin = today.toISOString().split("T")[0];
      $scope.minCheckout = $scope.minCheckin;

      $scope.updateMinCheckout = function () {
        if ($scope.reservation.checkin) {
          let d = new Date($scope.reservation.checkin);
          d.setDate(d.getDate() + 1);
          $scope.minCheckout = d.toISOString().split("T")[0];
        }
      };

      $scope.$watch("reservation.checkin", $scope.updateMinCheckout);

      if ($routeParams.id) {
        $http
          .get("Pages/get_reservation.php?id=" + $routeParams.id)
          .then(function (res) {
            $scope.reservation = {
              r_id: res.data.r_id,
              checkin: res.data.c_in_date.substring(0, 10),
              checkout: res.data.c_out_date.substring(0, 10),
              guests: parseInt(res.data.guest),
              roomtype: res.data.room_type,
              requests: res.data.special_req,
            };
          });
      }

      $scope.submitReservation = function () {
        $http
          .post("Pages/saveupdated_reservation.php", {
            r_id: $scope.reservation.r_id,
            c_in_date: $scope.reservation.checkin,
            c_out_date: $scope.reservation.checkout,
            guest: $scope.reservation.guests,
            room_type: $scope.reservation.roomtype,
            special_req: $scope.reservation.requests,
          })
          .then(function (res) {
            if (res.data.status === "success") {
              alert("Updated successfully");
            } else {
              alert(res.data.message);
            }
          });
      };
    }
  );
