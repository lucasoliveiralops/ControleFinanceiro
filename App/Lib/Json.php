<?php

namespace App\Lib;

class Json
{

    static function utf8_decode_deep(&$input)
    {
        if (is_string($input)) {
            $input = utf8_decode($input);
        } else if (is_array($input)) {
            foreach ($input as &$value) {
                self::utf8_decode_deep($value);
            }
            unset($value);
        } else if (is_object($input)) {
            $vars = array_keys(get_object_vars($input));
            foreach ($vars as $var) {
                self::utf8_decode_deep($input->$var);
            }
        }
    }

    static function utf8_encode_deep(&$input)
    {
        if (is_string($input)) {
            return utf8_encode($input);
        } else if (is_array($input)) {
            foreach ($input as &$value) {
                self::utf8_encode_deep($value);
            }

            unset($value);
        } else if (is_object($input)) {
            $vars = array_keys(get_object_vars($input));

            foreach ($vars as $var) {
                self::utf8_encode_deep($input->$var);
            }
        }
        return $input;
    }

    static function decode($dados, $assoc = true)
    {
        $dados = json_decode($dados, $assoc);
        if (json_last_error() === JSON_ERROR_NONE) {
            self::utf8_decode_deep($dados);
            return $dados;
        }
        return array();
    }

    static function encode($dados, $options = 0)
    {
        return json_encode(self::utf8_encode_deep($dados), $options);
    }
}
