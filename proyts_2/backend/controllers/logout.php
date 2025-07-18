<?php
session_start();
session_destroy();
header('Location: ../../frontend/views/login.html');
exit();
