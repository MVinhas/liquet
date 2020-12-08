<?php

use PHPUnit\Framework\TestCase;

final class DbOperationsTest extends TestCase
{

    public function testCreateRecord(): void
    {
        $mock = $this->createMock(\engine\DbOperations::class);

        $mock->method('create')->willReturn(true);

        $table = 'testTable';
        $fields = 'id, name, category';
        $data = [1, 'Joana', 'Entrepeneur'];

        $result = $mock->create($table, $fields, $data);

        $this->assertTrue($result);
    }

    public function testSelectRecord(): void
    {
        $mock = $this->createMock(\engine\DbOperations::class);

        $mock->method('select')->willReturn(true);

        $table = 'testTable';
        $fields = 'id, name, category';
        $filter = 'id = ?';
        $data = [1];

        $result = $mock->select($table, $fields, $filter, $data);

        $this->assertTrue($result);
    }

    public function testUpdateRecord(): void
    {
        $mock = $this->createMock(\engine\DbOperations::class);

        $mock->method('update')->willReturn(true);

        $table = 'testTable';
        $fields = 'name, category';
        $values = ['Joana', 'Entrepeneur'];
        $where = 'id = ?';
        $where_value = [1];

        $result = $mock->update($table, $fields, $values, $where, $where_value);

        $this->assertTrue($result);
    }

    public function testDeleteRecord(): void
    {
        $mock = $this->createMock(\engine\DbOperations::class);

        $mock->method('delete')->willReturn(true);

        $table = 'testTable';
        $condition = 'id = ?';
        $condition_values = [1];

        $result = $mock->delete($table, $condition, $condition_values);

        $this->assertTrue($result);
    }
    
    public function testCheckTable(): void
    {
        $mock = $this->createMock(\engine\DbOperations::class);

        $mock->method('checkTable')->willReturn(true);

        $table = 'testTable';

        $result = $mock->checkTable($table);

        $this->assertTrue($result);
    }

    public function testCreateTable(): void
    {
        $mock = $this->createMock(\engine\DbOperations::class);

        $mock->method('createTable')->willReturn(true);

        $table = 'testTable';
        $fields = array(
            'id' => 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'name' => 'VARCHAR(64) NOT NULL',
            'category' => 'VARCHAR(128) NOT NULL'
        );

        $result = $mock->createTable($table, $fields);
        
        $this->assertTrue($result);
    } 

}