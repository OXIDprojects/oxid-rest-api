<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

/**
 * Boostrap OXID framework
 */
require_once __DIR__ . '/../../../../bootstrap.php';

class BaseControllerOxid extends Controller
{

    /**
     * Convert an OXID object to an array
     * Hide some specific fields, for now password and passsalt of oxusers
     *
     * @param object $o Oxid object
     *
     * @return array
     */
    protected function _oxObject2Array($o)
    {
        $vars = get_object_vars($o);
        $a = [];
        foreach ($vars as $key => $value) {
            $vars = get_object_vars($o);
            foreach ($vars as $key => $value) {
                if (($pos = strpos($key, '__')) > 0) {
                    $key = substr($key, $pos + 2);
                    $value = $value->getRawValue();
                    $a[ strtoupper($key) ] = $value;
                }
            }
        }

        return $a;
    }

    /**
     * Convert stdClass to array
     *
     * @param object $d Oxid object
     *
     * @return array
     */
    protected function _objectToArray($d)
    {
        if (is_object($d)) {
            // Gets the properties of the given object
            // with get_object_vars function
            $d = get_object_vars($d);
        }
        if (is_array($d)) {
            // for recursive call
            return array_map(['BaseControllerOxid', '_objectToArray'], $d);
        } else {
            // return filtered array
            if (is_array($d)) {
                foreach ($d as $k => $v) {
                    $k = strtolower($k);
                }
            }

            return $d;
        }
    }
}
