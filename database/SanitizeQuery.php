<?php
namespace database;

class SanitizeQuery
{
    private function stringEncode($input)
    {
        array_walk_recursive(
            $input, function (&$value) {
                    if (is_string($value))
                        $value = htmlentities($value);
                }
        );
        return $input;
    }

    private function stringDecode($input)
    {
        array_walk_recursive(
            $input, function (&$value) {
                    if (is_string($value))
                        $value = html_entity_decode($value);
                }
        );
        return $input;
    }
}