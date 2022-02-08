<?php
namespace Ayur\Pattern\Adapter;

class SquareAreaLib
{
  public function getSquareArea(int $diagonal)
  {
    $area = ($diagonal**2)/2;
    return $area;
  }
}

class CircleAreaLib
{
  public function getCircleArea(int $diagonal)
  {
    $area = (M_PI * ($diagonal**2))/4;
    return $area;
  }
}

/** ISquare */
interface ISquare
{
  function squareArea(int $sideSquare);
}

class ComponentSquare implements ISquare
{
  public function squareArea(int $sideSquare)
  {
    return 'square Area ' . $sideSquare;
  }
}

class AdapterSquare extends SquareAreaLib
{
  private $adaptee;

  public function __construct(ISquare $adaptee)
  {
    $this->adaptee = $adaptee;
  }

  public function getSquareArea(int $diagonal)
  {
    $sideSquare = $diagonal / sqrt(2);
    return $this->adaptee->squareArea($sideSquare);
  }
}

/** ICircle */
interface ICircle
{
  function circleArea(int $circumference);
}

class AdapterCircle extends CircleAreaLib
{
  private $adaptee;

  public function __construct(ICircle $adaptee)
  {
    $this->adaptee = $adaptee;
  }

  public function getCircleArea(int $diagonal)
  {
    $circumference = $diagonal / M_PI;
    return $this->adaptee->circleArea($circumference);
  }
}

function clientCode(SquareAreaLib $target)
{
  echo $target->getSquareArea(25);
  return "";
}


$adaptee = new ComponentSquare();
echo "Client: The Adaptee class has a weird interface. See, I don't understand it:\n";
echo 'Adaptee: ' . $adaptee->squareArea(5);
echo "\n\n";

echo "Client: But I can work with it via the Adapter:\n";
$adapter = new AdapterSquare($adaptee);
clientCode($adapter);
echo "\n";