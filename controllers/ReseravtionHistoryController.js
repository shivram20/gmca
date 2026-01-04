app.controller("ReservationHistoryController", function ($scope, $http, $location) {

    $scope.reservations = [];
    $scope.currentPage = 1;
    $scope.totalPages = 0;

    /* ===== Load reservation history ===== */
    $scope.loadReservations = function (page = 1) {

        $http.get("Pages/reservation_history.php?page=" + page)
            .then(function (response) {

                /* PHP returns full HTML, so inject it */
                document.getElementById("reservationContent").innerHTML = response.data;

                $scope.currentPage = page;

            }, function (error) {
                console.error("Error loading reservations", error);
            });
    };

    /* ===== Initial Load ===== */
    $scope.loadReservations($scope.currentPage);

});
