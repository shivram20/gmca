document
  .getElementById("reservationForm")
  .addEventListener("submit", function (e) {
    let checkin = document.getElementById("checkin").value;
    let checkout = document.getElementById("checkout").value;
    let guests = document.getElementById("guests").value;
    let roomtype = document.getElementById("roomtype").value;
    let request = document.getElementById("requests").value;
    let today = new Date().toISOString().split("T")[0];

    if (checkin === "") {
      alert("Please select a check-in date.");
      e.preventDefault();
    } else if (checkout === "") {
      alert("Please select a check-out date.");
      e.preventDefault();
    } else if (checkin < today) {
      alert("Check-in date cannot be in the past.");
      e.preventDefault();
    } else if (checkout < checkin) {
      alert("Check-out date cannot be earlier than check-in date.");
      e.preventDefault();
    } else if (guests === "") {
      alert("Please select the number of guests.");
      e.preventDefault();
    } else if (guests < 1 || guests > 5) {
      alert("Number of guests must be between 1 and 5.");
      e.preventDefault();
    } else if (roomtype === "") {
      alert("Please select a room type.");
      e.preventDefault();
    } else if (request === "") {
      alert("Please enter any special requests.");
      e.preventDefault();
    } else {
      return true;
    }
  });
