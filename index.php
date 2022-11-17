<?php
session_start();

$_SESSION["white"] = $_POST["white"];
$_SESSION["black"] = $_POST["black"];

require_once "object.php";
$_SESSION["wh_team"] = $white;
$_SESSION["bl_team"] = $black;
?>

<html>

<head>
    <title>Form chess</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>

    <form method="POST" id="form">
        <input type="text" name="white" id="form1" placeholder="ім'я білих">
        <input type="text" name="black" id="form2" placeholder="ім'я чорних">
        <input type="submit" name="submit" id="submit" value="зберегти">
    </form>
    <?php
    if (isset($_POST["white"]) or isset($_POST["black"])) {
        echo "<p>дані збережено!<p>";
        echo '<p><a href="main_page.php">START GAME</a><p>';
    }
    ?>


</body>

</html>