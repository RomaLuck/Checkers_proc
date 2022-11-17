<?php
session_start();
require_once "game.php";
?>


<!doctype html>

<head>
    <title>Form chess</title>
    <link rel="stylesheet" href="index.css">
    <style>
        .box {
            text-align: center;
            background-color: #eeeeee;
        }

        .centered {
            display: inline-block;
            margin: 0;
        }

        .chess-board {
            border-spacing: 0;
            border-collapse: collapse;
        }

        .chess-board th {
            padding: .5em;
        }

        .chess-board td {
            border: 1px solid;
            width: 5em;
            height: 5em;
            text-align: center;
            vertical-align: middle;
        }

        .chess-board .white {
            background: #f0d9b5;
        }

        .chess-board .black {
            background: #b58863;
        }
    </style>
</head>

<body>
    <form method="POST" id="form" action="">
        <input type="text" name="choose_figure" id="form1" placeholder="вибираємо шашку">
        <input type="text" name="set_step" id="form2" placeholder="вибираємо клітинку">
        <input type="submit" name="submit" id="submit" value="походити">
    </form>
    <?php
    if (isset($_SESSION["white"])) {
        echo ($_SESSION["white"]);
    } 

    echo '<table border="1">';
    foreach (array_chunk($_SESSION["wh_team"], 4) as $item) {
        echo "<tr>";
        foreach ($item as $wh) {
            echo "<td>";
            echo implode($wh);
            echo "</td>";
        }
        echo "</tr>";
    }
    echo '</table>';

    if (isset($_SESSION["black"])) {
        echo ($_SESSION["black"]);
    }
        echo '<table border="1">';
    foreach (array_chunk($_SESSION["bl_team"], 4) as $item) {
        echo "<tr>";
        foreach ($item as $bl) {
            echo "<td>";
            echo implode($bl);
            echo "</td>";
        }
        echo "</tr>";
    }
    echo '</table>';
    ?>
    <div class="box">
        <div class="centered">

            <table class="chess-board">
                <tbody>
                    <tr>
                        <th></th>
                        <th>a</th>
                        <th>b</th>
                        <th>c</th>
                        <th>d</th>
                        <th>e</th>
                        <th>f</th>
                        <th>g</th>
                        <th>h</th>
                    </tr>
                    <tr>
                        <th>8</th>
                        <td class="white" id="a8"></td>
                        <td class="black" id="b8"></td>
                        <td class="white" id="c8"></td>
                        <td class="black" id="d8"></td>
                        <td class="white" id="e8"></td>
                        <td class="black" id="f8"></td>
                        <td class="white" id="g8"></td>
                        <td class="black" id="h8"></td>
                    </tr>
                    <tr>
                        <th>7</th>
                        <td class="black" id="a7"></td>
                        <td class="white" id="b7"></td>
                        <td class="black" id="c7"></td>
                        <td class="white" id="d7"></td>
                        <td class="black" id="e7"></td>
                        <td class="white" id="f7"></td>
                        <td class="black" id="g7"></td>
                        <td class="white" id="h7"></td>
                    </tr>
                    <tr>
                        <th>6</th>
                        <td class="white" id="a6"></td>
                        <td class="black" id="b6"></td>
                        <td class="white" id="c6"></td>
                        <td class="black" id="d6"></td>
                        <td class="white" id="e6"></td>
                        <td class="black" id="f6"></td>
                        <td class="white" id="g6"></td>
                        <td class="black" id="h6"></td>
                    </tr>
                    <tr>
                        <th>5</th>
                        <td class="black" id="a5"></td>
                        <td class="white" id="b5"></td>
                        <td class="black" id="c5"></td>
                        <td class="white" id="d5"></td>
                        <td class="black" id="e5"></td>
                        <td class="white" id="f5"></td>
                        <td class="black" id="g5"></td>
                        <td class="white" id="h5"></td>
                    </tr>
                    <tr>
                        <th>4</th>
                        <td class="white" id="a4"></td>
                        <td class="black" id="b4"></td>
                        <td class="white" id="c4"></td>
                        <td class="black" id="d4"></td>
                        <td class="white" id="e4"></td>
                        <td class="black" id="f4"></td>
                        <td class="white" id="g4"></td>
                        <td class="black" id="h4"></td>
                    </tr>
                    <tr>
                        <th>3</th>
                        <td class="black" id="a3"></td>
                        <td class="white" id="b3"></td>
                        <td class="black" id="c3"></td>
                        <td class="white" id="d3"></td>
                        <td class="black" id="e3"></td>
                        <td class="white" id="f3"></td>
                        <td class="black" id="g3"></td>
                        <td class="white" id="h3"></td>
                    </tr>
                    <tr>
                        <th>2</th>
                        <td class="white" id="a2"></td>
                        <td class="black" id="b2"></td>
                        <td class="white" id="c2"></td>
                        <td class="black" id="d2"></td>
                        <td class="white" id="e2"></td>
                        <td class="black" id="f2"></td>
                        <td class="white" id="g2"></td>
                        <td class="black" id="h2"></td>
                    </tr>
                    <tr>
                        <th>1</th>
                        <td class="black" id="a1"></td>
                        <td class="white" id="b1"></td>
                        <td class="black" id="c1"></td>
                        <td class="white" id="d1"></td>
                        <td class="black" id="e1"></td>
                        <td class="white" id="f1"></td>
                        <td class="black" id="g1"></td>
                        <td class="white" id="h1"></td>
                    </tr>
                    <a href="end_game.php">завершити гру</a>
</body>

</html>