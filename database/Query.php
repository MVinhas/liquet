<?php
namespace database;
use database\Select;
use database\Update;
use database\Create;
use database\Delete;
use database\interfaces\QueryInterface;

class Query implements QueryInterface
{
    public static function select(array $fields, string $table)
    {
        return new Select($fields, $table);
    }

    public static function update(string $table)
    {
        return new Update($table);
    }

    public static function create(string $table)
    {
        return new Create($table);
    }

    public static function insert(string $table)
    {
        return new Insert($table);
    }

    public static function delete(string $table)
    {
        return new Delete($table);
    }
}