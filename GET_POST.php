<!-- <?php

if ($_SERVER["REQUEST_METHOD"]=="PSOT"){
    $email = $_POST['email']; //hamne neechey form ma post method btaya ha tu islye yhan post ka global 
    //variable use kr rhe form ke samaan ku access krne ke lye
    $psw = $_POST['psw'];

    echo "Email is " . "$email";
    echo "Password is " . "$psw";
}

?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $email = $_POST['Email']; //hamne neechey form ma post method btaya ha tu islye yhan post ka global 
    //variable use kr rhe form ke samaan ku access krne ke lye
    $psw = $_POST['Psw']; //ye Psw ju slicing ma derha wu input tag ke name ma ha

    echo "Email is "  . $email . "<br>";
    echo "Password is " . $psw;
}

?>

<form action="/yt/GET_POST.php" method="POST">
<!-- //yhan action ma file ka path dya jispe post request ka smaan leke ana ha -->
<input  type="email" name="Email" id="email" placeholder="EMAIL" />
<input type="password" name="Psw" id="psw" placeholder="PASSWORD"/>
<input type="submit" name="Btn" />
</form>

</body>
</html>