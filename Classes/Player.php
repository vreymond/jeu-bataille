<?php
/*
    Class Player initializer
*/

// include('./Traits/Trait.php');

class Player {

    use Timers, Display;

    private $player_name;
    private $player_deck = array();

    public function __construct(string $player_name) {
        $this->player_name = $player_name;

        Display::displayText("  $this->player_name a rejoint la bataille !", true);
    }

    public function getPlayerName() {
        return $this->player_name;
    }

    public function setDeck($deck) {
        $this->player_deck = $deck;
    }

    public function getDeck() {
        return $this->player_deck;
    }

    
}