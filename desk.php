<?php

$goriz_desk = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'];
$vertic_desk = [1, 2, 3, 4, 5, 6, 7, 8];

$checkerdesk = [];
for ($i = 1; $i <= 8; $i++) {
    $checkerdesk[]  = [0 => "a", 1 => $i];
    $checkerdesk[]  = [0 => "b", 1 => $i];
    $checkerdesk[]  = [0 => "c", 1 => $i];
    $checkerdesk[]  = [0 => "d", 1 => $i];
    $checkerdesk[]  = [0 => "e", 1 => $i];
    $checkerdesk[]  = [0 => "f", 1 => $i];
    $checkerdesk[]  = [0 => "g", 1 => $i];
    $checkerdesk[]  = [0 => "h", 1 => $i];
}
