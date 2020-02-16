<?php

/*
    class Decks initializers
*/

// include('./Traits/Trait.php');

// randomize cards pool;


class Cards {
    use Timers, Display;

    public function cardsList() {
        Timers::sleep2sec();
        Display::displayText('  1 - Construction du jeu de cartes...');

        $card_colors = array("Spades", "Clubs", "Diamonds", "Hearts");
        $card_values = array_merge(range(2,10), array("Jack", "Queen", "King", "Ace"));
        $cards = array();

        foreach ($card_colors as $color) {
            foreach ($card_values as $value) {
                $cards[] = $value . ' of ' . $color;
            }
        }
        Timers::finishTimer();
        return $cards; 
    }

    public function weight() {
        
        return $weight = array(
            "2" => 0, "3" => 1, "4" => 2, "5" => 3, "6" => 4, "7" => 5, "8" => 6,
            "9" => 7, "10" => 8, "Jack" => 9, "Queen" => 10, "King" => 11, "Ace" => 12
        );
    }

    public function shuffleDeck(array $cardsArray) {
        Timers::sleep2sec();
        Display::displayText('  2 - Mélange du jeu de cartes...');

        for($i = 0; $i <= 5; $i++) {
            shuffle($cardsArray);
        }

        Timers::finishTimer();
        return $cardsArray;
    }

    public function deckPlayersCreator($shuffledDeck, $player1, $player2) {
        Timers::sleep2sec();
        Display::displayText('  3 - Distribution des cartes aux joueurs...');

        $deck_1 = array();
        $deck_2 = array();

        foreach ($shuffledDeck as $key => $value) {
            if ($key % 2 == 0) {
                $deck_1[] = $value;
            }
            else {
                $deck_2[] = $value; 
            }
        }
        $cardsWeight = Cards::weight();
        $playerDecks = array($player1 => $deck_1, $player2 => $deck_2, "Weight" => $cardsWeight);
        Timers::finishTimer();
        return $playerDecks;
    }
}

class Decks extends Cards {
    private $player_1;
    private $player_2;

    public function __construct(string $player1, string $player2) {
        Display::jumpLine();
        Display::displayText('Constructions des decks des joueurs...', true);
        $this->player_1 = $player1;
        $this->player_2 = $player2;
    }

    public function constructDeck() {
        $fullCardsList = $this->cardsList();

        // get the 52 cards shuffled 5
        $shuffleDeck = $this->shuffleDeck($fullCardsList);
        // create two deck for players
        $playersDecks = $this->deckPlayersCreator($shuffleDeck, $this->player_1, $this->player_2);
        // print_r($playersDecks);

        return($playersDecks);
    }
 
}