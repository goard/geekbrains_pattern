<?php
namespace Ayur\Pattern\AbstractFactory\Abstract;

abstract class AbstractFactory
{
  abstract public function DBConnection() : Connection;
  abstract public function DBRecord() : Record;
  abstract public function DBQueryBuilder() : QueryBuilder;
}

class MySQLFactory extends AbstractFactory
{
  public function DBConnection() : Connection
  {
    return new MySQLConnection();
  }

  public function DBRecord() : Record
  {
    return new MySQLRecord();
  }

  public function DBQueryBuilder() : QueryBuilder
  {
    return new MySQLQueryBuilder();
  }
}

class PostgreSQLFactory extends AbstractFactory
{
  public function DBConnection() : Connection
  {
    return new PostgreSQLConnection();
  }

  public function DBRecord() : Record
  {
    return new PostgreSQLRecord();
  }

  public function DBQueryBuilder() : QueryBuilder
  {
    return new PostgreSQLQueryBuilder();
  }
}

class OracleFactory extends AbstractFactory
{
  public function DBConnection() : Connection
  {
    return new OracleConnection();
  }

  public function DBRecord() : Record
  {
    return new OracleRecord();
  }

  public function DBQueryBuilder() : QueryBuilder
  {
    return new OracleQueryBuilder();
  }
}

interface Connection
{
  public function usefulFuctionA() : string;
}

class MySQLConnection implements Connection
{
  public function usefulFuctionA() : string
  {
    return 'The result of the connection MySQL';
  }
}

class PostgreSQLConnection implements Connection
{
  public function usefulFuctionA() : string
  {
    return 'The result of the connection PostgreSQL';
  }
}

class OracleConnection implements Connection
{
  public function usefulFuctionA() : string
  {
    return 'The result of the connection Oracle';
  }
}

interface Record
{
  public function usefulFuctionB() : string;
}

class MySQLRecord implements Record
{
  public function usefulFuctionB() : string
  {
    return 'The result of the record MySQL';
  }
}

class PostgreSQLRecord implements Record
{
  public function usefulFuctionB() : string
  {
    return 'The result of the record PostgreSQL';
  }
}

class OracleRecord implements Record
{
  public function usefulFuctionB() : string
  {
    return 'The result of the record Oracle';
  }
}

interface QueryBuilder
{
  public function usefulFuctionC() : string;
}

class MySQLQueryBuilder implements QueryBuilder
{
  public function usefulFuctionC() : string
  {
    return 'The result of the query builder MySQL';
  }
}

class PostgreSQLQueryBuilder implements QueryBuilder
{
  public function usefulFuctionC() : string
  {
    return 'The result of the query builder PostgreSQL';
  }
}

class OracleQueryBuilder implements QueryBuilder
{
  public function usefulFuctionC() : string
  {
    return 'The result of the query builder Oracle';
  }
}

function clientCode(AbstractFactory $factory)
{
  $DBConnection = $factory->DBConnection();
  $DBRecord = $factory->DBRecord();
  $DBQueryBuilder = $factory->DBQueryBuilder();

  echo $DBConnection->usefulFuctionA() . "\n"; 
  echo $DBRecord->usefulFuctionB() . "\n";
  echo $DBQueryBuilder->usefulFuctionC() . "\n";
}

echo "Client: Testing client code with the first factory type:\n";
clientCode(new MySQLFactory());

echo "\n";

echo "Client: Testing the same client code with the second factory type:\n";
clientCode(new PostgreSQLFactory());

echo "\n";

echo "Client: Testing the same client code with the third factory type:\n";
clientCode(new OracleFactory());