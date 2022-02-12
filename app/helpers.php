<?php
function job_calculation($time) {
    $average = $time / 45;
    return number_format($average, 2, '.', '');
}
