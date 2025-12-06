<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hotel Reservation Form</title>
    <link rel="stylesheet" href="../css/reservationform.css">
  </head>
  <body>
    <div class="container">
      <form action="../Files/register.php" method="post" class="box" id="registrationForm">
        <div class="left">
          <h3>Personal Details</h3>
          <div>
            <label>Full Name</label>
            <input
              type="text"
              id="fullname"
              name="fullname"
              placeholder="John Doe"
            />
          </div>
          <div>
            <label>Email Address</label>
            <input
              type="email"
              id="email"
              name="email"
              placeholder="example@mail.com"
            />
          </div>
          <div>
            <label>New Password</label>
            <input type="password" id="password" name="password" />
          </div>
          <div>
            <label>Confirm Password</label>
            <input type="password" id="cpassword" name="cpassword" />
          </div>
          <div>
            <label>Phone Number</label>
            <input
              type="tel"
              id="phone"
              name="phone"
              placeholder="1234567890"
            />
          </div>
          <p class="login-link">
            Already have an account? <a href="../Pages/login_page.php">Login</a>
          </p>
        </div>
        <div class="buttons">
          <button type="submit" name="submit">Submit</button>
          <button type="reset" name="reset">Reset</button>
        </div>
      </form>
    </div>

    <script src="../script/formscript.js"></script>
  </body>
</html>
