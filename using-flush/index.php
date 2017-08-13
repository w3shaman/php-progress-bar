<!DOCTYPE html>
<html>
<head>
  <title>Progress Bar</title>
</head>
<body>
<!-- Progress bar holder -->
<div id="progress" style="width:500px;border:1px solid #ccc;"></div>
<!-- Progress information -->
<div id="information" style="width"></div>
<?php
/**
 * The long running PHP process should be placed here before we close
 * the <body> and <html> tags.
 *
 * In the following demo, the long running process is simulated using
 * basic loop with 1 second delay for each iteration.
 */

/**
 * Set the maximum execution time to 5 minutes (300 seconds).
 * We can flexibly adjust it to fit our need. If we need unlimited time,
 * just set it to 0 but be carefull there will be performance impact.
 */
set_time_limit(300);

// Total processes
$total = 10;

// Loop through process
for($i=1; $i<=$total; $i++){
  // Calculate the percentation
  $percent = intval($i/$total * 100)."%";

  // Javascript for updating the progress bar and information
  echo '<script language="javascript">
  document.getElementById("progress").innerHTML="<div style=\"width:'.$percent.';background-color:#ddd;\">&nbsp;</div>";
  document.getElementById("information").innerHTML="'.$i.' row(s) processed.";
  </script>';

  // This is for the buffer achieve the minimum size in order to flush data
  echo str_repeat(' ',1024*64);

  // Send output to browser immediately
  flush();

  // Sleep one second so we can see the delay
  sleep(1);
}

// Tell user that the process is completed
echo '<script language="javascript">document.getElementById("information").innerHTML="Process completed"</script>';
?>
</body>
</html>
