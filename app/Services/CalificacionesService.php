<?php

namespace App\Services;

class CalificacionesService
{
    public function calcularLiteral($estado, $nota)
    {
        $literal = '';

        if ($estado != 'N') {
            return '-';
        }

        if ($nota >= 90) {
            $literal = 'A';
        } else if ($nota >= 80 && $nota <= 89) {
            $literal = 'B';
        } else if ($nota >= 70 && $nota <= 79) {
            $literal = 'C';
        } else if ($nota >= 60 && $nota <= 69) {
            $literal = 'D';
        } else if ($nota >= 1 && $nota <= 59) {
            $literal = 'F';
        } else if ($nota == 0) {
            $literal = 'R';
        }

        return $literal;
    }

    public function calcularPuntos($literal, $credito)
    {
        $puntos = 0;

        switch ($literal) {
            case 'A':
                $puntos = 4;
                break;
            case 'B':
                $puntos = 3;
                break;
            case 'C':
                $puntos = 2;
                break;
            case 'D':
                $puntos = 1;
                break;
            default:
            return 0;
                break;
        }

        $totalPuntos += $puntos + $credito;

        return $puntos * $credito;
    }
}
