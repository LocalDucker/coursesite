<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/template/css/style.css" type="text/css">

    <title>Document</title>
</head>
<body>
<body>
<div class="login-page">
    <div class="form mainPage">
        <ul class="list">
        <?php foreach ($user as $key => $value):?>
           <li> <?php echo $key . ":" . '<br>' . $value . '<br>';?> </li>
        <?php endforeach;?>
        </ul>
        <a href="/logout"><button class="buttMain" type="submit">Logout</button></a>
        <a href="/deleteAccount"><button class="buttMain" type="submit">Delete</button></a>

    </div>

</div>

</body>
</html>