<?php

$array = array(
    "Twinkle,",
    " twinkle,",
    " twinkle",
    " little star."
);

var_dump($array);

echo "<br>";
$letter = 'z';

if ($letter == 'z') {
    $letter = 'a';
} else {
    $letter++;
}

echo $letter;

echo "<br>";


$string = "The brown fox";

$position = 4;

$string = substr_replace($string, "quick ", $position, 0);

echo $string;

echo "<br>";

$string = "The quick brown fox";

$words = explode(" ", $string);

echo $words[0];


echo "<br>";
$string = "0000657022.24";

$string = str_replace("0", "", $string);

echo $string;

echo "<br>";
$string = "The quick brown fox jumps over the lazy dog---";

$string = rtrim($string, "-");

echo $string;

echo "<br>";
$string = "The quick brown fox jumps over the lazy dog";

$words = explode(" ", $string);

$firstFive = array_slice($words, 0, 5);

echo implode(" ", $firstFive);

echo "<br>";
$string = "2,543.12";

$string = str_replace(",", "", $string);

echo $string;
?>

<?php
echo "<br>";
$a = 0;
$b = 1;

for ($i = 0; $i < 9; $i++) {
    echo $a . ", ";

    $next = $a + $b;
    $a = $b;
    $b = $next;
}

echo "<br>";
$n = 5;
$num = 1;

for ($i = 1; $i <= $n; $i++) {

    for ($j = 1; $j <= $i; $j++) {
        echo $num . " ";
        $num++;
    }

    echo "<br>";
}


for ($i = 1; $i <= 5; $i++) {
    for ($j = 0; $j < $i; $j++) {
        echo chr(65 + $j) . " ";
    }
    echo "<br>";
}

for ($i = 4; $i >= 1; $i--) {
    for ($j = 0; $j < $i; $j++) {
        echo chr(65 + $j) . " ";
    }
    echo "<br>";
}
?>

<?php

echo "<br>";
$year = 2013;

if (($year % 400 == 0) || ($year % 4 == 0 && $year % 100 != 0)) {
    echo "This year is a leap year";
} else {
    echo "This year is not a leap year";
}

echo "<br>";
$temperature = 27;

if ($temperature < 20) {
    echo "It is wintertime!";
} else {
    echo "It is summertime!";
}

echo "<br>";
$firstInteger = 2;
$secondInteger = 2;

if ($firstInteger == $secondInteger) {
    $sum = ($firstInteger + $secondInteger) * 3;
} else {
    $sum = $firstInteger + $secondInteger;
}

echo $sum;

echo "<br>";
for ($i = 200; $i <= 250; $i++) {
    if ($i % 4 == 0) {
        echo $i . ",";
    }
}

echo "<br>";
$numbers = range(11, 20);

shuffle($numbers);

for ($i = 0; $i < 10; $i++) {
    echo $numbers[$i] . " ";
}
?>