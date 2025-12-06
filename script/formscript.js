document
  .getElementById("registrationForm")
  .addEventListener("submit", function (e) {
    let name = document.getElementById("fullname").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();
    let cpassword = document.getElementById("cpassword").value.trim();
    let phone = document.getElementById("phone").value.trim();

    if (name === "") {
      alert("Please enter your full name.");
      e.preventDefault();
    }else if (!email.includes("@")) {
      alert("Please enter a valid email address wiht (@).");
      e.preventDefault();
    } else if (!email.includes(".")) {
      alert("Please enter a valid email address wiht (.).");
      e.preventDefault();
    } else if (password === "") {
      alert("Please enter a password.");
      e.preventDefault();
    } else if (cpassword === "") {
      alert("Please confirm your password.");
      e.preventDefault();
    } else if (password !== cpassword) {
      alert("Passwords do not match.");
      e.preventDefault();
    } else if (phone === "") {
      alert("Please enter a phone number.");
      e.preventDefault();
    } else if (phone.length !== 10) {
      alert("Please enter a valid 10-digit phone number.");
      e.preventDefault();
    } else {
      return true;
    }

    function ResetForm() {
      document.getElementById("fullname").value = "";
      document.getElementById("email").value = "";
      document.getElementById("phone").value = "";
      document.getElementById("checkin").value = "";
      document.getElementById("checkout").value = "";
      document.getElementById("guests").value = "";
      document.getElementById("roomtype").value = "";
      document.getElementById("requests").value = "";
    }
  });
