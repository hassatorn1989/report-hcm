<?php
function hourly($wage, $rate)
{
    $rate = number_format($rate, 3);
    $hourly = floor($wage / $rate);
    $hourly .= ":";
    $hourly .= sprintf("%02d", fmod($wage, $rate) / $rate * 60);

    return $hourly;
}

function hourly_wage($wage, $rate)
{
    $rate = number_format($rate, 3);
    $hourly_wage = floor($wage / $rate) * 60;
    $hourly_wage += sprintf("%02d", fmod($wage, $rate) / $rate * 60);
    $hourly_wage *= ($rate / 60);

    return number_format($hourly_wage, 2);
}
?>
