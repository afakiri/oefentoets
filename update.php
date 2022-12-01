<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=cijfers",
        "root", "");

    if (isset($_POST['verzenden'])) {
        $leerling = filter_input(INPUT_POST, "leerling",
            FILTER_SANITIZE_STRING);
        $vak = filter_input(INPUT_POST, "vak",
            FILTER_SANITIZE_STRING);
        $cijfer = filter_input(INPUT_POST, "cijfer",
            FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        $query = $db->prepare("UPDATE cijfersysteem SET cijfer = :cijfer,
                                                        vak = :vak,
                                                        leerling = :leerling
                                WHERE id = :id");

        $query->bindParam("id", $_GET['id']);
        $query->bindParam("leerling", $leerling);
        $query->bindParam("vak", $vak);
        $query->bindParam("cijfer", $cijfer);
        if ($query->execute()){
            header('location:oefentoets.php');
        } else {
            echo "er is een fout opgetreden";
        }

    }else{
        $query = $db->prepare("SELECT * FROM cijfersysteem WHERE id=:id");
        $query->bindParam("id", $_GET['id']);

        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $data);{
            $vak = $data["vak"];
            $cijfer = $data["cijfer"];
            $leerling = $data['leerling'];
        }
    }
}catch (PDOException $e){
    die("error!:" . $e->getMessage());
}
?>
<form method="post" action="">
    <label>Leerling</label>
    <input type="text" disabled name="leerling"
           value="<?php echo $leerling ?>"><br>
    <label>vak</label>
    <input type="text" name="vak"
           value="<?php echo $vak; ?>"><br>
    <label>cijfer</label>
    <input type="text" name="cijfer"
           value="<?php echo $cijfer ?>"><br>


    <input type="submit" name="verzenden" value="opslaan">
</form>
<a href="oefentoets.php" ef="">terug naar tabel</a>