angular.module("myApp").controller("CalculatorController", function ($scope) {

  $scope.display = "";

  $scope.num = function (val) {
    $scope.display += val;
  };

  $scope.op = function (op) {
    if ($scope.display === "") return;

    let last = $scope.display.slice(-1);
    if ("+-*/%".includes(last)) {
      $scope.display = $scope.display.slice(0, -1) + op;
    } else {
      $scope.display += op;
    }
  };

  $scope.clear = function () {
    $scope.display = "";
  };

  $scope.del = function () {
    $scope.display = $scope.display.slice(0, -1);
  };

  $scope.calc = function () {
    try {
      $scope.display = eval($scope.display).toString();
    } catch {
      $scope.display = "Error";
    }
  };

});
