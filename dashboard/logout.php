<?php
session_start(array(
    'name' => 'thesis_rev1'
));

session_destroy();

header('Location: ../login.php');
