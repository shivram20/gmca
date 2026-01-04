 <?php include("../connection.php");
  session_start();
  ?>

 <style>
   /* Reservation container */
   .reservation-wrapper {
     width: 100%;
     display: flex;
     justify-content: center;
     padding: 20px;
   }

   .reservation-container {
     width: 100%;
     max-width: 550px;
     background: #ffffff;
     padding: 25px 30px;
     border-radius: 10px;
     box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
   }

   /* Form title */
   .form-title {
     text-align: center;
     margin-bottom: 20px;
     color: #333;
   }

   /* Form groups */
   .form-group {
     margin-bottom: 15px;
   }

   /* Labels */
   .form-label {
     display: block;
     margin-bottom: 5px;
     font-weight: 600;
     color: #444;
   }

   /* Inputs, select, textarea */
   .form-input,
   .form-select,
   .form-textarea {
     width: 90%;
     padding: 10px;
     border: 1px solid #ccc;
     border-radius: 6px;
     font-size: 14px;
     transition: border 0.3s;
   }

   /* Focus effect */
   .form-input:focus,
   .form-select:focus,
   .form-textarea:focus {
     outline: none;
     border-color: #ecf2eeff;
   }

   /* Textarea resize control */
   .form-textarea {
     resize: vertical;
   }

   /* Buttons container */
   .form-actions {
     display: flex;
     justify-content: space-between;
     gap: 10px;
     margin-top: 20px;
   }

   /* Buttons */
   .btn {
     flex: 1;
     padding: 10px;
     font-size: 15px;
     border: none;
     border-radius: 6px;
     cursor: pointer;
     transition: background 0.3s;
     font-weight: 600;
     text-transform: uppercase;
   }

   /* Submit button */
   .btn-save {
     background: #f8a325ff;
     color: black;
   }

   /* Reset button */
   .btn-reset {
     background: #eda437ff;
     color: #333;
   }

   /* Hover effects */
   .btn:hover {
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

 <div class="reservation-wrapper">
   <div class="reservation-container">

     <form name="reservationForm"
       ng-submit="submitReservation()"
       novalidate>

       <h2 class="form-title">Edit Reservation Details</h2>
       <div class="form-group">
        <label class="form-label">Check-in Date</label>
         <!-- Check-in -->
         <input type="date"
           class="form-input"
           name="checkin"
           ng-model="reservation.checkin"
           ng-model-options="{ timezone: 'UTC' }"
           ng-attr-min="{{minCheckin}}"
           required>
       </div>

       <div class="form-group">
        <label class="form-label">Check-out Date</label>
         <input type="date"
           class="form-input"
           name="checkout"
           ng-model="reservation.checkout"
           ng-model-options="{ timezone: 'UTC' }"
           ng-attr-min="{{minCheckout}}"
           required>
       </div>

       <!-- Guests -->
       <div class="form-group">
         <label class="form-label">Number Of Guests</label>
         <input type="number"
           class="form-input"
           name="guests"
           ng-model="reservation.guests"
           min="1"
           max="5"
           step="1"
           required>
       </div>

       <!-- Room Type -->
       <div class="form-group">
         <label class="form-label">Room Type</label>
         <select class="form-select"
           name="roomtype"
           ng-model="reservation.roomtype"
           required>
           <option value="">--Select--</option>
           <option value="single">Single</option>
           <option value="double">Double</option>
           <option value="suite">Suite</option>
         </select>
       </div>

       <!-- Requests -->
       <div class="form-group">
         <label class="form-label">Special Requests</label>
         <textarea class="form-textarea"
           rows="3"
           ng-model="reservation.requests"
           placeholder="Any special requirements?"></textarea>
       </div>

       <!-- Buttons -->
       <div class="form-actions">
         <button type="submit" class="btn btn-save">
           Submit
         </button>

         <button type="button"
           class="btn btn-reset"
           ng-click="resetForm()">
           Reset
         </button>
       </div>

     </form>
   </div>
 </div>