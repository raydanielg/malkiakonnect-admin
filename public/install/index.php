<?php

$step = '/install/step01.php';

http_response_code(302);
header('Location: '.$step);
exit;
