<?php
session_start();
session_destroy();
header('Location: ../views/view-home.php');
exit;
