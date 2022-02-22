<?php
namespace Ayur\Pattern\Iterator;

$path="/home/ayur/myprojects/education/geekbrains/pattern/architecture";
// Создаем новый объект DirectoryIterator

$unicodeTreePrefix = function(\RecursiveTreeIterator $tree)
{
  $prefixParts = [
    \RecursiveTreeIterator::PREFIX_LEFT         => ' ',
    \RecursiveTreeIterator::PREFIX_MID_HAS_NEXT => '│ ',
    \RecursiveTreeIterator::PREFIX_END_HAS_NEXT => '├ ',
    \RecursiveTreeIterator::PREFIX_END_LAST     => '└ '
  ];
  foreach ($prefixParts as $part => $string) {
    $tree->setPrefixPart($part, $string);
  }
};

$dir  = new \RecursiveDirectoryIterator($path, \RecursiveDirectoryIterator::KEY_AS_FILENAME | \RecursiveDirectoryIterator::SKIP_DOTS);
$tree = new \RecursiveTreeIterator($dir);
$unicodeTreePrefix($tree);

echo "[$path]\n";
foreach ($tree as $filename => $line) {
    echo $tree->getPrefix(), $filename, "\n";
}