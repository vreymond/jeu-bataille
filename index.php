<?php

include('./Traits/Trait.php');
include('./Classes/Player.php');
include('./Classes/Decks.php');
include('./Classes/Game.php');

class CardGame {

    use Timers, Display;

    public function startGame(string $name_1, string $name_2) {

        CardGame::initScript();
        
        $players_array = CardGame::initPlayer($name_1, $name_2);
        $player1_obj = $players_array[$name_1];
        $player2_obj = $players_array[$name_2];
        Timers::sleep1sec();

        $players_decks = CardGame::initDecks($name_1, $name_2);
        
        $player1_obj->setDeck($players_decks[$name_1]);
        $player2_obj->setDeck($players_decks[$name_2]);

        Display::jumpLine();
        Timers::sleep2sec();
        CardGame::initGame($player1_obj, $player2_obj, $players_decks["Weight"]);

    }

    private function initScript() {
        Display::displayText('---------------------------------------------', true);
        Display::displayText('Bienvenue dans le jeu de bataille automatique', true);
        Display::displayText('---------------------------------------------');
        Display::gameArt();
        Timers::sleep2sec();
        Display::jumpLine();
        Display::displayText('Création des joueurs...', true);
        Timers::sleep1sec();
    }

    private function initPlayer($name_1, $name_2) {
        $player_1 = new Player($name_1);
        $player_2 = new Player($name_2);
        
        $players = array($player_1->getPlayerName() => $player_1, $player_2->getPlayerName() => $player_2);

        return $players;
    }

    private function initDecks($name_1, $name_2) {
        Timers::sleep2sec();
        $decks = new Decks($name_1, $name_2);
        return $decks->constructDeck();
    }

    private function initGame(Player $player1, Player $player2, array $cardsWeight) {
        $autoGame = new Game($player1, $player2, $cardsWeight);
        $winner = $autoGame->starter();

        Display::displaytext("Le grand gagnant est: $winner !!!");
    }
}

CardGame::startGame("Ryu", "Ken");

?>