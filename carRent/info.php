<?php
session_start();
$carArray = array();
$total = 0;
if(isset($_SESSION['cars']))
{
    $carArray = $_SESSION['cars'];
}

foreach ($carArray as $model=>$detail)
{
    if (isset($_REQUEST["$model"]))
    {
        $days = $_REQUEST["$model"];
        $detail['days'] = $days;
        $price = (float)$days * $detail["price"];
        $total += $price;
        $_SESSION['total'] = $total;
        $carArray["$model"]["days"] = $days;
        $_SESSION['cars'] = $carArray;
    }
}

foreach ($carArray as $model=>$detail)
{
    $category = $detail["category"];
    $brand = $detail["brand"];
    $model = $detail["model"];
    $modelYear = $detail["modelYear"];
    $mileage = $detail["mileage"];
    $fuelType = $detail["fuelType"];
    $seats = $detail["seats"];
    $description = $detail["description"];
    $price = $detail["price"];
    $days = $detail["days"];
}

$_SESSION['cars'] = array();
?>
<script type="text/javascript">
    /*check the validation */
    function checkText()
    {
        if (document.getElementById("firstName").value == "")
        {
            alert("Please fill FirstName");
            return false;
        }
        if (document.getElementById("lastName").value == "")
        {
            alert("Please fill LastName");
            return false;
        }
        if (document.getElementById("address1").value == "")
        {
            alert("Please fill Address1");
            return false;
        }
        if (document.getElementById("address2").value == "")
        {
            alert("Please fill Address2");
            return false;
        }
        if (document.getElementById("city").value == "")
        {
            alert("Please fill City");
            return false;
        }
        if (document.getElementById("state").value == "")
        {
            alert("Please fill State");
            return false;
        }
        if (document.getElementById("paymentType").value == "")
        {
            alert("Please fill Payment Type");
            return false;
        }
        var numbers = /[^\d\.]/g;
        if(numbers.test(document.getElementById("postCode").value) || document.getElementById("postCode").value == "")
        {
            alert("Please fill postCode and Only numbers are allowed");
            return false;
        }
        var emails = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        if(!emails.test(document.getElementById("email").value) || document.getElementById("email").value == "")
        {
            alert("Please enter a valid Email");
            return false;
        }
        return true;
    }

</script>
<link rel="stylesheet" href="css/layout.css" type="text/css">
<script type="text/javascript" src="javascript/jquery.js"></script>
<div id="header">
    <div id="center">
        Car Rental Center
    </div>
</div>
<h3>Customer Details and Payments</h3>
<p>Please fill in your details.<span style="color: red">*</span> indicates required field.</p>

<!--info table-->
<form action="sendEmail.php" method="post" name="infoForm" onsubmit="return checkText()">
    <table id="infoTable">
        <tr>
            <td>First Name <span style="color: #FF0000">*</span></td>
            <td><input type="text" name="firstName" id="firstName" size="50"></td>
        </tr>
        <tr>
            <td>Last Name <span style="color: #FF0000">*</span></td>
            <td><input type="text" name="lastName" id="lastName" size="50"></td>
        </tr>
        <tr>
            <td>Email address<span style="color: #FF0000">*</span></td>
            <td><input type="text" name="email" id="email" size="50"></td>
        </tr>
        <tr>
            <td>Address line 1<span style="color: #FF0000">*</span></td>
            <td><input type="text" name="address1" id="address1" size="50"></td>
        </tr>
        <tr>
            <td>Address line 2<span style="color: #FF0000">*</span></td>
            <td><input type="text" name="address2" id="address2" size="50"></td>
        </tr>
        <tr>
            <td>City<span style="color: #FF0000">*</span></td>
            <td><input type="text" name="city" id="city" size="50"></td>
        </tr>
        <!--State-->
        <tr>
            <td>State<span style="color: #FF0000">*</span></td>
            <td><select name="state" id="state">
                    <option value="" selected = "selected">- please select -</option>
                    <option value="NSW" id="NSW">NSW</option>
                    <option value="QLD" id="QLD">QLD</option>
                    <option value="SA" id="Algeria">SA</option>
                    <option value="TAS" id="TAS">TAS</option>
                    <option value="VIC" id="VIC">VIC</option>
                    <option value="WA" id="WA">WA</option>
                    <option value="ACT" id="ACT">ACT</option>
                    <option value="NT" id="NT">NT</option>
                </select></td>
        </tr>
        <tr>
            <td>Post Code<span style="color: #FF0000">*</span></td>
            <td><input type="text" name="postCode" id="postCode" size="50"></td>
        </tr>
        <tr>
            <td>Payment Type<span style="color: #FF0000">*</span></td>
            <td><select name="paymentType" id="paymentType">
                    <option value="" selected = "selected">- please select -</option>
                    <option value="MasterCard" id="MasterCard">Master Card</option>
                    <option value="VISA" id="VISA">VISA</option>
                    <option value="AmericanExpress" id="AmericanExpress">American Express</option>
                    <option value="Alipay" id="Alipay">Alipay</option>
                </select></td>
        </tr>
    </table>
    <div>
        <h3>You are required to pay $<?php echo $total ?></h3>
        <input type="button" onclick="window.parent.location='mainPage.php'" value="Continue Selection" style="background-color: dodgerblue; color: white">
        <input type="submit" value="Booking" style="background-color: dodgerblue; color: white">
    </div>
</form>
