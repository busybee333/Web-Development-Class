<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/1/2018
 * Time: 4:57 PM
 */

namespace Guessing;


class GuessingController
{
    /**
     * Constructor
     * @param Wumpus $wumpus The Wumpus object
     * @param array $get The $_GET array
     */
    public function __construct(Guessing $guessing, $post) {
        $this->guessing = $guessing;

        if(isset($post['clear'])) {
            $this->reset = true;
        }
        elseif(isset($post['value'])) {
            $this->guessing->guess(strip_tags($post['value']));
        }
    }

    public function isReset() {
        return $this->reset;
    }

    public function getGuessing() {
        return $this->guessing;
    }

    private $guessing;
    private $reset = false;
}