<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=cijfers",
        "root", "");
    $query = $db->prepare("SELECT * FROM cijfersysteem");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    echo "<table>";
    echo "<tr>";
    echo "<td>ID</td>";
    echo "<td>leerling</td>";
    echo "<td>vak</td>";
    echo "<td>cijfer</td>";
    echo "<td>update</td>";
    echo "<td>delete</td>";

    echo "</tr>";

    foreach($result as $data) {
        echo "<tr>";
        echo "<td>" . $data['id']. " </td>";
        echo "<td>" . $data['leerling']. " </td>";
        echo "<td>" . $data['vak']. " </td>";
        echo "<td>" . $data['cijfer']. " </td>";
        echo "<td><a href='update.php?id=" . $data['id']. "'> update</a></td>";
        echo "<td><a href='delete.php?id=" . $data['id']. "'> delete</a></td>";
        echo "</tr>";
    }
    echo "</table>";
}catch (PDOException $e) {
    die("error!:" . $e->getMessage());
}


?>
<A href="insert.php">toevoegen</A>
<link rel="stylesheet" href="style.css">