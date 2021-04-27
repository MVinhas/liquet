<?php
namespace Database\Traits;

trait PrepareTrait
{
    public function preparedStatement($sql, $field_count, $data)
    {
        $fields = $this->getValueTypes($field_count, $data);
        $sql_prepare = $this->db->prepare($sql);
        if (!empty($data))
            $sql_prepare->bind_param($fields, ...$data);
        return $sql_prepare;
    }

    public function getValueTypes($field_count, $data)
    {
        $value_types = array();
        for ($i=0; $i < $field_count; $i++) {
            $value_types[$i] = strtolower(substr(gettype($data[$i]), 0, 1));
        }
        
        $value_types = implode('', $value_types);
        
        return $value_types;
    }
}