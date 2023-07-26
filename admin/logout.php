<?php

require("inc/functions.php");

unset($_SESSION['is_admin']);

redirect("login.php");