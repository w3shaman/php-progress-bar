<?php
// Start the session.
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Progress Bar</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <style>
    #progress {
      width: 500px;
      border: 1px solid #aaa;
      height: 20px;
    }
    #progress .bar {
      background-color: #ccc;
      height: 20px;
    }
  </style>
</head>
<body>
  <div id="progress"></div>
  <div id="message"></div>
  <script>
    var timer;

    // The function to refresh the progress bar.
    function refreshProgress() {
      // We use Ajax again to check the progress by calling the checker script.
      // Also pass the session id to read the file because the file which storing the progress is placed in a file per session.
      // If the call was success, display the progress bar.
      $.ajax({
        url: "checker.php?file=<?php echo session_id() ?>",
        success:function(data){
          $("#progress").html('<div class="bar" style="width:' + data.percent + '%"></div>');
          $("#message").html(data.message);
          // If the process is completed, we should stop the checking process.
          if (data.percent == 100) {
            window.clearInterval(timer);
            timer = window.setInterval(completed, 1000);
          }
        }
      });
    }

    function completed() {
      $("#message").html("Completed");
      window.clearInterval(timer);
    }

    // When the document is ready
    $(document).ready(function(){
      // Trigger the process in web server.
      $.ajax({url: "process.php"});
      // Refresh the progress bar every 1 second.
      timer = window.setInterval(refreshProgress, 1000);
    });
  </script>
</body>
</html>
