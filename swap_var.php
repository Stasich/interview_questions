<?php
// Необходимо поменять две переменные местами без использования третьей
$a = 'Переменная $a';
$b = 'Переменная $b';
echo '$a = ' . $a . "<br>\n";
echo '$b = ' . $b . "<br>\n";
list($b, $a) = [$a, $b];
echo '$a = ' . $a . "<br>\n";
echo '$b = ' . $b;