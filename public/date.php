<?php
$offset = 3; // +3: Athens
$months = array( "Ιανουαρίου", "Φεβρουαρίου", "Μαρτίου", "Απριλίου", "Μαΐου", "Ιουνίου", "Ιουλίου", "Αυγούστου", "Σεπτεμβρίου", "Οκτωμβρίου", "Νοεμβρίου", "Δεκεμβρίου" ); 
$days = array( "Κυριακή", "Δευτέρα", "Τρίτη", "Τετάρτη", "Πέμπτη", "Παρασκευή", "Σάββατο" ); 
$server_now = time(); 
$local_now = $server_now+($offset*60*60); 
$day_of_the_week = date("w", $local_now); 
$day = date("j", $local_now); 
$month = date("n", $local_now); 
$year = date("Y", $local_now); 
$time = date("h:i:s", $local_now); 
$full_greek_date = $days[$day_of_the_week] . ", " . $day . " " . $months[$month - 1] . " " . $year.", ".$time;
echo $full_greek_date;
?>