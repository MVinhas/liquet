<?php
namespace database;

class Create
{
    protected $fields = array();

    protected $table;

    public function __construct(array $fields, array $table)
    {
        $this->fields = implode(',', $fields);

        $this->table = $table;
    }

}