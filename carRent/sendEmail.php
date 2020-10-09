<?php
session_start();
$carArray = array();
if(isset($_SESSION['cars'])){
    $carArray = $_SESSION['cars'];
}

$to = $_POST['email'];
$subject = 'Hertz-UTS Online Receipts';
$headers = "From: Hertz-UTS Online". "\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message .= "<h4>Thanks for renting cars from Hertz-UTS, the total cost is ".$_SESSION['total']."</h4>"."<br>";
$message .= "<h4>Details are as follows</h4>"."<br>";
$message .= "<table>";

//use foreach to get all the info from the cart
foreach ($carArray as $model=> $detail) {
    $category = $detail["category"];
    $brand = $detail["brand"];
    $model = $detail["model"];
    $modelYear = $detail["modelYear"];
    $mileage = $detail["mileage"];
    $description = $detail["description"];
    $seats = $detail["seats"];
    $fuelType = $detail["fuelType"];
    $price = $detail["price"];
    $vehicle = $detail["vehicle"];
    $days = $detail['days'];
    $message .= "<table>";
    $message .="<tr><td>Model".$vehicle."<td><tr>"
        ."<tr><td>Mileage".$mileage."<td><tr>"
        ."<tr><td>Fuel_type".$fuelType."<td><tr>"
        ."<tr><td>Seats".$seats."<td><tr>"
        ."<tr><td>Price_per_dat".$price."<td><tr>"
        ."<tr><td>Rent_days".$days."<td><tr>"
        ."<tr><td>Description".$description."<td><tr>";
    $message .= "</table>";

}
$message .= "<h4>Thanks for your booking! Have a good trip !</h4>";

if(mail($to, $subject, $message, $headers)) {
    echo "Congratulations! All Done !";
    ?>
    <script type="text/javascript" src="javascript/jquery.js"></script>
    <div>
        <input type="button" onclick="window.parent.location='mainPage.php'" value="Back to the main page" style="background-color: dodgerblue; color: white">
    </div>
<?php
}
?>