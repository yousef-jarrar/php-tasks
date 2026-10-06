<?php
$colors=array('white','green','red');
sort($colors);
echo "<ul>";
foreach($colors as $color){
    echo "<li>". $color ."</li>";
}
echo "</ul>";
?>
<?php
$cities= array( 
"Italy"=>"Rome",
"Luxembourg"=>"Luxembourg",
"Belgium"=> "Brussels", 
"Denmark"=>"Copenhagen", 
"Finland"=>"Helsinki", 
"France" => "Paris", 
"Slovakia"=>"Bratislava", 
"Slovenia"=>"Ljubljana",
"Germany" => "Berlin",
"Greece" => "Athens", 
"Ireland"=>"Dublin", 
"Netherlands"=>"Amsterdam",
 "Portugal"=>"Lisbon", 
 "Spain"=>"Madrid"
  ); 

 asort($cities);
 foreach($cities as $country =>$capital){
    echo "the capital of " . $country ."is".$capital."<br>";
 }
 
?>
 
 <?php
 $color=array(4=>"wahit",6=>"green",11=>"red");
 echo "<br>";
 echo reset($color)."<br>";
 
 ?>
<?php

$number=array(1,2,3,4,5);

$location=4;
$newitem='$';
 array_splice($number , $location -1, 0 ,$newitem);

foreach ($number as $value) {
    
    echo $value . " " ;
   
}
?>

<?php
echo "<br>";
$fruits=array(
"d"=>"lemon",
"a"=>"orange",
"b"=>"bnana",
"c"=>"appel"
);
Ksort($fruits);
foreach($fruits as $key=>$value){
    echo $key ."=" .$value."<br>";
}
?>

<?php
$temperatures = array(
    78, 60, 62, 68, 71, 68, 73, 85, 66, 64,
    76, 63, 75, 76, 73, 68, 62, 73, 72, 65,
    74, 62, 62, 65, 64, 68, 73, 75, 79, 73
);
$avareg=array_sum($temperatures)/count($temperatures);
echo "avareg temp is:" .$avareg ."<br>";

sort($temperatures);

$lowst=array_slice($temperatures,0,5);
$highest=array_slice($temperatures,-5);

echo "list of five lowst temp";
echo implode(", ",$lowst);

echo "<br>";

echo "list of five hightes temp";
echo implode(", ",$highest);
?>

<?php
echo "<br>";
$array1=array("color"=>"red",2,4);
$array2 = array("a", "b", "color" => "green", "shape" => "trapezoid", 4);

$result=array_merge($array1, $array2);
print_r($result);
?>
<?php
echo "<br>";
$color=array("red", "blue", "white", "yellow");

function uppercase($array){
     foreach($array as $key=>$value){
        $array[$key]=strtoupper($value);
     }
     return $array;
}
$color=uppercase($color);
print_r($color);
?>
<?php
echo "<br>";
$number=3;
$isprime=true;
 if($number<2){
    $isprime=false;
 }
 for ($i=2;$i < $number;$i++){
    if($number % $i==0){
        $isprime=false;
        break;
    }
 }
   if ($isprime) {
    echo $number . " is a prime number";
} else {
    echo $number . " is not a prime number";
}
?>
<?php
echo "<br>";
$string="remove";
echo strrev($string);
?>
<?php
echo "<br>";
$x=12;
$y=10;

function swap(&$x,&$y){
    $temp=$x;
    $x=$y;
    $y=$temp;
}
swap($x,$y);
echo "y =" .$y ."<br>";
echo "x =" .$x;
?>

<?php
$number=407;
function isArmstrong($number) {
    $sum =0;
    $temp=$number;

    while($temp>0){
        $digit=$temp%10;
         $sum = $sum + ($digit * $digit * $digit);
        $temp = (int)($temp / 10);
    }
    if ($sum == $number) {
        return true;
    } else {
        return false;
    }
}

if (isArmstrong($number)) {
    echo $number . " is Armstrong Number";
} else {
    echo $number . " is not Armstrong Number";
}
?>
<?php

$string = "Eva, can I see bees in a cave?";

function isPalindrome($string) {

    $string = strtolower($string);
    $string = preg_replace("/[^a-z0-9]/", "", $string);

    if ($string == strrev($string)) {
        return true;
    } else {
        return false;
    }
}

if (isPalindrome($string)) {
    echo "Yes it is a palindrome";
} else {
    echo "No it is not a palindrome";
}

?>
<?php
echo "<br>";
$array=array(2,4,7,4,8,4);
function duplicat($array){
    return array_unique($array);
}
$array=duplicat($array);
print_r($array);
?>


<?php
echo "<br>";
$firstInteger = 10;
$secondInteger = 10;

function checkSum($firstInteger, $secondInteger) {
    $sum = $firstInteger + $secondInteger;

    if ($sum == 30) {
        return $sum;
    } else {
        return false;
    }
}

$result = checkSum($firstInteger, $secondInteger);

var_dump($result);
?>

<?php
echo "<br>";
$number = 20;

if ($number % 3 == 0) {
    echo "true";
} else {
    echo "false";
}
?>

<?php
echo "<br>";
$number = 50;
if ($number >= 20 && $number <= 50) {
    echo "true";
} else {
    echo "false";
}
?>
<?php
echo "<br>";
$a = 1;
$b = 5;
$c = 9;

if ($a >= $b && $a >= $c) {
    echo $a;
} elseif ($b >= $a && $b >= $c) {
    echo $b;
} else {
    echo $c;
}
?>
<?php
echo "<br>";
$units = 180;
$bill = 0;

if ($units <= 50) {
    $bill = $units * 2.50;
} elseif ($units <= 150) {
    $bill = (50 * 2.50) + (($units - 50) * 5.00);
} elseif ($units <= 250) {
    $bill = (50 * 2.50) + (100 * 5.00) + (($units - 150) * 6.20);
} else {
    $bill = (50 * 2.50) + (100 * 5.00) + (100 * 6.20) + (($units - 250) * 7.50);
}

echo $bill . " JOD";
?>

<?php
echo "<br>";
$num1 = 10;
$num2 = 5;
$operator = "+";

if ($operator == "+") {
    echo $num1 + $num2;
} elseif ($operator == "-") {
    echo $num1 - $num2;
} elseif ($operator == "*") {
    echo $num1 * $num2;
} elseif ($operator == "/") {
    echo $num1 / $num2;
} else {
    echo "Invalid operator";
}
?>
<?php
echo "<br>";
$age = 15;

if ($age >= 18) {
    echo "is eligible to vote";
} else {
    echo "is not eligible to vote";
}
?>
<?php
echo "<br>";
$number = -60;

if ($number > 0) {
    echo "Positive";
} elseif ($number < 0) {
    echo "Negative";
} else {
    echo "Zero";
}
?>
<?php
echo "<br>";
$marks = array(60,86,95,63,55,74,79,62,50);

$total = array_sum($marks);
$average = $total / count($marks);

if ($average >= 90) {
    echo "A";
} elseif ($average >= 80) {
    echo "B";
} elseif ($average >= 70) {
    echo "C";
} elseif ($average >= 60) {
    echo "D";
} else {
    echo "F";
}
?>
<?php
echo "<br>";
for ($i = 1; $i <= 10; $i++) {
    echo $i;

    if ($i < 10) {
        echo "-";
    }
}
?>
<?php 
echo "<br>";
$array = [
    ['A', 'A', 'A', 'A', 'A'],
    ['A', 'A', 'A', 'B', 'B'],
    ['A', 'A', 'C', 'C', 'C'],
    ['A', 'D', 'D', 'D', 'D'],
    ['E', 'E', 'E', 'E', 'E']
];

for ($i = 0; $i < count($array); $i++) {

    for ($j = 0; $j < count($array); $j++) {
        echo $array[$i][$j] . " ";
    }

    echo "<br>";
}
?>
<?php 
echo "<br>";
$array = [
    ['1', '1', '1', '1', '1'],
    ['1', '1', '1', '2', '2'],
    ['1', '1', '3', '3', '3'],
    ['1', '4', '4', '4', '4'],
    ['5', '5', '5', '5', '5']
];

for ($i = 0; $i < count($array); $i++) {

    for ($j = 0; $j < count($array); $j++) {
        echo $array[$i][$j] . " ";
    }

    echo "<br>";
}
?>
<?php
echo "<br>";
for ($i = 1; $i <= 5; $i++) {

    for ($j = 1; $j <= 5; $j++) {

        if ($i == $j) {
            echo $i . " ";
        } else {
            echo "0 ";
        }

    }

    echo "<br>";
}
?>
<?php
echo "<br>";
$number = 5;
$factorial = 1;

for ($i = 1; $i <= $number; $i++) {
    $factorial = $factorial * $i;
}

echo $factorial
?>
 <?php
 echo "<br>";
$string = "hello world";

echo strtoupper($string);
echo "<br>";

echo strtolower($string);
echo "<br>";

echo ucfirst($string);
echo "<br>";

echo ucwords($string);
 ?>