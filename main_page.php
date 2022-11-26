<?php
session_start();
require_once "game.php";
?>

<!doctype html>

<head>
    <title>Form chess</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body class="p-3 mb-2 bg-secondary text-white">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <form style="max-width: 500px;" class="row g-3" id="form" method="POST">
                <div class="col-auto">
                    <div class="row gy-1">
                        <div class="form-group">
                            <input type="text" name="choose_figure" id="form1" placeholder="choose a checker">
                            <input type="text" name="set_step" id="form2" placeholder="select a cell">
                            <input type="submit" name="submit" id="submit" value="enter">
                        </div>
                    </div>
                </div>
            </form>


            <?php
            $wharray = [];
            foreach ($_SESSION["wh_team"] as $item) {
                $wharray[] = implode($item);
            }
            $blarray = [];
            foreach ($_SESSION["bl_team"] as $item) {
                $blarray[] = implode($item);
            }
            $jsonwhite = json_encode($wharray);
            $jsonblack = json_encode($blarray);
            ?>
            <p><?php if (isset($_SESSION["white"])) {
                    echo ($_SESSION["white"]);
                } ?></p>
            <p id="white"></p>
            <p><?php if (isset($_SESSION["black"])) {
                    echo ($_SESSION["black"]);
                } ?></p>
            <p id="black"></p>

            <!-- <div class="box">
            <div class="centered"> -->
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <table class="chess-board" style="max-width: 500px;">

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
            </table>
                <a href="end_game.php">finish the game</a>
        </div>
    </div>
    <script>
        const table = document.getElementsByTagName("td");
        const form1 = document.getElementById("form1");
        const form2 = document.getElementById("form2");
        var white = JSON.parse('<?php echo $jsonwhite ?>');
        var black = JSON.parse('<?php echo $jsonblack ?>');
        // document.getElementById("white").innerHTML = white;
        // document.getElementById("black").innerHTML = black;

        for (var i = 0; i < table.length; i++) {
            table[i].addEventListener("click", function() {
                if (form1.value == "") {
                    form1.value = event.target.id;
                } else if (event.target.id !== form1.value) {
                    form2.value = event.target.id;
                }
            });
        }

        for (var i = 0; i < table.length; i++) {
            if (white.includes(table[i].id)) {
                table[i].className = "red-piece";
            }
        }

        for (var i = 0; i < table.length; i++) {
            if (black.includes(table[i].id)) {
                table[i].className = "black-piece";
            }
        }
    </script>
    <!-- JavaScript Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> -->
    <script src="script.js"></script>
</body>

</html>