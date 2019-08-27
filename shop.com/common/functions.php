<?php
function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}
function sanitize($before) {
    foreach($before as $key=>$value) {
        if(is_array($value)) {
            foreach($value as $i => $val) {
                $after[$key][$i] = htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
            }
        } else {
            $after[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }
    }
    return $after;
}
