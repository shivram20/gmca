angular.module("myApp").controller("ReservationController", [
  "$scope",
  "$http",
  function ($scope, $http) {
    $scope.reservation = {};

    /* =====================
       Disable past dates
    ===================== */
    const today = new Date();
    $scope.minCheckin =
      today.getFullYear() +
      "-" +
      String(today.getMonth() + 1).padStart(2, "0") +
      "-" +
      String(today.getDate()).padStart(2, "0");

    $scope.minCheckout = $scope.minCheckin;

    /* =====================
       Update checkout date
    ===================== */
    $scope.updateMinCheckout = function () {
      if ($scope.reservation.checkin) {
        let d = new Date($scope.reservation.checkin);
        d.setDate(d.getDate() + 1);

        $scope.minCheckout =
          d.getFullYear() +
          "-" +
          String(d.getMonth() + 1).padStart(2, "0") +
          "-" +
          String(d.getDate()).padStart(2, "0");

        if (
          $scope.reservation.checkout &&
          $scope.reservation.checkout < $scope.minCheckout
        ) {
          $scope.reservation.checkout = "";
        }
      }
    };

    $scope.$watch("reservation.checkin", $scope.updateMinCheckout);

    /* =====================
       Reset Form
    ===================== */
    $scope.resetForm = function () {
      $scope.reservation = {};
      if ($scope.reservationForm) {
        $scope.reservationForm.$setPristine();
        $scope.reservationForm.$setUntouched();
      }
    };

    /* =====================
       Submit Reservation
    ===================== */
    $scope.submitReservation = function () {
      // ---- Date validation ----
      if (!$scope.reservation.checkin) {
        alert("Please select a valid Check-in date.");
        return;
      }

      if (!$scope.reservation.checkout) {
        alert("Please select a valid Check-out date.");
        return;
      }

      // ---- Guests validation ----
      if (
        !$scope.reservation.guests ||
        !Number.isInteger($scope.reservation.guests) ||
        $scope.reservation.guests < 1 ||
        $scope.reservation.guests > 5
      ) {
        alert("Invalid number of guests! Enter a number between 1 and 5.");
        return;
      }

      // ---- Room type ----
      if (!$scope.reservation.roomtype) {
        alert("Please select a room type.");
        return;
      }

      // ---- Submit to PHP ----
      $http({
        method: "POST",
        url: "Pages/save_reservation.php",
        data: $scope.reservation,
        headers: { "Content-Type": "application/json" },
      }).then(
        function (response) {
          if (response.data.status === "success") {
            alert(response.data.message);
            $scope.resetForm();
          } else {
            alert(response.data.message);
          }
        },
        function () {
          alert("Server error. Please try again.");
        }
      );
    };
  },
]);
