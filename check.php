<?php

function check(array $team, array $enemy, array $truewalk)
{
    global $team, $enemy, $checkerdesk, $goriz_desk, $vertic_desk, $choose_figure, $setStep;
    if (in_array($setStep, $checkerdesk)) {
        if (in_array($setStep, $team)) {
            echo "поле зайняте вашою шашкою";
        } elseif (in_array($setStep, $enemy)) {
            if ((array_search($setStep[0], $goriz_desk) - array_search($choose_figure[0], $goriz_desk)) > 0) {
                $check_for_beat = [$goriz_desk[array_search($choose_figure[0], $goriz_desk) + 2], array_search($choose_figure[1], $vertic_desk) + 3];
            } else {
                $check_for_beat = [$goriz_desk[array_search($choose_figure[0], $goriz_desk) - 2], array_search($choose_figure[1], $vertic_desk) + 3];
            }
            if (!in_array($check_for_beat, $enemy)) {
                $key_enemy = array_search($setStep, $enemy);
                unset($enemy[$key_enemy]); //видалення з елементу з масиву противника
                echo "шашка ".implode($choose_figure)." побила противника на ".implode($setStep);
                $key_team = array_search($choose_figure,$team);
                $team[$key_team] = $check_for_beat;
            }else{
                echo "цю шашку побити не можна";
            }
        }elseif(!in_array($setStep,$truewalk)){
            echo "сюди ходити не можна. доступні поля:";
            echo "<br>";
            print_r(implode($truewalk));
        }else{
            echo "хід виконано";
            $key_team = array_search($choose_figure, $team); //змінюємо масив
            $team[$key_team] = $setStep; //змінюємо масив 
        }
    }else{
        "сюди ходити не можна. такого поля немає на дошці";
    }
}


