<?php
session_start();

if (isset($_POST["white"]) and isset($_POST["black"])) {
    $_SESSION["white"] = $_POST["white"];
    $_SESSION["black"] = $_POST["black"];
}

require_once "object.php";
$_SESSION["wh_team"] = $white;
$_SESSION["bl_team"] = $black;
$_SESSION['points_white'] = $points_white = 0;
$_SESSION['points_black'] = $points_black = 0;
?>

<html>

<head>
    <title>Form checkers</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body class="p-3 mb-2 bg-secondary text-white">

    <div class="container">
        <div class="row justify-content-center align-items-center">
            <form style="max-width: 500px;" class="row g-3" method="POST" name="players">
                <div class="col-auto">
                    <div class="row gy-1">
                        <div class="form-group">
                            <label for="white" class="visually-hidden"></label>
                            <input type="text" class="form-control" id="white" name="white" placeholder="White player name">
                        </div>
                        <div class="form-group">
                            <label for="black" class="visually-hidden"></label>
                            <input type="text" class="form-control" id="black" name="black" placeholder="Black player name">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary" id="save">Save</button>
                        </div>

                        <div class="row gy-2">
                            <div class="form-group">
                                <?php
                                if (isset($_POST["white"]) or isset($_POST["black"])) {
                                    echo "<p class='fw-lighter'>Data saved.</p>";
                                header("Location: main_page.php");
                                }
                                ?>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>