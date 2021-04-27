<?php
namespace Database\Interfaces;

interface QueryInterface
{
    public static function table(string $table);

    public function queryBuilder();

    public function raw();
}