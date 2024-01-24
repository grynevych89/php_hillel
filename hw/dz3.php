<?php

$var1 = true;
$var2 = false;
$var3 = 0;
$var4 = 0.0;
$var5 = 0.2;
$var6 = -1;
$var7 = '';
$var8 = [];
$var9 = 23;
$var10 = '23';

var_dump($var1 != $var2); # true
var_dump($var1 === $var2); # false
var_dump($var3 == $var4); # true
var_dump($var3 === $var4); # false
var_dump($var9 >= $var10); # true
var_dump($var9 <= $var5); # false
var_dump($var7 != $var9); # true
var_dump($var6 === $var4); # false
var_dump($var8 != $var7); # true
var_dump($var9 < $var5); # false
var_dump($var5 > $var3); # true
