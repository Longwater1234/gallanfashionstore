<?php
session_start();
session_unset();
session_destroy();
echo '<p align="center">' . "You have logged out. Redirecting you..." . '</p>';
header( 'Refresh: 1; URL = index.php' );

?>