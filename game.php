<?php
require_once 'main_page.php';
require_once 'desk.php';
require_once 'object.php';



//хід
if (isset($_POST['choose_figure']) or isset($_POST['set_step'])) {
    $choose_figure = str_split($_POST['choose_figure']); //це буде введено з форми. якою шашкою ми робимо хід
    $setStep = str_split($_POST['set_step']); //це буде введено з форми, куди ми збираємось піти
    $choose_figure = [$choose_figure[0], intval($choose_figure[1])];
    $setStep = [$setStep[0], intval($setStep[1])];


    //куди можна походити:
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
    $message = [];


    //перевірки:
    if (in_array($choose_figure, $_SESSION["wh_team"])) { //хід білими
        if (in_array($setStep, $checkerdesk)) {
            if (in_array($setStep, $_SESSION["wh_team"])) {
                $message[]= "поле зайняте вашою шашкою";
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
                if (!in_array($check_for_beat, $_SESSION["bl_team"])) {
                    $key_enemy = array_search($setStep, $_SESSION["bl_team"]);
                    unset($_SESSION["bl_team"][$key_enemy]); //видалення з елементу з масиву противника
                    $message[] = "шашка " . implode($choose_figure) . " побила противника на " . implode($setStep);
                    $key_team = array_search($choose_figure, $_SESSION["wh_team"]);
                    $_SESSION["wh_team"][$key_team] = $check_for_beat;
                } else {
                    $message[] = "цю шашку побити не можна";
                }
            } elseif (!in_array($setStep, $truewalkWhite)) {
                $message[] = "сюди ходити не можна. доступні поля:";
                $message[] = "<br>";
                foreach ($truewalkWhite as $truewalk) {
                    if (in_array($truewalk, $checkerdesk) and !in_array($truewalk, $_SESSION["wh_team"])) {
                        $message[] = (implode($truewalk))."<br>";
                    }
                }
            } else {
                $message[] = "хід виконано";
                $key_team = array_search($choose_figure, $_SESSION["wh_team"]); //змінюємо масив
                $_SESSION["wh_team"][$key_team] = $setStep; //змінюємо масив 
            }
        } else {
            "сюди ходити не можна. такого поля немає на дошці";
        }
    } elseif (in_array($choose_figure, $_SESSION["bl_team"])) { //хід чорними
        if (in_array($setStep, $checkerdesk)) {
            if (in_array($setStep, $_SESSION["bl_team"])) {
                $message[] = "поле зайняте вашою шашкою";
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
                if (!in_array($check_for_beat, $_SESSION["wh_team"])) {
                    $key_enemy = array_search($setStep, $_SESSION["wh_team"]);
                    unset($_SESSION["wh_team"][$key_enemy]); //видалення з елементу з масиву противника
                    $message[] = "шашка " . implode($choose_figure) . " побила противника на " . implode($setStep);
                    $key_team = array_search($choose_figure, $_SESSION["bl_team"]);
                    $_SESSION["bl_team"][$key_team] = $check_for_beat;
                } else {
                    $message[] = "цю шашку побити не можна";
                }
            } elseif (!in_array($setStep, $truewalkBlack)) {
                $message[] = "сюди ходити не можна. доступні поля:";
                $message[] = "<br>";
                foreach ($truewalkBlack as $truewalk) {
                    if (in_array($truewalk, $checkerdesk) and !in_array($truewalk, $_SESSION["bl_team"])) {
                        $message[] = (implode($truewalk))."<br>";
                    }
                }
            } else {
                $message[] = "хід виконано";
                $key_team = array_search($choose_figure, $_SESSION["bl_team"]); //змінюємо масив
                $_SESSION["bl_team"][$key_team] = $setStep; //змінюємо масив 
            }
        } else {
            "сюди ходити не можна. такого поля немає на дошці";
        }
    }
}
//потрібно доробити можливість бити противника, який знаходиться позаду. і почерговість дій гравців
//фронтенд->зробити візуальну дошку із шашками
//виправити баг із розміщенням шашки скраю