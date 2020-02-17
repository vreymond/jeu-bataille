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
        $tmp_hidden = array();

        while (!empty($this->player1_deck) && !empty($this->player2_deck)) {
            Display::roundSeparator();
            $card1 = array_shift($this->player1_deck);
            $card2 = array_shift($this->player2_deck);
            $exploded1 = explode(" ",$card1);
            $exploded2 = explode(" ",$card2);
            $p1_value = $exploded1[0];
            $p2_value = $exploded2[0];
        
            Display::displayText("$this->player1_name joue: $card1   ");
            Display::displayText("$this->player2_name joue: $card2", true);
            (is_numeric($p1_value)) ? Display::cardArt($exploded1[2], $p1_value) : Display::cardArt($exploded1[2], $p1_value[0]);
            Game::battleHiddenDisplayer($tmp, "p1");
            (is_numeric($p2_value)) ? Display::cardArt($exploded2[2], $p2_value) : Display::cardArt($exploded2[2], $p2_value[0]);
            Game::battleHiddenDisplayer($tmp, "p2");
            Display::jumpLine();
            Display::jumpLine();
            //Timers::sleep1sec();
            
            $weight_p1 = $this->cardsWeight["$p1_value"];
            $weight_p2 = $this->cardsWeight["$p2_value"];

            if ($weight_p1 > $weight_p2) {
                //Game::result($card1, $card2, "p2");
                
                $this->player1_deck[] = $card1;
                $this->player1_deck[] = $card2;
                if (!empty($tmp)) {
                    Display::displayText("$this->player1_name remporte la bataille!! MOUHAHAHA!", true);
                    Display::displayText("$this->player1_name gagne les cartes: '$card1' '$card2'");
                    foreach($tmp as $value) {
                        Display::displaytext(" '$value'");
                        $this->player1_deck[] = $value;
                    }
                    Display::jumpLine();
                    Display::displayText("$this->player1_name gagne les cartes cachées:");
                    foreach($tmp_hidden as $value) {
                        Display::displaytext(" '$value'");
                        $this->player1_deck[] = $value;
                    }
                    $tmp = array();
                    $tmp_hidden = array();
                    Display::jumpLine();
                    Display::jumpLine();
                }
                else {
                    Display::displayText("$this->player1_name gagne les cartes:  '$card1' et '$card2'", true);
                    Display::jumpLine();
                }
                
            }
            else if ($weight_p1 < $weight_p2) {
                // Game::result($card1, $card2, "p2");
                
                $this->player2_deck[] = $card2;
                $this->player2_deck[] = $card1;
                if (!empty($tmp)) {
                    Display::displayText("$this->player2_name remporte la bataille!! MOUHAHAHA!", true);
                    Display::displayText("$this->player2_name gagne les cartes: '$card2' '$card1'");
                    foreach($tmp as $value) {
                        Display::displaytext(" '$value'");
                        $this->player2_deck[] = $value;
                    }
                    Display::jumpLine();
                    Display::displayText("$this->player2_name gagne les cartes cachées:");
                    foreach($tmp_hidden as $value) {
                        Display::displaytext(" '$value'");
                        $this->player2_deck[] = $value;
                    }
                    $tmp = array();
                    $tmp_hidden = array();
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
                $tmp_hidden[] = array_shift($this->player1_deck);
                $tmp_hidden[] = array_shift($this->player2_deck);
                
            }

            //Timers::sleep1sec();
        } ;

        Display::jumpLine();
        Display::jumpLine();

        if (empty($this->player1_deck)) {
            return $this->player2_name;
        }
        else {
            return $this->player1_name;
        }
    }

    public function battleHiddenDisplayer($tmp,$p) {

        if (!empty($tmp)) {
            if ($p == "p1") {
                $e = explode(" ", $tmp[0]);
            }
            else{
                $e = explode(" ", $tmp[1]);
            }
            (is_numeric($e)) ? $e[0] : $e = $e[0][0];
            for($i = 0; $i <= count($tmp) / 2; $i+=2) {
                Display::visibleCard($e, count($tmp));
            }
        }
    }

}