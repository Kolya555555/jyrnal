<?php
//Точка входу
session_start();

//Якщо в процесі сесії імя користувача не встановлено, пробуємо його азяти з кук
if(!isset($_SESSION['username']) && isset($_COOKIE['username']))
$_SESSION['username'] = $_COOKIE['username'];

//Ще раз шукаємо користувача в сесії
$username = $_SESSION['username'];

//Не авторизованих користувачів підписувати як гість
if ($username == Null) {
    $_SESSION['username'] = 'Гість';}
?>

<!doctype html>
<html lang="en">
<head>
    <style media="print" type='text/css'>
    #navbar-iframe {display: none; height: 0px; visibility: hidden;}
    .noprint{display: none;}
    body{background: #FFF; color: #000;}
    a {text-decoration: underline; color: #00F;}
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Печать</title>
</head>
<style>
body {  background: url(img/fonn.jpg);}
/*Зображення товару*/
.product{
    height: 150px;
    width: 150px;}

/*Поле для введення кількості товару*/
.pole{
    width: 35px;
    background: wheat;
    height: 20px;
    border-radius: 7px;}

/*Оформлення тексту*/
.text{
    color: #000;
    font-size: 16px;
    font-family: cursive;
    width: 100px;}

/*Оформлення тексту*/
.textt{
    color: #000;
    font-size: 18px;
    font-family: cursive;
    width: 300px;}

/*клас для логотипу сайту - зображення*/
.product_img{
    height: avto;
    width: 50px;}

/*клас для логотипу сайту - текст*/
.product_text{
     font-size: 33px;
    font-family: 'cursive';
     color: black;}

/*Кнопка*/
.btn-buy{
    background: black;
    color: white;
    font-size: 15px;
    padding: 0 30px;
    height: 40px;
    outline: none; /*Універсальна властивість, що одночасно встановлює колір, стиль та товщину зовнішньої межі на всіх чотирьох сторонах елемента*/
    border-radius: 7px;
    cursor: pointer; /*Встановлює форму курсора*/}

/*для "наших даних"*/
.ap_text{
     font-size: 23px;
     padding: 0 20px;
     color:  black;}
</style>
<?Php
$fio = $_POST['FIO'];
$email = $_POST['E-mail'];
$phone = $_POST['phone'];
$detali = $_POST['detali'];
$id = $_POST['Id'];
?>

<body>
    <!-- Виведення шапки сайту -->
    <p class='product_text' align="center" ><img  class = "product_img" src='img/111.png' >Мій Миколай - до нас завітай</p>
    <!-- Виведення головного вмісту сторінки -->
    <div align="center"><div align="left" style="visible: auto; width:800px;height:avto;">
        <h2>"Дані замовника"</h2>
    <h3>Замовлення користувача "<b><?php echo $username; ?></b>"<br>
        ФІО: <?Php echo $fio; ?><br>
        E-mail: <?Php echo $email; ?><br>
        Телефон: <?Php echo $phone; ?></h3></div>

    <div align="right" style="visible: auto; width:800px;height:avto;">
        <h2>"Дані відправника"</h2>
        <h3>Телефон: MTS +38 099-24-31-028<br>
        Instagram: miymukolay<br>
        TikTok: miymukolay.com.ua<br>
        E-mail: miymukolay@gmail.com</h3></div></div>

<br><h2 align="center">Замовлення № 000<?= $id ?></h2>
    <table align="center" >
        <?php
    require_once 'config/connect.php';
    $orderr = mysqli_query($connect, "SELECT * FROM `orderr` WHERE `user` = '$username'");
    $orderr = mysqli_fetch_all($orderr);
    $a = '0'; $b = '0'?>
            <tr>
            <th>Зображення</th>
            <th>Назва</th>
            <th>Артикул</th>
            <th>Ціна</th>
            <th>Кількість</th>
            <th>Сума</th>
                </tr>
                  <?php
                foreach ($orderr as $orderr) {

                ?>
                    <tr>
                       <?php  $a = $a + ($orderr[3]*$orderr[4]);
                       $b =  ($orderr[3]*$orderr[4]); ?>
                    </tr>
                    <tr align = "center">
                        <td><img class = "product" src='vendor/tovar/<?= $orderr[5] ?>'></td>
                        <td class = "textt"><?= $orderr[1] ?></td>
                        <td class = "text"><?= $orderr[2] ?></td>
                        <td class = "text"><?= $orderr[3] ?> грн</td>
                        <td class = "text"><?= $orderr[4] ?></td>
                        <!-- Виведення суми по кожній позиції ціна * кількість -->
                        <td class = "text"><?= $b?> грн</td>
                <?php
            }
        ?>
    </table>
<h3 align="center"> Всього: <?php echo $a ?> грн <br><br> Підпис__________</h3>
<span class="noprint"><div align="center"><button class="btn-buy" type="submit" onclick="print()">Друк </button></div></span>
</body>
</html>
