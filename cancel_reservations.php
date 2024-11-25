<?php
// Load existing reservations
$file = 'reservations.json';
$reservations = [];
if (file_exists($file)) {
  $reservations = json_decode(file_get_contents($file), true);
}

// Check if there are reservations to cancel
if (!empty($reservations)) {
  // Remove the most recent reservation from the array
  array_pop($reservations);

  // Save the updated reservations to file
  file_put_contents($file, json_encode($reservations, JSON_PRETTY_PRINT));

  // Send a success message
  echo "Your reservation has been canceled.";
} else {
  // Send an error message if there are no reservations to cancel
  echo "There are no reservations to cancel.";
}
?>
