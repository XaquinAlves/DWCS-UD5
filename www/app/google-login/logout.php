<?php

declare(strict_types=1);

session_start();
// Destroy the session
session_destroy();
// Redirect to the login page
header('Location: login.php');
exit;