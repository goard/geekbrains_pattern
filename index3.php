<?php
namespace Ayur\Pattern\Adapter;

$n = 100;                           // O(1)
$array[]= [];                       // O(1)

for ($i = 0; $i < $n; $i++) {       // O(N)
  for ($j = 1; $j < $n; $j *= 2) {  // O(N/2)
     $array[$i][$j]= true;          // 
} }                                 //
//
// O(1) + O(1) + O(N) * O(N/2)
// O(2) + O(N^2/2)
// O(2 + N^2/2) 
// O(N^2/2)
// O(N^2)
//

$n = 100;                         // O(1)
$array[] = [];                    // O(1)

for ($i = 0; $i < $n; $i += 2) {  // O(N-2)
  for ($j = $i; $j < $n; $j++) {  // O(N)
     $array[$i][$j]= true;
} }

//
// O(1) + O(1) + O(N-2) * O(N)
// O(2) + O(N^2-2N)
// O(2 + N^2 - 2N)
// O(N^2 - 2N)
// 