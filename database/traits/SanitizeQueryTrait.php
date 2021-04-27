<?php
namespace Database;

trait SanitizeQuery
{
    private function stringEncode($input)
    {
        foreach ($input as &$value) {
            $value = htmlentities($value);
        }
        return $input;
    }

    private function stringDecode($input)
    {
        foreach ($input as &$value) {
            $value = html_entity_decode($value);
        }
        return $input;
    }
}