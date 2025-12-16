<!DOCTYPE html>
<html lang="en" ng-app="myApp">
  <head>
    <title>Simple Web Page Using Table tag</title>
    <link rel="stylesheet" href="./css/stylehome.css" />
      <title>AngularJS SPA</title>
  </head>
  <body>
    <table width="100%" cellspacing="5" cellpadding="10">
      <tr id="top" bgcolor="orange">
        <td>
          <div class="left-logos">
            <div class="img-box">
              <img src="images/mig.jpeg" alt="Student 1" />
              <b>255690694070</b>
            </div>
            <div class="img-box">
              <img src="images/img1.jpeg" alt="Student 2" />
              <b>255690694009</b>
            </div>
            <div class="img-box">
              <img src="images\img2.jpeg" alt="Student 3" />
              <b>255690694028</b>
            </div>
          </div>
        </td>
        <td>
          <div class="center-header">
            <h1>Web Technology Project Practical</h1>
            <nav>
              <a href="./index.php">Home</a>| 
             <?php 
                session_start();

              if (isset($_SESSION['enabled']) && $_SESSION['enabled'] === true) {
                echo "<a href='./Pages/About.php'>About</a>|";
                echo "<a href='./Pages/Reservation.php'>Reservation</a>|";
                echo "<a href='./Pages/MyCalculator.php'>Calculator</a> | ";
                echo "<a href='./logout.php'>Logout</a>";
              } else {
                echo "<a href='./Pages/login_page.php'>Login</a> | ";
                echo "<a href='./Pages/Registration.php'>Register</a>";
              }
            ?>

            </nav>
          </div>
        </td>
        
        <div ng-view></div>
        <td>
          <div class="right-logo">
            <img src="./images/logo_gmca.jpg" alt="College Logo" />
          </div>
        </td>
      </tr>
      <tr id="center">
        <td width="33%">
          <span>Latest News</span>
          <ul>
            <li>
              <p>
                Government MCA College is one of the best colleges in the city.
              </p>
            </li>
            <li>
              <p>
                Total 60 student seats are available (CMAT exam is mandatory).
              </p>
            </li>
            <li><p>Last year MCA students got good job placements.</p></li>
          </ul>
        </td>

        <td width="34%">
          <span>About our Institute</span>
          <p>
            Government MCA College Maninagar, Ahmedabad is the first Government
            MCA College in Gujarat. It was established in June 2012 with
            facilities to run Master of Computer Application.
          </p>
          <p>
            The vision of the college is to provide value-based quality
            education to enable students to achieve their potential.
          </p>
          <p>
            Government MCA College, K. K. Shastri Education Campus, Maninagar
            (East), Ahmedabad - 380008, INDIA
          </p>
        </td>    
        <td width="33%">
          <span>Important Links</span><br /><br />
          <a href="https://gmca.ac.in/mandatory?sub=AICTE">AICTE</a><br />
          <a href="https://acpc.gujarat.gov.in/">ACPC</a><br />
          <a href="https://cmat.nta.nic.in/">CMAT</a><br /><br />
        </td>
      </tr>

      <tr id="bottom" bgcolor="orange">
        <td colspan="3" align="center">
          <p><strong>Government MCA College, Maninagar</strong></p>
          <p>
            K. K. Shastri Educational Campus, Maninagar (East), Ahmedabad -
            380008, Gujarat, India
          </p>
          <p>
            Email:
            <a href="mailto:gmcacollege@gmail.com">gmcacollege@gmail.com</a>
          </p>
          <p>Phone: +91-79-2543-1234</p>
          <hr width="60%" />
          <p>
            &copy; 2025 Government MCA College | Designed for Web Technology
            Project Practical
          </p>
        </td>
      </tr>
    </table>
  </body>
</html>
