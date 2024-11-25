<!DOCTYPE HTML>
<html lang="">
<head>
  <title>Confirmed</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="assets/css/main.css" />
</head>
<body class="is-preload">

<!-- Header -->
<div id="header">

  <div class="top">

    <!-- Logo -->
    <div id="logo">
      <span class="image avatar48"><img src="images/avatar.jpg" alt="" /></span>
      <h1 id="title">Jomi & Spencer</h1>
      <p>Software developers</p>
    </div>

    <!-- Nav -->
    <nav id="nav">
      <ul>
        <li><a href="index.html" id="top-link"><span class="icon solid fa-home">Home</span></a></li>
      </ul>
    </nav>

  </div>

  <div class="bottom">

    <!-- Social Icons -->
    <ul class="icons">
      <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
      <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
      <li><a href="#" class="icon brands fa-github"><span class="label">Github</span></a></li>
      <li><a href="#" class="icon brands fa-dribbble"><span class="label">Dribbble</span></a></li>
      <li><a href="#" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
    </ul>

  </div>

</div>

<!-- Main -->
<div id="main">

  <!-- Portfolio -->
  <section id="portfolio" class="two">
    <div class="container">

      <header>
        <h2 class="alt">Reservation Confirmed</h2>
        <?php
        if(isset($_POST['submit'])){
          $name = $_POST['first'];
          echo "Name: ".$name."<br/>";
          $email = $_POST['email'];
          echo "Email: ".$email."<br/>";
          $number = $_POST['number'];
          echo "Phone Number: ".$number."<br/>";
          $date = $_POST['date'];
          echo "Date: ".$date."<br/>";
          $table = $_POST['table'];
          echo "Table Amount: ".$table."<br/>";

          // Load existing reservations
          $reservations = [];
          $file = 'reservations.json';
          if (file_exists($file)) {
            $reservations = json_decode(file_get_contents($file), true);
          }

          // Count reservations for the same hour
          $hourlyReservationCount = 0;
          $newReservationHour = date('Y-m-d H', strtotime($date));
          foreach ($reservations as $reservation) {
            $existingReservationHour = date('Y-m-d H', strtotime($reservation['date']));
            if ($newReservationHour === $existingReservationHour) {
              $hourlyReservationCount++;
            }
          }

          // If hourly reservation count is greater than or equal to 5, display message
          if ($hourlyReservationCount >= 5) {
            echo "<p>Sorry, there are no more slots available for this hour.</p>";
            http_response_code(400); // Send a 400 Bad Request response
            exit(); // Stop the script
          } else {
            // Add the new reservation to the reservations array
            $newReservation = array(
              'name' => $name,
              'email' => $email,
              'phone' => $number,
              'date' => $date,
              'time' => date('Y-m-d H:i:s'),
              'table_amount' => $table
            );
            $reservations[] = $newReservation;

            // Save reservations to file
            file_put_contents($file, json_encode($reservations, JSON_PRETTY_PRINT));
          }
        }
        ?>


      </header>

    </div>
  </section>

  <section id="portfolio" class="two">
    <div class="container">

      <header>
        <h2>Thank you!</h2>
      </header>

      <p>CHECK OUT OUR MENU!</p>

      <div class="row">
        <div class="col-4 col-12-mobile">
          <article class="item">
            <a href="#" class="image fit"><img src="https://th.bing.com/th/id/OIP.t8oNBU6Qm3QmcwM7pqFcwwAAAA?rs=1&pid=ImgDetMain" alt="Fresh baked bread" /></a>
            <header>
              <h3>Bread</h3>
            </header>
          </article>
          <article class="item">
            <a href="#" class="image fit"><img src="https://diethood.com/wp-content/uploads/2021/05/lobster-bisque-8.jpg" alt="Lobster bisque" /></a>
            <header>
              <h3>Soup</h3>
            </header>
          </article>
        </div>
        <div class="col-4 col-12-mobile">
          <article class="item">
            <a href="#" class="image fit"><img src="https://blog.thermoworks.com/wp-content/uploads/2017/06/ribeye_compound_butter_smoke_mk4-79-of-88.jpg" alt="Ribeye steak with compound butter and smoke"/></a>
            <header>
              <h3>Steak</h3>
            </header>
          </article>
          <article class="item">
            <a href="#" class="image fit"><img src="https://kavenyou.com/wp-content/uploads/2019/07/Puffer-Fish-Bulgogi_1-1200x800.jpg" alt="Pufferfish" /></a>
            <header>
              <h3>Pufferfish</h3>
            </header>
          </article>
        </div>
        <div class="col-4 col-12-mobile">
          <article class="item">
            <a href="#" class="image fit"><img src="https://greenwich.fish/wp-content/uploads/2020/05/Sushi.jpg" alt="Just sushi" /></a>
            <header>
              <h3>Sushi</h3>
            </header>
          </article>
          <article class="item">
            <a href="#" class="image fit"><img src="https://th.bing.com/th/id/OIP.7NOngqtziKWl2CchvnbUXwAAAA?rs=1&pid=ImgDetMain" alt="Alfredo" /></a>
            <header>
              <h3>Pasta</h3>
            </header>
          </article>
        </div>
      </div>

    </div>
  </section>

  <section id="cancel-reservation" class="two">
    <div class="container">
      <header>
        <h2>Cancel Reservation</h2>
      </header>
      <p>If you wish to cancel your reservation, click the button below.</p>
      <button id="cancel-btn">Cancel Reservation</button>
    </div>
  </section>

</div>


<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.scrolly.min.js"></script>
<script src="assets/js/jquery.scrollex.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const cancelButton = document.getElementById("cancel-btn");

    cancelButton.addEventListener("click", function () {
      // Send a request to cancel_reservation.php to handle the cancellation
      const xhr = new XMLHttpRequest();
      xhr.open("POST", "cancel_reservations.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // Handle the response from the server
          alert(xhr.responseText);
          // You can redirect the user to another page or perform any other action
        }
      };
      xhr.send(); // Send the request
    });
  });
</script>

</body>
</html>
