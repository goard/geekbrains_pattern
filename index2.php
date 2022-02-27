<?php
namespace Ayur\Search;

$arr = array();
// print_r($a);
for ($i=0; $i<10; $i++) {
  $num = rand(0, 10);
  array_push($arr, $num);
}

function binarySearch ($myArray, $num) {
  //определяем границы массива
  $left = 0;
  $right = count($myArray) - 1;
  while ($left <= $right) {
  //находим центральный элемент с округлением индекса в меньшую сторону
    $middle = floor(($right + $left)/2);
  //если центральный элемент и есть искомый   
    if ($myArray[$middle] == $num) {
      return $middle;
    }
    elseif ($myArray[$middle] > $num) {
  //сдвигаем границы массива до диапазона от left до middle-1
      $right = $middle - 1;
    }
    elseif ($myArray[$middle] < $num) {
      $left = $middle + 1;
    }
  }
  return null;
}

$idxSearch=true;

while ($idxSearch) {
  $idxSearch = binarySearch($arr, 6);
  echo "idx" . $idxSearch . "\n";
  unset($arr[$idxSearch]);
}

print_r($arr) ;
