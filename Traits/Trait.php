<?php

// Trait for sleep timers
trait Timers {
    public function sleep1sec() {
        sleep(1);
    }

    public function sleep2sec() {
        sleep(2);
    }

    public function finishTimer() {
        sleep(1);
        echo 'done' . PHP_EOL;
    }
}

// Trait for displaying on terminal
trait Display {
    public function gameArt() {
        $art = '        
         _______ 
        |A  .   | _______
        |  /.\  ||A  ^   | _______
        | (_._) ||  / \  ||A  _   | _______
        |   |   ||  \ /  ||  ( )  ||A _ _  |
        |_____ A||   .   || (_|_) || ( v ) |
                 |_____ A||   |   ||  \ /  |
                          |_____ A||   .   |
                                   |_____ A|';
        return Display::displayText($art,true);
    }

    public function cardArt($color, $value) {

        if ($value == 10) {
            $value_bot = $value; 
            $value_top = $value;
        }
        else {
            $value_bot = ' ' . $value;
            $value_top = $value . ' ';
        };
        
        switch ($color) {

            case "Spades":
                $art = " 
                 _______ 
                |$value_top .   |
                |  /.\  |
                | (_._) |
                |   |   |
                |_____$value_bot|";
                return Display::displayText($art);;
                break;

            case "Clubs":
                $art = " 
                 _______
                |$value_top _   |
                |  ( )  |
                | (_|_) |
                |   |   |
                |_____$value_bot|";
                return Display::displayText($art);;
                break;

            case "Hearts":
                $art = "
                 _______
                |$value_top"."_ _  |
                | ( v ) |
                |  \ /  |
                |   .   |
                |_____$value_bot|";
                return Display::displayText($art);;
                break;

            case "Diamonds":
                $art = "
                 _______
                |$value_top ^   |
                |  / \  |
                |  \ /  |
                |   .   |
                |_____$value_bot|";
                return Display::displayText($art);;
                break;
        }
    }

    // public function hiddenCard($space) {
    //     $spaces = "";
    //     for ($i = 0; $i<= $space; $i++) {
    //         $spaces . " ";
    //     }
    //     $art = "
    //             "."$spaces"."|_______|
    //     ";
    //     return Display::displayText($art);
    // }

    public function visibleCard($value, $space) {
        $spaces = "";
        for ($i = 0; $i<= $space; $i++) {
            $spaces = $spaces . " ";
        }

        ($value == 10) ? $value_bot = $value : $value_bot = ' ' . $value;
        
        $art = "
                "."$spaces"."|_______|
                "."$spaces"." "." "."|_____$value_bot|";
        return Display::displayText($art);
    }

    public function battleArt() {
        $art = '
               /\                                                   /\
        _      )( ___________________           ___________________ )(      _
       (_)////(**)___________________> BATTLE !<___________________(**)\\\\\\\(_)
               )(                                                   )(
               \/                                                   \/
        ';

        return Display::displayText($art,true);
    }

    public function sadFace() {
        $art = "
          .--------.
        .'          '.
       /   O      O   \
      :           `    :
      |            `   |
      :    .------.    :
       \  '        '  /
        '.          .'
          '-......-'
        ";

        return Display::displayText($art,true);
    }

    public function roundSeparator() {
        return Display::displayText("************************************************************************", true);
    }

    public function jumpLine() {
        echo '' . PHP_EOL;
    }

    public function displayText(string $str, bool $phpEol = false) {
        if($phpEol) {
            echo $str . PHP_EOL;
        }
        else {
            echo $str;
        }
    }
}

?>