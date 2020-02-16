<?php

/*
    class Game auto runs
*/

class Game {

    use Timers, Display;

    private $player1_name;
    private $player1_deck;
    private $player2_name;
    private $player2_deck;
    private $cardsWeight;

    public function __construct (Player $player1, Player $player2, array $weight) {
        
        $this->player1_name = $player1->getPlayerName();
        $this->player1_deck = $player1->getDeck();

        $this->player2_name = $player2->getPlayerName();
        $this->player2_deck = $player2->getDeck();

        $this->cardsWeight = $weight;
    }

    public function starter() {
        Game::countDown();
        $winner = Game::round();
        return $winner;
    }

    public function countDown() {
        Display::displayText('La partie va commencer!', true);
        Display::jumpLine();
        for($i = 3; $i > 0; $i--) {
            Timers::sleep1sec();
            Display::displayText("$i... ", true);

            if ($i == 1) {
                Timers::sleep1sec();
                Display::displayText("0.25................ ", true);
                Timers::sleep2sec();
                Display::displaytext("GOOOOO!!!", true);
                Display::jumpLine();
            }
        }
    }

    public function round() {

        $tmp = array();

        while (!empty($this->player1_deck ) || !empty($this->player2_deck)) {
            if (empty($this->player1_deck) || empty($this->player2_deck)) {
                break;
            }

            $card1 = array_shift($this->player1_deck);
            $card2 = array_shift($this->player2_deck);

            Display::displayText("$this->player1_name joue: $card1", true);
            Display::displayText("$this->player2_name joue: $card2", true);
            Display::jumpLine();
            //Timers::sleep1sec();
            $p1_value = explode(" ",$card1)[0];
            $p2_value = explode(" ", $card2)[0];

            //Timers::sleep1sec();

            $weight_p1 = $this->cardsWeight["$p1_value"];
            $weight_p2 = $this->cardsWeight["$p2_value"];

            if ($weight_p1 > $weight_p2) {
                $this->player1_deck[] = $card1;
                $this->player1_deck[] = $card2;
                if (!empty($tmp)) {
                    Display::displayText("$this->player1_name remporte la bataille!! MOUHAHAHA!", true);
                    Display::displayText("$this->player1_name gagne les cartes: '$card1' '$card2'");
                    foreach($tmp as $value) {
                        Display::displaytext(" '$value' ");
                        $this->player1_deck[] = $value;
                    }
                    $tmp = array();
                    Display::jumpLine();
                    Display::jumpLine();
                }
                else {
                    Display::displayText("$this->player1_name gagne les cartes:  '$card1' et '$card2'", true);
                    Display::jumpLine();
                }
            }
            else if ($weight_p1 < $weight_p2) {
                $this->player2_deck[] = $card2;
                $this->player2_deck[] = $card1;
                if (!empty($tmp)) {
                    Display::displayText("$this->player2_name remporte la bataille!! MOUHAHAHA!", true);
                    Display::displayText("$this->player2_name gagne les cartes: '$card2' '$card1'");
                    foreach($tmp as $value) {
                        Display::displaytext(" '$value' ");
                        $this->player2_deck[] = $value;
                    }
                    $tmp = array();
                    Display::jumpLine();
                    Display::jumpLine();
                }
                else {
                    Display::displayText("$this->player2_name gagne les cartes: '$card2' et '$card1'", true);
                    Display::jumpLine();
                }
            }
            else {
                Display::battleArt();
                $tmp[] = $card1;
                $tmp[] = $card2;
            }
        }

        Display::jumpLine();
        Display::jumpLine();
        if (empty($this->player1_deck)) {
            return $this->player2_name;
        }
        else {
            return $this->player1_name;
        }
    }

    // public function tester($c1, $c2, $v1, $v2) {
        

        
    // }

    // public function battle() {
        
    // }
}