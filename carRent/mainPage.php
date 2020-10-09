<?php
session_start();
$carArray = null;
if(!isset($_SESSION['cars'])){
    $carArray = array();
} else {
    $carArray = $_SESSION['cars'];
}

if(isset($_GET['model'])) {

    $id = $_GET['model'];
    $availability = $_GET['availability'];
    $detail = array("category"=>$_GET["category"],
        "availability"=>$_GET["availability"],
        "brand"=>$_GET["brand"],
        "model"=>$_GET["model"],
        "modelYear"=>$_GET["modelYear"],
        "mileage"=>$_GET["mileage"],
        "description"=>$_GET["description"],
        "seats"=>$_GET["seats"],
        "fuelType"=>$_GET["fuelType"],
        "price"=>$_GET["price"],
        "vehicle"=>$_GET['vehicle']);

    $carArray["$id"] = $detail;
    if ($availability == "Y") {
        $_SESSION['cars'] = $carArray;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hert-UTS Online</title>
    <script type="text/javascript" src="javascript/jquery.js"></script>
    <link rel="stylesheet" href="css/layout.css">
</head>
<body>

<!--header-->
<div id="header">
    <!--Hertz-UTS-->
    <div id="hertz">
        <h3><font color="#f4a460">Hertz-UTS</font></h3>
    </div>
    <!--Car Rental Center-->
    <div id="center">
        Car Rental Center
    </div>
    <!--Car Reservation, cart-->
    <form action="cart.php" id="cart">
        <input type="submit" value="Car Reservation" style="background-color: dodgerblue; border: none; color: white;">
    </form>
</div>

<script type="text/javascript" >

    //get from xml file
    let carList = [];
    $(document).ready(function(){
        let xmlHttp;
        if (window.XMLHttpRequest) {
            xmlHttp = new XMLHttpRequest();
        }
        else if (window.ActiveXObject)  {
            xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlHttp.open("GET", "cars.xml", true);
        xmlHttp.setRequestHeader('Content-Type', 'text/xml');
        xmlHttp.overrideMimeType('application/xml');
        xmlHttp.onreadystatechange = function() {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                let xmlDoc = xmlHttp.responseXML;
                let cars = xmlDoc.getElementsByTagName("car");

                for (let key in cars) {
                    let carNode = cars[key];
                    if (!carNode.getElementsByTagName){
                        continue
                    }

                    let id = carNode.getElementsByTagName("model")[0].childNodes[0].nodeValue;
                    let category = carNode.getElementsByTagName("category")[0].childNodes[0].nodeValue;
                    let availability = carNode.getElementsByTagName("availability")[0].childNodes[0].nodeValue;
                    let brand = carNode.getElementsByTagName("brand")[0].childNodes[0].nodeValue;
                    let model = carNode.getElementsByTagName("model")[0].childNodes[0].nodeValue;
                    let modelYear = carNode.getElementsByTagName("modelYear")[0].childNodes[0].nodeValue;
                    let mileage = carNode.getElementsByTagName("mileage")[0].childNodes[0].nodeValue;
                    let description = carNode.getElementsByTagName("description")[0].childNodes[0].nodeValue;
                    let seats = carNode.getElementsByTagName("seats")[0].childNodes[0].nodeValue;
                    let fuelType = carNode.getElementsByTagName("fuelType")[0].childNodes[0].nodeValue;
                    let price = carNode.getElementsByTagName("price")[0].childNodes[0].nodeValue;

                    let html = '<div id= "'+ id +'">\n' +
                        '    <table>\n' +
                        '        <tr>\n' +
                        '            <td><img src=\'images/'+ model+'.jpg\'></td>\n' +
                        '        </tr>\n' +
                        '        <tr>\n' +
                        '            <td style=\'font-size: 20px\'>'+ brand + '-' + model + '-' + modelYear + ' </td>\n' +
                        '        </tr>\n' +
                        '\n' +
                        '        <tr>\n' +
                        '            <td><br></td>\n' +
                        '        </tr>\n' +
                        '\n' +
                        '        <tr>\n' +
                        '            <td><font style=\'font-weight: bold\'>mileage: '+mileage+'</font></td>\n' +
                        '        </tr>\n' +
                        '\n' +
                        '        <tr>\n' +
                        '            <td><font style=\'font-weight: bold\'>fuel_type: '+fuelType+'</font></td>\n' +
                        '        </tr>\n' +
                        '\n' +
                        '        <tr>\n' +
                        '            <td><font style=\'font-weight: bold\'>seats: '+seats+'</font></td>\n' +
                        '        </tr>\n' +
                        '\n' +
                        '        <tr>\n' +
                        '            <td><font style=\'font-weight: bold\'>price_per_day: '+price+'</font></td>\n' +
                        '        </tr>\n' +
                        '\n' +
                        '        <tr>\n' +
                        '            <td><font style=\'font-weight: bold\'>availability: '+availability+'</font></td>\n' +
                        '        </tr>\n' +
                        '\n' +
                        '        <tr>\n' +
                        '            <td><br></td>\n' +
                        '        </tr>\n' +
                        '\n' +
                        '        <tr>\n' +
                        '            <td><font style=\'font-weight: bold\'>description: '+description+'</font></td>\n' +
                        '        </tr>\n' +
                        '\n' +
                        '        <tr>\n' +
                        '            <td><br></td>\n' +
                        '        </tr>\n' +
                        '\n' +
                        '        <tr>\n' +
                        '            <td>' +
                        '                    <form action="mainPage.php?id="'+ id +'" id="' + model + '" onsubmit="addToCart(this)" >\n' +
                        '                        <input type="hidden" name="category" value="'+ category +'">\n' +
                        '                        <input type="hidden" name="description" value="'+ description +'">\n' +
                        '                        <input type="hidden" name="seats" value="'+ seats +'">\n' +
                        '                        <input type="hidden" name="mileage" value="'+ mileage +'">\n' +
                        '                        <input type="hidden" name="modelYear" value="'+ modelYear +'">\n' +
                        '                        <input type="hidden" name="fuelType" value="'+ fuelType +'">\n' +
                        '                        <input type="hidden" name="availability" value="'+ availability +'" id="available-' + model + '">\n' +
                        '                        <input type="hidden" name="brand" value="'+ brand +'">\n' +
                        '                        <input type="hidden" name="model" value="'+ model +'">\n' +
                        '                        <input type="hidden" name="vehicle" value="' + brand + '-' + model + '-' + modelYear + '">\n' +
                        '                        <input type="hidden" name="price" value="' + price + '">\n' +
                        '                        <input type="submit" value="Add to Cart">\n' +
                        '                    </form>\n' +
                        '</td>\n' +
                        '        </tr>\n' +
                        '\n' +
                        '    </table>\n' +
                        '</div>';
                    $("#header").append(html);
                }

            }
        };
        xmlHttp.send();
        setInterval(updateAvailability, 1000)
    });

    //check the availability status
    function addToCart(eventSource) {
        let id = eventSource.id;
        let xmlHttp;
        if (window.XMLHttpRequest) {
            xmlHttp = new XMLHttpRequest();
            if(xmlHttp.overrideMimeType){
                xmlHttp.overrideMimeType("text/xml");
            }
        }
        else if (window.ActiveXObject)  {
            xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlHttp.open("GET", "cars.xml", true);
        xmlHttp.setRequestHeader('Content-Type', 'text/xml');
        xmlHttp.overrideMimeType('application/xml');
        xmlHttp.onreadystatechange = function() {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                let xmlDoc = xmlHttp.responseXML;
                let carNode = xmlDoc.getElementById(id);
                let availability = "Y";
                if(carNode){
                    availability = carNode.getElementsByTagName("availability")[0].childNodes[0].nodeValue;
                } else {
                    availability = document.getElementById("availability-"+id).innerHTML
                }

                if (availability==="N"){
                    alert("Sorry, the car is not available now. Please try other cars.");
                    $("#availability-"+id).html("N")
                    return false
                } else {
                    $("#availability-"+id).html("Y");
                    alert("Add to the cart successfully")
                }
            }
        };
        xmlHttp.send();
    }

    //update the availability status
    function updateAvailability() {
        let xmlHttp;
        if (window.XMLHttpRequest) {
            xmlHttp = new XMLHttpRequest();
        }
        else if (window.ActiveXObject)  {
            xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlHttp.open("GET", "cars.xml", true);
        xmlHttp.setRequestHeader('Content-Type', 'text/xml');
        xmlHttp.overrideMimeType('application/xml');
        xmlHttp.onreadystatechange = function() {
            if (xmlHttp.readyState === 4 && xmlHttp.status === 200) {
                let xmlDoc = xmlHttp.responseXML;
                let cars = xmlDoc.getElementsByTagName("car");
                for (let key in cars) {
                    let carNode = cars[key];
                    let id = carNode.id;
                    if(carNode.getElementsByTagName){
                        let availability = carNode.getElementsByTagName("availability")[0].childNodes[0].nodeValue;
                        $("#availability-"+id).html(availability)
                    }
                }
            }
        };
        xmlHttp.send();
    }
</script>
</body>
