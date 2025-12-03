<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hotel Reservation Form</title>
    <style>
      body {
        margin: 0;
        font-family: "Poppins", sans-serif;
        background: linear-gradient(to right, #74ebd5, #acb6e5);
      }

      .container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
      }

      .box {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 30px;
        max-width: 900px;
        width: 100%;
        padding: 30px;
      }

      .left,
      .right {
        flex: 1;
        min-width: 280px;
      }

      .left h3,
      .right h3 {
        font-size: 22px;
        color: #333;
        font-weight: 600;
        margin-bottom: 15px;
        border-left: 5px solid #4caf50;
        padding-left: 10px;
      }

      .left div,
      .right div {
        margin-bottom: 15px;
        display: flex;
        flex-direction: column;
      }

      label {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 6px;
        color: #444;
      }

      input,
      select,
      textarea {
        padding: 12px 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 14px;
        background: #f9f9f9;
        transition: all 0.3s ease;
      }

      input:focus,
      select:focus,
      textarea:focus {
        border-color: #4caf50;
        background: #fff;
        box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
        outline: none;
      }

      .buttons {
        width: 100%;
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 20px;
      }

      button {
        padding: 12px 25px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
      }

      button[type="submit"] {
        background: #4caf50;
        color: #fff;
      }

      button[type="submit"]:hover {
        background: #43a047;
      }

      button[type="reset"] {
        background: #f44336;
        color: #fff;
      }

      button[type="reset"]:hover {
        background: #d32f2f;
      }

      .login-link {
        font-size: 14px;
        color: #666;
      }

      .login-link a {
        color: #4caf50;
        text-decoration: none;
      }

      .login-link a:hover {
        text-decoration: underline;
      }

      @media (max-width: 768px) {
        .box {
          flex-direction: column;
          padding: 20px;
        }

        .left,
        .right {
          width: 100%;
        }

        .buttons {
          justify-content: center;
        }
      }
    </style>
  </head>
  <body>
    <div class="container">
      <form action="./register.php" method="post" class="box" id="reservationForm">
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
            Already have an account? <a href="./login_page.php">Login</a>
          </p>
        </div>

        <div class="right">
          <h3>Reservation Details</h3>
          <div>
            <label>Check-in Date</label>
            <input type="date" id="checkin" name="checkin" />
          </div>
          <div>
            <label>Check-out Date</label>
            <input type="date" id="checkout" name="checkout" />
          </div>
          <div>
            <label>Number Of Guests</label>
            <input type="number" id="guests" name="guests" min="1" max="5" />
          </div>
          <div>
            <label>Room Type</label>
            <select id="roomtype" name="roomtype">
              <option value="">--Select--</option>
              <option value="single">Single</option>
              <option value="double">Double</option>
              <option value="suite">Suite</option>
            </select>
          </div>
          <div>
            <label>Special Requests</label>
            <textarea
              id="requests"
              name="requests"
              rows="3"
              placeholder="Any special requirements?"
            ></textarea>
          </div>
        </div>

        <div class="buttons">
          <button type="submit" name="submit">Submit</button>
          <button type="reset" name="reset">Reset</button>
        </div>
      </form>
    </div>

    <script src="./formscript.js"></script>
  </body>
</html>
