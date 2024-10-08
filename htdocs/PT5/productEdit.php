<?php
    session_start();
    include 'connection.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['ProductID'])) {
            $_SESSION['ProductId'] = $_POST['ProductID'];

            $Query = "SELECT * FROM products WHERE productID = " . $_SESSION['ProductId'];
            $QUERYRESULT = mysqli_query($connection, $Query);

            $Row = mysqli_fetch_assoc($QUERYRESULT);

            $_SESSION['ProductPrice'] = $Row['Price'];
            $_SESSION['ProductName'] = $Row['Name'];
            $_SESSION['ProductDescription'] = $Row['Description'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>

    <link rel="stylesheet" href="CSS_files/mainDesign.css">
    <link rel="stylesheet" href="CSS_files/ProductInsertEditDesign.css">

    <?php
        $Query = "SELECT * FROM products WHERE productID = " . $_SESSION['ProductId'];
        $QUERYRESULT = mysqli_query($connection, $Query);

        $Row = mysqli_fetch_assoc($QUERYRESULT);
    ?>
</head>

<body>
    <div id = "Header">
        <a class="headerText" href="Pages/productPage.php"> Go Back </a>
        &nbsp;&nbsp;&nbsp;
    </div>

    <div id = "TitleText">
        <?php
            echo "<h1>Edit Product: " . $_SESSION['ProductName'] . "</h1>";
        ?>
    </div>

    <div id="CenterTable">
        <form method="post" action="UpdateData.php">
            <table>
                <tr>
                    <td> Product Name: <input type="text" id="ProductName" name="ProductName" placeholder="Enter product name" value="<?php echo htmlspecialchars($Row['Name']); ?>"></td>
                </tr>

                <tr>
                    <td> Price: <input type="number" id="Price" name="Price" placeholder="Enter product price" min="0" step=".01" value="<?php echo htmlspecialchars($Row['Price']); ?>"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                </tr>
                <tr>
                    <td>
                    <textarea name="DescriptionText" id="DescriptionText" rows="5" cols="50", name="DescriptionText", placeholder="Description about the product..."><?php echo htmlspecialchars($Row['Description']); ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td id="SubmitButton"> <input type="Submit" value="Update" name="UpdateProduct"></td>
                </tr>

                <tr>
                    <td>
                        <?php
                            if (isset($_SESSION['SuccessUpdateMessage'])){
                                if ($_SESSION['SuccessUpdateMessage'] != ""){
                                    if ($_SESSION['SuccessUpdateMessage'] == "Success"){
                                        echo '<br>Product Updated Successfully';
                                    }
                                    else{
                                        echo '<br>Product Update Failed {Empty Fields or Invalid Inputs}';
                                    }
                                }
                            }
                        ?>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>