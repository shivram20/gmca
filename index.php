<!DOCTYPE html>
<html lang="en" ng-app="myApp">

<head>
  <meta charset="UTF-8">
  <title>AngularJS SPA</title>
  <link rel="stylesheet" href="./css/stylehome.css" />

  <!-- AngularJS -->
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular-route.min.js"></script>

  <!-- App JS -->
  <script src="app.js"></script>
  <script src="./controllers/LoginController.js"></script>
  <script src="./controllers/ReservationController.js"></script>
  <script src="./controllers/ReservationHistoryController.js"></script>
  <script src="./controllers/EditReservationController.js"> </script>
  <script src="./controllers/CalculatorController.js"></script>
</head>

<body ng-controller="MainController">
  <table id="maintable" width="100%" cellspacing="5" cellpadding="10">
    <tr id="top" bgcolor="orange">
      <td>
        <div class="left-logos">

          <div class="img-box"
            ng-class="{disabled: loggedInUser === 'shivram@gmail.com'}"
            ng-click="imageLogin('shivram@gmail.com')">
            <img src="images/mig.jpeg">
            <b>255690694070</b>
          </div>

          <div class="img-box"
            ng-class="{disabled: loggedInUser === 'deven@gmail.com'}"
            ng-click="imageLogin('deven@gmail.com')">
            <img src="images/img1.jpeg">
            <b>255690694009</b>
          </div>

          <div class="img-box"
            ng-class="{disabled: loggedInUser === 'aryan@gmail.com'}"
            ng-click="imageLogin('aryan@gmail.com')">
            <img src="images/img2.jpeg">
            <b>255690694028</b>
          </div>
        </div>
      </td>
      <td>
        <div class="center-header">
          <h1>Web Technology Project Practical</h1>
          <p class="welcome" ng-if="loggedInUser === 'aryan@gmail.com'">Welcome : {{loggedInUser}}</p>
          <p class="welcome" ng-if="loggedInUser === 'shivram@gmail.com'">Welcome : {{loggedInUser}}</p>
          <p class="welcome" ng-if="loggedInUser === 'deven@gmail.com'">Welcome : {{loggedInUser}}</p>
          <!-- SAME controller as image login -->
          <nav ng-controller="MainController">

            <!-- When NOT logged in -->
            <span ng-if="!loggedInUser">
              <a href="#!/">Home</a> |
              <a href="#!/login">Login</a> |
              <a href="#!/register">Register</a>
            </span>

            <!-- When logged in -->
            <span ng-if="loggedInUser">
              <a href="#!/">Home</a> |
              <a href="#!/about">About</a> |
              <a href="#!/Reservation">Reservation</a> |
              <a href="#!/reservation_all">My_Reservations</a> |
              <a href="#!/MyCalculator">Calculator</a> |
              <a href="" ng-click="logout()">Logout</a>
            </span>
          </nav>
        </div>
      </td>
      <td>
        <div class="right-logo">
          <img src="./images/logo_gmca.jpg" alt="College Logo" />
        </div>
      </td>
    </tr>

    <!-- Angular View -->
    <tr>
      <td colspan="3">
        <div ng-view></div>
      </td>
    </tr>

    <tr id="bottom" bgcolor="orange">
      <td colspan="3">
        <p><strong>Government MCA College, Maninagar</strong></p>
        <p>K. K. Shastri Educational Campus, Maninagar (East), Ahmedabad - 380008</p>
        <p>Email: <a href="mailto:gmcacollege@gmail.com">gmcacollege@gmail.com</a></p>
      </td>
    </tr>

  </table>
</body>

</html>