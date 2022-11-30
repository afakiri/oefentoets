<?php
//include ("opdracht1.php");

try {
    $db = new  PDO("mysql:host=localhost;dbname=cijfers",
        "root", "");
    if (isset($_POST['verzenden'])){
        $leerling= filter_input(INPUT_POST, "leerling",
            FILTER_SANITIZE_STRING);
        $vak = filter_input(INPUT_POST, "vak",
            FILTER_SANITIZE_STRING);
        $cijfer = filter_input(INPUT_POST, "cijfer",
            FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        if($cijfer !== false && $cijfer >= 1 && $cijfer <= 10){
            $query = $db->prepare("INSERT INTO `cijfersysteem`(`leerling`, `vak`, `cijfer` )
        VALUES (:leerling, :vak, :cijfer)");
            $query->bindParam(":leerling", $leerling);
            $query->bindParam(":vak", $vak);
            $query->bindParam(":cijfer", $cijfer);

            if ($query->execute()){
                header('location: oefentoets.php');
            }else{
                echo "er is een fout opgetraden!";
            }
            echo "<br>";
        } else{
            echo "Vul een juiste cijfer in";
        }

    }
} catch(PDOException $e){
    die("error!!: ". $e->getMessage());
}
?>

<html>
<body>
<form method="post">
    <label for="leerling">leerling</label>
    <input type="text" name="leerling"> <br> <br>
    <label for="vak">vak</label>
    <input type="text" name="vak"> <br> <br>
    <label for="cijfer">cijfer</label>
    <input type="text" name="cijfer"> <br> <br>
    <input type="submit" name="verzenden" value="Opslaan"> <br> <br>
</form>
<a href="oefentoets.php"> master pagina</a>
</body>
</html>