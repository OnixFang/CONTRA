<?php
/**
 * Created by PhpStorm.
 * User: saurybravo
 * Date: 28/07/18
 * Time: 10:09 AM
 */
return [
    'parser:pensum' => [
        'domain' => 'https://www.uapa.edu.do',
        'entry_point' => "/estudia"
    ],
    'platform' => [
        'domain' => 'http://academico.uapa.edu.do/',
        'services' => [
            'login' => 'acad11.net/login.aspx',
            'logout' => 'acad11.net/login.aspx?op=salir',
            'history' => 'acad11.net/estudiante/ConsEstuCalificacionesEstudiantes.aspx',
            'score' => 'acad11.net/estudiante/ConsEstuCalificacionesEstudiantes.aspx',
            'default' => 'acad11.net/default.aspx',
        ],
    ],
    'headers' => [
        'user-agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; AS; rv:11.0) like Gecko',
        'cookies' => 'ASP.NET_SessionId=leg0e145ruuyie55xy0crnrs'
    ],
];