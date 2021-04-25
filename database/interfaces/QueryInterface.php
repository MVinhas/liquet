<?php
namespace database\interfaces;

interface QueryInterface
{
    public static function select(array $fields, string $table);
    
    public static function create(string $table);

    public static function update(string $table);

    public static function insert(string $table);

    public static function delete(string $table);
}