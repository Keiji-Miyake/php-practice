<?php

$res = password_hash('password', PASSWORD_DEFAULT);
var_dump("res:" . $res);
var_dump("len:" . strlen($res));
