<?php
  $conn = mysqli_connect("localhost","root","","chat-php");
  if (!$conn){
    echo "DB error" . mysqli_connect_error();
  }
