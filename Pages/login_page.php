<style>
  /* Center the login form */
  div[ng-controller="LoginController"] {
    min-height: 55vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #e8f5e9, #f1f8e9);
  }

  /* Form container */
  div[ng-controller="LoginController"] form {
    background: #ffffff;
    width: 100%;
    max-width: 380px;
    padding: 35px;
    padding-right: 50px;
    border-radius: 12px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
  }

  /* Heading */
  div[ng-controller="LoginController"] h3 {
    margin-bottom: 20px;
    color: #2e7d32;
    font-size: 26px;
    border-left: 5px solid #4caf50;
    padding-left: 10px;
  }

  /* Inputs */
  div[ng-controller="LoginController"] input[type="email"],
  div[ng-controller="LoginController"] input[type="password"] {
    width: 100%;
    padding: 12px 14px;
    margin: 10px 0;
    font-size: 15px;
    border: 1px solid #ccc;
    border-radius: 6px;
    background: #fafafa;
    transition: 0.3s;
  }

  div[ng-controller="LoginController"] input:focus {
    border-color: #4caf50;
    background: #fff;
    box-shadow: 0 0 8px rgba(76, 175, 80, 0.3);
    outline: none;
  }

  /* Submit button */
  div[ng-controller="LoginController"] input[type="submit"] {
    width: 100%;
    padding: 12px;
    margin-top: 15px;
    background: #4caf50;
    color: #fff;
    font-size: 17px;
    font-weight: bold;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
  }

  div[ng-controller="LoginController"] input[type="submit"]:hover {
    background: #388e3c;
  }

  /* Disabled button */
  div[ng-controller="LoginController"] input[type="submit"]:disabled {
    background: #9e9e9e;
    cursor: not-allowed;
  }

  /* Register text */
  div[ng-controller="LoginController"] p {
    margin-top: 15px;
    font-size: 14px;
    text-align: center;
  }

  div[ng-controller="LoginController"] p a {
    color: #4caf50;
    text-decoration: none;
    font-weight: 600;
  }

  div[ng-controller="LoginController"] p a:hover {
    text-decoration: underline;
  }

  /* Error message */
  div[ng-controller="LoginController"] p[ng-if] {
    margin-top: 15px;
    color: red;
    text-align: center;
    font-weight: 500;
  }

  /* Mobile responsive */
  @media (max-width: 480px) {
    div[ng-controller="LoginController"] form {
      padding: 25px 20px;
    }
  }
</style>
<div ng-controller="LoginController">

  <form name="loginForm"
        ng-submit="loginUser(loginForm)">

    <h3>Login Form</h3>

    <input type="email"
           name="email"
           placeholder="Email"
           ng-model="user.email"
           required>

    <input type="password"
           name="password"
           placeholder="Password"
           ng-model="user.password"
           required>

    <p>
      Don't have an account ?
      <a href="#!/register">Register</a>
    </p>

    <input type="submit" value="Login">

  </form>
</div>
