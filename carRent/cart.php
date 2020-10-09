<?php
session_start();
$carArray = array();
if(isset($_SESSION['cars']))
{
    $carArray = $_SESSION['cars'];
}

if(isset($_GET['delete'])){
    $itemToDelete = $_GET['delete'];
    unset($carArray["$itemToDelete"]);
    $_SESSION['cars'] = $carArray;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="css/layout.css" type="text/css">
    <script type="text/javascript" src="javascript/jquery.js"></script>
    <script>
        //if empty cart, go back to the main page
        $(document).ready(function(){
            let list = $("#cartNum").children();
            if(list.length === 0 ) {
                alert("No car on the Cart !");
                window.parent.location = 'mainPage.php';
            }
        });

    </script>
</head>
<body>
    <div id="header">
        <div id="center">
            Car Rental Center
        </div>
    </div>

    <div id="carInfo">
    <form action="info.php">
            <table style="width: 80%">
                <thead>
                    <tr style="font-weight: bold; font-size: 15px">
                        <td style="width: 150px;">Thumbnail</td>
                        <td>Vehicle</td>
                        <td>Price Per Day</td>
                        <td>Rental Days</td>
                        <td>Actions</td>
                    </tr>
                </thead>

                <tbody id="cartNum">
                <?php
                //use foreach to get all the selected cars
                foreach ($carArray as $model=>$car) {
                    echo "<tr style='height: 150px;width: 100%;'>";
                    $vehicle = $car["vehicle"];
                    $price = $car["price"];
                    ?>
                    <td><img src="images/<?php echo $model?>.jpg" width="60"/></td>
                    <td><?php echo $vehicle ?></td>
                    <td><?php echo $price?></td>
                    <td>
                        <input type="number" value="1" name="<?php echo $model ?>"  id="day-<?php echo $model?>" placeholder="days" />
                    </td>
                    <td> <a id="<?php echo $model ?>" style="text-decoration:none; background-color: dodgerblue" href="cart.php?delete=<?php echo $model?>" ><font style="font-weight: bold;color: white">Delete</font></a></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
    </div>

        <div id="processBtn">
            <input type="submit" value='Proceeding to checkout' style="border: none;background-color: dodgerblue; color: white;height: 50px">
        </div>
    </form>
</body>
</html>