<?php

/**
 * Obtener la calificación sugún el puntaje del examen ICFES
 */

class Puntaje {

    public function getScore($score) {
        if ($score >= 280 && $score <= 289) {
            return 5;
        } elseif ($score >= 260 && $score <= 279) {
            return 4.5;
        } elseif ($score >= 250 && $score <= 259) {
            return 4;
        } elseif ($score >= 240 && $score <= 249) {
            return 3.5;
        } elseif ($score >= 230 && $score <= 239) {
            return 3;
        } elseif ($score >= 220 && $score <= 229) { 
            return 2.5;
        } elseif ($score >= 119 && $score <= 219) {
            return 2;
        } elseif ($score > 290) {
            return 5;
        } else {
            return 0;
        }
    }

}