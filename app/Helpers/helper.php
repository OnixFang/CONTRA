<?php
if(!function_exists('format_subject_key'))
{
    function format_subject_key($key)
    {
        $key = trim(preg_replace('/\W/', '', $key));
        $key = substr($key, 0, 3) . "-" . substr($key, 3, strlen($key));
        return $key;
    }
}