<style>
    /* Center the registration form */
    div[ng-controller="RegisterController"] {
        min-height: 80vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #e3f2fd, #f0f4c3);
        padding: 20px;
        box-sizing: border-box;
    }

    /* Form container */
    div[ng-controller="RegisterController"] form {
        background: #ffffff;
        width: 100%;
        max-width: 660px;
        padding: 35px;
        padding-right: 50px;
        border-radius: 12px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        margin: 0 auto;
        box-sizing: border-box;
    }

    /* Heading */
    div[ng-controller="RegisterController"] h3 {
        margin-bottom: 20px;
        color: #2e7d32;
        font-size: 26px;
        border-left: 5px solid #4caf50;
        padding-left: 10px;
    }

    /* Labels and Inputs */
    div[ng-controller="RegisterController"] label {
        display: block;
        margin-top: 10px;
        font-weight: 500;
    }

    div[ng-controller="RegisterController"] input[type="text"],
    div[ng-controller="RegisterController"] input[type="email"],
    div[ng-controller="RegisterController"] input[type="password"],
    div[ng-controller="RegisterController"] input[type="number"] {
        width: 100%;
        padding: 12px 14px;
        margin-top: 5px;
        font-size: 15px;
        border: 1px solid #ccc;
        border-radius: 6px;
        background: #fafafa;
        transition: all 0.3s ease;
    }

    div[ng-controller="RegisterController"] input:focus {
        border-color: #4caf50;
        background: #fff;
        box-shadow: 0 0 8px rgba(76, 175, 80, 0.3);
        outline: none;
    }

    /* Buttons */
    div[ng-controller="RegisterController"] .buttons {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
    }

    div[ng-controller="RegisterController"] button {
        width: 48%;
        padding: 12px 20px;
        font-size: 16px;
        font-weight: bold;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: 0.3s;
    }

    div[ng-controller="RegisterController"] button[type="submit"] {
        background-color: #4caf50;
        color: #fff;
    }

    div[ng-controller="RegisterController"] button[type="submit"]:hover {
        background-color: #388e3c;
    }

    div[ng-controller="RegisterController"] button[type="reset"] {
        background-color: #9e9e9e;
        color: #fff;
    }

    div[ng-controller="RegisterController"] button[type="reset"]:hover {
        background-color: #616161;
    }

    /* Login link */
    div[ng-controller="RegisterController"] .login-link {
        text-align: center;
        margin-top: 15px;
        font-size: 14px;
    }

    div[ng-controller="RegisterController"] .login-link a {
        color: #4caf50;
        text-decoration: none;
        font-weight: 600;
    }

    div[ng-controller="RegisterController"] .login-link a:hover {
        text-decoration: underline;
    }

    /* Error messages */
    div[ng-controller="RegisterController"] p.error-msg {
        margin-top: 15px;
        color: red;
        text-align: center;
        font-weight: 500;
    }

    /* Mobile responsive */
    @media (max-width: 480px) {
        div[ng-controller="RegisterController"] form {
            padding: 25px 20px;
        }
    }

    .error {
        color: red;
        font-size: 13px;
    }
</style>

<div ng-controller="RegisterController">
    <form name="registerForm"
        ng-submit="registerUser(registerForm)" novalidate>

        <h3>Registration</h3>

        <label>Full Name</label>
        <input type="text"
            name="fullname"
            ng-model="user.fullname"
            placeholder="Enter full name">

        <label>Email</label>
        <input type="email"
            name="email"
            ng-model="user.email"
            placeholder="Enter email">

        <label>Password</label>
        <input type="password"
            name="password"
            ng-model="user.password"
            placeholder="Enter password">

        <label>Confirm Password</label>
        <input type="password"
            name="cpassword"
            ng-model="user.cpassword"
            placeholder="Confirm password">

        <label>Phone</label>
        <input type="number"
            name="phone"
            ng-model="user.phone"
            min-lenght="10"
            max-lenght="10"
            placeholder="Enter phone number">

        <div class="buttons">
            <button type="submit">Register</button>
            <button type="reset">Reset</button>
        </div>
        <p class="login-link">
            Already have an account? <a href="#!/login">Login</a>
        </p>
    </form>
</div>