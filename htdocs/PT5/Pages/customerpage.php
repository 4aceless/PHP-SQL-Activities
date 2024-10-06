<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../mainDesign.css">

</head>

<?php
    include '../connection.php';

    $QUERY = "SELECT * From customeraccount";
    $QUERYRESULT = mysqli_query($connection, $QUERY);
?>

<body>
    <h2>Product Information</h2>
    <table>
        <tr>
            <th> First Name </th>
            <th> Last Name </th>
            <th> Phone Number</th>
            <th> Address </th>
        </tr>
        <?php
            while ($Row = mysqli_fetch_assoc($QUERYRESULT)){
        ?>
        <tr>
            <td> <?php echo $Row['first_name'];?> </td>
            <td> ?php echo $Row['last_name'];?> </td>
            <td> <?php echo $Row['Phone'];?> </td>
            <td> <?php echo $Row['Address'];?> </td>
        </tr>

        <?php
            }
        ?>
    </table>
</body>
</html>