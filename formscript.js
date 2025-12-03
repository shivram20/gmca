document
  .getElementById("reservationForm")
  .addEventListener("submit", function (e) {
    let name = document.getElementById("fullname").value.trim();
    let email = document.getElementById("email").value.trim();

    let password = document.getElementById("password").value.trim();
    let cpassword = document.getElementById("cpassword").value.trim();
    let phone = document.getElementById("phone").value.trim();
    let checkin = document.getElementById("checkin").value;
    let checkout = document.getElementById("checkout").value;
    let guests = document.getElementById("guests").value;
    let roomtype = document.getElementById("roomtype").value;
    let request = document.getElementById("requests").value;
    let today = new Date().toISOString().split("T")[0];

    if (name === "") {
      alert("Please enter your full name.");
      e.preventDefault();
    }
    if (!email.includes("@")) {
      alert("Please enter a valid email address wiht (@).");
      e.preventDefault();
    }
    if (!email.includes(".")) {
      alert("Please enter a valid email address wiht (.).");
      e.preventDefault();
    }
    if (password === "") {
      alert("Please enter a password.");
      e.preventDefault();
    }
    if (cpassword === "") {
      alert("Please confirm your password.");
      e.preventDefault();
    }
    if (password !== cpassword) {
      alert("Passwords do not match.");
      e.preventDefault();
    }
    if (phone === "") {
      alert("Please enter a phone number.");
      e.preventDefault();
    } else if (phone.length !== 10) {
      alert("Please enter a valid 10-digit phone number.");
      e.preventDefault();
    }
    if (checkin === "") {
      alert("Please select a check-in date.");
      e.preventDefault();
    }
    if (checkout === "") {
      alert("Please select a check-out date.");
      e.preventDefault();
    }
    if (checkin < today) {
      alert("Check-in date cannot be in the past.");
      e.preventDefault();
    }
    if (checkout < checkin) {
      alert("Check-out date cannot be earlier than check-in date.");
      e.preventDefault();
    }
    if (guests === "") {
      alert("Please select the number of guests.");
      e.preventDefault();
    } else if (guests < 1 || guests > 5) {
      alert("Number of guests must be between 1 and 5.");
      e.preventDefault();
    }
    if (roomtype === "") {
      alert("Please select a room type.");
      e.preventDefault();
    }
    if (request === "") {
      alert("Please enter any special requests.");
      e.preventDefault();
    }

    return true;

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
