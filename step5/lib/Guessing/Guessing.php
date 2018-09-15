<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/1/2018
 * Time: 3:14 PM
 */

namespace Guessing;

class Guessing {
    const MIN = 1;
    const MAX = 100;

    const CORRECT = 0;
    const TOOLOW = 1;
    const TOOHIGH = 2;
    const INVALID = 3;

    public function __construct($seed = null) {
        if($seed === null) {
            $seed = time();
        }

        srand($seed);
        $this->number = rand(self::MIN, self::MAX);
    }

    public function getNumber() {
        return $this->number;
    }

    public function guess($num) {
        $this->theGuess = $num;
        if($this->check() != self::INVALID) {
            $this->numGuesses++;
        }
    }

    public function getGuess() {
        return $this->theGuess;
    }

    public function getNumGuesses() {
        return $this->numGuesses;
    }

    public function check() {
        $guess = $this->theGuess;

        if(!is_numeric($guess) || $guess < self::MIN || $guess > self::MAX) {
            return self::INVALID;
        } else if($guess < $this->number) {
            return self::TOOLOW;
        } else if($guess > $this->number) {
            return self::TOOHIGH;
        }
    }

    private $number;

    private $theGuess = 1;
    private $numGuesses = 0;
}
