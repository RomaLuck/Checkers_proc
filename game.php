<?php
require_once 'main_page.php';
require_once 'desk.php';
require_once 'object.php';



//Move
if (isset($_POST['choose_figure']) or isset($_POST['set_step'])) {
    $choose_figure = str_split($_POST['choose_figure']); //this will be entered from the form. which checkers do we make a move with
    $setStep = str_split($_POST['set_step']); //it will be entered from the form where we are going to go
    $choose_figure = [$choose_figure[0], intval($choose_figure[1])];
    $setStep = [$setStep[0], intval($setStep[1])];
    $message = [];

    //where you can go:
    $side1 = $goriz_desk[array_search($choose_figure[0], $goriz_desk) + 1];
    $side2 = $goriz_desk[array_search($choose_figure[0], $goriz_desk) - 1];
    $forward = $vertic_desk[array_search($choose_figure[1], $vertic_desk) + 1];
    $back = $vertic_desk[array_search($choose_figure[1], $vertic_desk) - 1];
    $truewalkWhite = [
        [$side1, $forward],
        [$side2, $forward]
    ];
    $truewalkBlack = [
        [$side1, $back],
        [$side2, $back]
    ];
    


    //check:
    if (in_array($choose_figure, $_SESSION["wh_team"])) { //move White
        if (in_array($setStep, $checkerdesk)) {
            if (in_array($setStep, $_SESSION["wh_team"])) {
                $message[]= "the field is occupied by your checker";
            } elseif ((in_array($setStep, $_SESSION["bl_team"]) and in_array($setStep, $truewalkWhite)) or (in_array($setStep, $_SESSION["bl_team"]) and in_array($setStep, $truewalkBlack))) {
                if ((array_search($setStep[1], $vertic_desk) - array_search($choose_figure[1], $vertic_desk)) > 0) {
                    if ((array_search($setStep[0], $goriz_desk) - array_search($choose_figure[0], $goriz_desk)) > 0) {
                        $check_for_beat = [$goriz_desk[array_search($setStep[0], $goriz_desk) + 1], array_search($setStep[1], $vertic_desk) + 2];
                    } else {
                        $check_for_beat = [$goriz_desk[array_search($setStep[0], $goriz_desk) - 1], array_search($setStep[1], $vertic_desk) + 2];
                    }
                } elseif ((array_search($setStep[1], $vertic_desk) - array_search($choose_figure[1], $vertic_desk)) < 0) {
                    if ((array_search($setStep[0], $goriz_desk) - array_search($choose_figure[0], $goriz_desk)) > 0) {
                        $check_for_beat = [$goriz_desk[array_search($setStep[0], $goriz_desk) + 1], array_search($setStep[1], $vertic_desk)];
                    } else {
                        $check_for_beat = [$goriz_desk[array_search($setStep[0], $goriz_desk) - 1], array_search($setStep[1], $vertic_desk)];
                    }
                }
                if (!in_array($check_for_beat, $_SESSION["bl_team"]) and in_array($check_for_beat,$checkerdesk)) {
                    $key_enemy = array_search($setStep, $_SESSION["bl_team"]);
                    unset($_SESSION["bl_team"][$key_enemy]); //removing an element from the enemy's array
                    $message[] = "checker " . implode($choose_figure) . " hit the enemy on " . implode($setStep);
                    $key_team = array_search($choose_figure, $_SESSION["wh_team"]);
                    $_SESSION["wh_team"][$key_team] = $check_for_beat;
                    $_SESSION['points_white']+=1;
                } else {
                    $message[] = "this checker cannot be beaten";
                }
            } elseif (!in_array($setStep, $truewalkWhite)) {
                $message[] = "you can't go here. available fields:";
                $message[] = "<br>";
                foreach ($truewalkWhite as $truewalk) {
                    if (in_array($truewalk, $checkerdesk) and !in_array($truewalk, $_SESSION["wh_team"])) {
                        $message[] = (implode($truewalk))."<br>";
                    }
                }
            } else {
                $message[] = "the move is completed";
                $key_team = array_search($choose_figure, $_SESSION["wh_team"]); //change the array
                $_SESSION["wh_team"][$key_team] = $setStep; //change the array
            }
        } else {
            "you can't go here. there is no such field on the board";
        }
    } elseif (in_array($choose_figure, $_SESSION["bl_team"])) { //move Black
        if (in_array($setStep, $checkerdesk)) {
            if (in_array($setStep, $_SESSION["bl_team"])) {
                $message[] = "the field is occupied by your checker";
            } elseif ((in_array($setStep, $_SESSION["wh_team"]) and in_array($setStep, $truewalkWhite)) or (in_array($setStep, $_SESSION["wh_team"]) and in_array($setStep, $truewalkBlack))) {
                if ((array_search($setStep[1], $vertic_desk) - array_search($choose_figure[1], $vertic_desk)) > 0) {
                    if ((array_search($setStep[0], $goriz_desk) - array_search($choose_figure[0], $goriz_desk)) > 0) {
                        $check_for_beat = [$goriz_desk[array_search($setStep[0], $goriz_desk) + 1], array_search($setStep[1], $vertic_desk) + 2];
                    } else {
                        $check_for_beat = [$goriz_desk[array_search($setStep[0], $goriz_desk) - 1], array_search($setStep[1], $vertic_desk) + 2];
                    }
                } elseif ((array_search($setStep[1], $vertic_desk) - array_search($choose_figure[1], $vertic_desk)) < 0) {
                    if ((array_search($setStep[0], $goriz_desk) - array_search($choose_figure[0], $goriz_desk)) > 0) {
                        $check_for_beat = [$goriz_desk[array_search($setStep[0], $goriz_desk) + 1], array_search($setStep[1], $vertic_desk)];
                    } else {
                        $check_for_beat = [$goriz_desk[array_search($setStep[0], $goriz_desk) - 1], array_search($setStep[1], $vertic_desk)];
                    }
                }
                if (!in_array($check_for_beat, $_SESSION["wh_team"]) and in_array($check_for_beat,$checkerdesk)) {
                    $key_enemy = array_search($setStep, $_SESSION["wh_team"]);
                    unset($_SESSION["wh_team"][$key_enemy]); //removing an element from the enemy's array
                    $message[] = "checker " . implode($choose_figure) . " hit the enemy on " . implode($setStep);
                    $key_team = array_search($choose_figure, $_SESSION["bl_team"]);
                    $_SESSION["bl_team"][$key_team] = $check_for_beat;
                    $_SESSION['points_black']+=1;
                } else {
                    $message[] = "this checker cannot be beaten";
                }
            } elseif (!in_array($setStep, $truewalkBlack)) {
                $message[] = "you can't go here. available fields:";
                $message[] = "<br>";
                foreach ($truewalkBlack as $truewalk) {
                    if (in_array($truewalk, $checkerdesk) and !in_array($truewalk, $_SESSION["bl_team"])) {
                        $message[] = (implode($truewalk))."<br>";
                    }
                }
            } else {
                $message[] = "the move is completed";
                $key_team = array_search($choose_figure, $_SESSION["bl_team"]); //change the array
                $_SESSION["bl_team"][$key_team] = $setStep; //change the array
            }
        } else {
            "you can't go here. there is no such field on the board";
        }
    }
}

