<!DOCTYPE html>

<?php include 'app.php'; ?>

<html>

<head>
    <title>Fruit Shop</title>
</head>

<body>
    <h1> Shop Fruits </h1>
    <form action="/api/add.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"><br><br>
        <label for="amount">Amount:</label>
        <input type="text" id="amount" name="amount"><br><br>
        <input type="submit" value="Submit">
    </form>

    <h2> Fruits </h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Amount</th>
            <th>Buy</th>
        </tr>
        <?php
        $results = $db->GetFruits();
        while ($row = $results->fetchArray()) {
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['amount'] . "</td>";
            echo "<td><a href='/api/buy.php?id=" . $row['id'] . "'>Buy</a></td>";
            echo "</tr>";
        }
        ?>
    </table>


</body>

</html>