<?php

namespace TobyMaxham\PhoenixAuth\Support;

/**
 * @author Tobias Maxham <git@maxham.de>
 */
class Helper
{
    public static function except($array, $keys = null)
    {
        if (! is_array($keys)) {
            $keys = func_get_args();
            unset($keys[0]);
        }

        $original = &$array;

        if ([] === $keys) {
            return $array;
        }

        foreach ($keys as $key) {
            $parts = explode('.', (string) $key);

            while (count($parts) > 1) {
                $part = array_shift($parts);

                if (isset($array[$part]) && is_array($array[$part])) {
                    $array = &$array[$part];
                } else {
                    $parts = [];
                }
            }

            unset($array[array_shift($parts)]);

            // clean up after each pass
            $array = &$original;
        }

        return $array;
    }
}
