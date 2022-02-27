<?php
namespace Ayur\Pattern\Adapter;

/**
 * Контекст определяет интерфейс, представляющий интерес для клиентов.
 */
class Context
{
    /**
     * @var Strategy Контекст хранит ссылку на один из объектов Стратегии.
     * Контекст не знает конкретного класса стратегии. Он должен работать со
     * всеми стратегиями через интерфейс Стратегии.
     */
    private $strategy;

    /**
     * Обычно Контекст принимает стратегию через конструктор, а также
     * предоставляет сеттер для её изменения во время выполнения.
     */
    public function __construct(Strategy $strategy)
    {

        $this->strategy = $strategy;
    }

    /**
     * Обычно Контекст позволяет заменить объект Стратегии во время выполнения.
     */
    public function setStrategy(Strategy $strategy)
    {

        $this->strategy = $strategy;
    }

    /**
     * Вместо того, чтобы самостоятельно реализовывать множественные версии
     * алгоритма, Контекст делегирует некоторую работу объекту Стратегии.
     */
    public function doSomeBusinessLogic() : void
    {

        // ...

        echo "Context: Sorting data using the strategy (not sure how it'll do it)\n";
        $result = $this->strategy->doAlgorithm([
            "a",
            "b",
            "c",
            "d",
            "e",
        ]);
        echo implode(",", $result) . "\n";

        // ...
    }
}

/**
 * Интерфейс Стратегии объявляет операции, общие для всех поддерживаемых версий
 * некоторого алгоритма.
 *
 * Контекст использует этот интерфейс для вызова алгоритма, определённого
 * Конкретными Стратегиями.
 */
interface Strategy
{
    public function doAlgorithm(array $data) : array;
}

/**
 * Конкретные Стратегии реализуют алгоритм, следуя базовому интерфейсу
 * Стратегии. Этот интерфейс делает их взаимозаменяемыми в Контексте.
 */
class ConcreteStrategyPayQiwi implements Strategy
{
    public function doAlgorithm(array $data) : array
    {

        sort($data);

        return $data;
    }
}

class ConcreteStrategyPayYandex implements Strategy
{
    public function doAlgorithm(array $data) : array
    {

        rsort($data);

        return $data;
    }
}

class ConcreteStrategyPayWebMoney implements Strategy
{
    public function doAlgorithm(array $data) : array
    {

        array_push($data, "f", "g");

        return $data;
    }
}

/**
 * Клиентский код выбирает конкретную стратегию и передаёт её в контекст. Клиент
 * должен знать о различиях между стратегиями, чтобы сделать правильный выбор.
 */
$context = new Context(new ConcreteStrategyPayQiwi());
echo "Client: Strategy is set to pay Qiwi.\n";
$context->doSomeBusinessLogic();

echo "\n";

echo "Client: Strategy is set to pay Yandex.\n";
$context->setStrategy(new ConcreteStrategyPayYandex());
$context->doSomeBusinessLogic();

echo "\n";

echo "Client: Strategy is set to pay WebMoney.\n";
$context->setStrategy(new ConcreteStrategyPayWebMoney());
$context->doSomeBusinessLogic();