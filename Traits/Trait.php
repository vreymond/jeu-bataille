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
         _____ 
        |A .  | _____
        | /.\ ||A ^  | _____
        |(_._)|| / \ ||A _  | _____
        |  |  || \ / || ( ) ||A_ _ |
        |____A||  .  ||(_|_)||( v )|
               |____A||  |  || \ / |
                      |____A||  .  |
                             |____A|';
        return Display::displayText($art,true);
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