<?php include("../connection.php");
session_start();
?>
<style>
  /* Main background */
  .maindiv {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f2f5f9;
  }

  /* Form container */
  .container {
    width: 100%;
    max-width: 550px;
    padding: 20px;
  }

  /* Form box */
  .box {
    background: #ffffff;
    padding: 25px 30px;
    border-radius: 10px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  }

  /* Heading */
  .box h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
  }

  /* Each field wrapper */
  .box div {
    margin-bottom: 15px;
  }

  /* Labels */
  .box label {
    display: block;
    margin-bottom: 5px;
    font-weight: 600;
    color: #444;
  }

  /* Inputs, select, textarea */
  .box input[type="date"],
  .box input[type="number"],
  .box select,
  .box textarea {
    width: 90%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    transition: border 0.3s;
  }

  /* Focus effect */
  .box input:focus,
  .box select:focus,
  .box textarea:focus {
    outline: none;
    border-color: #ecf2eeff;
  }

  /* Textarea resize control */
  .box textarea {
    resize: vertical;
  }

  /* Buttons container */
  .buttons {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    margin-top: 20px;
  }

  /* Buttons */
  .buttons button {
    flex: 1;
    padding: 10px;
    font-size: 15px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s;
  }

  /* Submit button */
  .buttons button[type="submit"] {
    background: #f8a325ff;
    color: black;
    font-weight: 600;
    text-transform: uppercase;
  }

  /* Reset button */
  .buttons button[type="button"] {
    background: #eda437ff;
    color: #333;
    font-weight: 600;
    text-transform: uppercase;
  }

  /* Hover effects */
  .buttons button:hover {
    opacity: 0.9;
  }

  /* Optional: invalid field highlight (Angular) */
  input.ng-invalid.ng-touched,
  select.ng-invalid.ng-touched {
    border-color: red;
  }

  input.ng-valid.ng-touched,
  select.ng-valid.ng-touched {
    border-color: green;
  }
</style>

<div class="maindiv" ng-controller="ReservationController">
  <div class="container">

    <form name="reservationForm"
      ng-submit="submitReservation()"
      class="box"
      novalidate>

      <h2>Reservation Details</h2>

      <!-- Check-in -->
      <div>
        <label>Check-in Date</label>
        <input type="date"
          name="checkin"
          ng-model="reservation.checkin"
          ng-model-options="{ timezone: 'UTC' }"
          ng-attr-min="{{minCheckin}}"
          required>
      </div>

      <!-- Check-out -->
      <div>
        <label>Check-out Date</label>

        <input type="date"
          name="checkout"
          ng-model="reservation.checkout"
          ng-model-options="{ timezone: 'UTC' }"
          ng-attr-min="{{minCheckout}}"
          required>
      </div>

      <!-- Guests -->
      <div>
        <label>Number Of Guests</label>
        <input type="number"
          name="guests"
          ng-model="reservation.guests"
          min="1"
          max="5"
          step="1"
          required>
      </div>

      <!-- Room Type -->
      <div>
        <label>Room Type</label>
        <select name="roomtype"
          ng-model="reservation.roomtype"
          required>
          <option value="">--Select--</option>
          <option value="single">Single</option>
          <option value="double">Double</option>
          <option value="suite">Suite</option>
        </select>
      </div>

      <!-- Requests -->
      <div>
        <label>Special Requests</label>
        <textarea ng-model="reservation.requests"
          rows="3"
          placeholder="Any special requirements?"></textarea>
      </div>

      <!-- Buttons -->
      <div class="buttons">
        <button type="submit">Submit</button>
        <button type="button" ng-click="resetForm()">Reset</button>
      </div>

    </form>
  </div>
</div>