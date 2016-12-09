<?php
// Start the session.
session_start();

// We have to make sure there is no garbage left here.
// Failed process will leave the file undeleted.
// So, we need to delete the file that older than 2 days.
$files = glob("tmp/*");
$now   = time();

foreach ($files as $file) {
  if (is_file($file)) {
    if ($now - filemtime($file) >= 60 * 60 * 24 * 2) { // 2 days and older
      unlink($file);
    }
  }
}

// The example total processes.
$total = 20;

// The array for storing the progress.
$arr_content = array();

// Loop through process
for($i=1; $i<=$total; $i++){
  // Calculate the percentation
  $percent = intval($i/$total * 100);

  // Put the progress percentage and message to array.
  $arr_content['percent'] = $percent;
  $arr_content['message'] = $i . " row(s) processed.";

  // Write the progress into file and serialize the PHP array into JSON format.
  // The file name is the session id.
  file_put_contents("tmp/" . session_id() . ".txt", json_encode($arr_content));

  // Sleep one second so we can see the delay
  sleep(1);
}
