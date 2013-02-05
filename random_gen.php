<?php
function random()
{
    $random = "";
    for ($i = 0; $i < 8; $i++) {
        $random = $random . rand(0, 9);
    }
    return $random;
}

?>
