<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/template/css/style.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <title>Welcome</title>
</head>
<body>
<div class="login-page">
    <div class="form">
        <form class="register-form" method="post">

            <?php if(isset($errors) && is_array($errors)): ?>
            <ul>
                <?php foreach ($errors as $error):?>
                <li>- <?= $error ?> </li>
                <?php endforeach;?>
            </ul>
            <?php endif; ?>
            <input type="text" name="name" placeholder="name" value="<?php if(isset($name)) echo $name ?>"/>
            <input type="password" name="password" placeholder="password" value="<?php if(isset($password)) echo $password ?>"/>
            <input type="password" name="confirmPassword" placeholder="confirm password"/>
            <input type="text" name="email" placeholder="email address" value="<?php if(isset($email)) echo $email ?>"/>
            <input type="text" name="adress" placeholder="your address" value="<?php if(isset($adress)) echo $adress ?>"/>
            <input type="text" name="phoneNumber" placeholder="phone number" value="<?php if(isset($phoneNumber)) echo $phoneNumber ?>"/>
            <div class="block-sex">
                <input type="radio" name="radioButton" id="male" value="male">
                <label for="male">Male</label>
                <input type="radio" name="radioButton" id="female" value="female">
                <label for="female">Female</label>
            </div>
            <div class="confirm-block">
                <input class="check" type="checkbox" name="accept"> Accept confirmation
            </div>
            <button class="btn" name="regButt" disabled>create</button>
            <p class="message">Already registered? <a href="#">Sign In</a></p>
        </form>
        
        
        
        <form class="login-form" method="post">

            <?php if(isset($loginErrors) && is_array($loginErrors)): ?>
                <ul>
                    <?php foreach ($loginErrors as $error):?>
                        <li name="errorMessage">- <?= $error ?> </li>
                    <?php endforeach;?>
                </ul>
            <?php endif; ?>

            <input type="text" placeholder="email" name="loginEmail"/>
            <input type="password" placeholder="password" name="loginPassword"/>
            <button name="loginButton">login</button>
            <p class="message">Not registered? <a href="#" id = "regLink">Create an account</a></p>
        </form>
        
        
        
    </div>
</div>
<script src="/template/js/script.js"></script>
</body>
</html>


