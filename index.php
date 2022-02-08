<?php
namespace Ayur\Pattern\Decarator;

interface Notifier
{
  public function send() : string;
}

class ConcreteNotifier implements Notifier
{
  public function send() : string
  {
    return "Send Message ConcreteComponent";
  }
}

class Decorator implements Notifier
{
  /**
   * @var Notifier
   */
  protected $component;

  public function __construct(Notifier $component)
  {
    $this->component = $component;
  }

  public function send() : string
  {
    return $this->component->send();
  }
}

class EmailNotifier extends Decorator
{
  public function send() : string 
  {
    return "EmailNotifier(" . parent::send() . ")";
  }
}

class SlackNotifier extends Decorator
{
  public function send() : string
  {
    return "SlackNotifier(" . parent::send() . ")";
  }
}

function clientCode(Notifier $component)
{
  echo "RESULT: " . $component->send();
}

$simple = new ConcreteNotifier();
echo "Client: I've got a simple component: \n";
clientCode($simple);
echo "\n\n";

$decorator1 = new EmailNotifier($simple);
$decorator2 = new SlackNotifier($decorator1);
echo "Client: Now I've got a decorated component:\n";
clientCode($decorator2);
echo "\n";