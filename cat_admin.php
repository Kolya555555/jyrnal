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
    $_SESSION['username'] = 'Адміністратор';}

/* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
require_once 'config/connect.php';
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Перегляд замовлень</title>
</head>
<style>
/*Налаштовуємо меню*/
.menu-main {
  list-style: none;
  margin: 20px 0 5px;
  padding: 15px 0 5px;
  text-align: center;
  background: black;
  border-radius: 6px;
}
.menu-main li {display: inline-block;}
.menu-main li:after {
  content: "|";
  color: white;
  display: inline-block;
  vertical-align:top;
}
.menu-main li:last-child:after {content: none;}
.menu-main a {
  text-decoration: none;
  font-family: "cursive", serif;
  letter-spacing: 2px;
  position: relative;
  padding-bottom: 20px;
  margin: 0 34px 0 30px;
  font-size: 17px;
  text-transform: uppercase;
  display: inline-block;
  transition: color .2s;
}
.menu-main a, .menu-main a:visited {color: white;}
.menu-main a.current, .menu-main a:hover{color: red;}
.menu-main a:before,
.menu-main a:after {
  content: "";
  position: absolute;
  height: 4px;
  top: auto;
  right: 50%;
  bottom: +8px;
  left: 50%;
  background: red;
  transition: .8s;
}
.menu-main a:hover:before, .menu-main .current:before {left: 0;}
.menu-main a:hover:after, .menu-main .current:after {right: 0;}
@media (max-width: 550px) {
.menu-main {padding-top: 0;}
.menu-main li {display: block;}
.menu-main li:after {content: none;}
.menu-main a {
  padding: 25px 0 20px;
  margin: 0 30px;
}
}
body { background: url(img/fonn.jpg); }

/*клас для логотипу сайту - зображення*/
.product_img{
    height: avto;
    width: 50px;}

/*клас для логотипу сайту - текст*/
.product_text{
    font-size: 33px;
    font-family: 'cursive';}

/*Кнопка №1*/
.btn-buy{
    background: black;
    color: white;
    font-size: 15px;
    padding: 0 30px;
    height: 40px;
    outline: none; /*Універсальна властивість, що одночасно встановлює колір, стиль та товщину зовнішньої межі на всіх чотирьох сторонах елемента*/
    border-radius: 7px;
    cursor: pointer; /*Встановлює форму курсора*/}

/*Кнопка №2*/
.btn-buyr{
    background: black;
    color: white;
    font-size: 15px;
    height: 20px;
    width: 170px;
    border-radius: 10px;}

/*Оформлення поля*/
.pole3{
    width: 150px;
    background: white;
    height: 50px;
    border-radius: 5px;
    overflow: auto; /*Смуги прокручування додаються лише за потреби*/
    width:auto;}

/*Розміщення*/
.center{
    font-family: 'Arial';
    width: 50%;
    font-size: 16px;
    margin-left: 10%;} /*Встановлює величину відступу лівого краю елемента*/
.topNubex {
    position: fixed;
    right: 15px;
    bottom: 15px;
    background: yellow ;
    color:  black;
    text-decoration-color: blue;
    font-size: 18pt;
    border: 2px solid; /*границі вікна*/
    border-radius: 5px;
    padding: 0 30px;
    <?php $img+5;?>
   }
.topNubexq {
    position: fixed;
    right: 15px;
    bottom: 50px;
    background: yellow ;
    color:  black;
    text-decoration-color: blue;
    font-size: 18pt;
    border: 2px solid; /*границі вікна*/
    border-radius: 5px;
    padding: 0 30px;}

/*Налаштування таблички*/
    th, td {padding: 5px;
    border-radius: 6px;}

    th {background: black;
        color: #fff;}

    td { background: wheat}

img{
    width: <?=$img?>px;
}
</style>


<body>
     <!-- Виведення шапки сайту -->
     <p class='product_text' align="center" ><img  class = "product_img" src='img/111.png' >Мій Миколай</p>
    <p class="ap_text">Ви ввійшли як <b>"<?php echo $username; ?>"</b>  <a href="open.php">Вихід</a></p>
<ul class="menu-main">
             <li><a href="admin.php" >Головна</a></li>
            <li><a href="search.php">Пошук товару</a></li>
            <li><a href="cat_admin.php" class="current">Робота</a></li>
            <li><a href="cat_zakaz.php">Обговорены замовлення</a></li><li><a href="cat_zakaz_d.php">Заявки на дзвінок</a></li>
</ul>
<a href="#" class="topNubexq">Вверх</a>
<a href="#top" class="topNubex">Внизи </a>
<!-- Виведення головного вмісту сторінки -->

<h2 align="center">Замовлення</h2>
        <?php
        /*Делаем выборку строк і преобразовывем полученные данные в нормальный массив*/
        $zakaz = mysqli_query($connect, "SELECT * FROM `zakaz`");
        $zakaz = mysqli_fetch_all($zakaz);
        $user = $_POST['user'];
        if ($_POST['user'] != ''){
        $_SESSION['username'] =  "$user";}
        if($zakaz != null){
            ?>
    <!-- Виведення наявниз замовлень -->
    <div align="center">

    <table>
        <tr>
            <th>№</th>
           <th>Логін</th>
           <th>Телефон</th>
            <th>Дата</th>
            <th>Сума</th>
            <th>Деталі</th>
            <th>Нові Відомості</th>

        </tr>
            <?Php
            foreach ($zakaz as $zakaz) {
                ?>
                    <tr>
                        <td><?= $zakaz[0] ?></td>
                        <td><?= $zakaz[1] ?></td>
                        <td><?= $zakaz[4] ?></td>
                        <td><?= $zakaz[5] ?></td>
                        <td><?= $zakaz[6] ?> грн</td>
                        <td><div style="overflow: auto; width:100px; height:auto;"><?= $zakaz[7] ?></div></td>
                        <td>
                            <form action="vendor/settings_detali.php" method="post">
                                <input type="hidden" name="id" value="<?= $zakaz[0] ?>">
                                <textarea name="detali" class="pole3" placeholder="Вказувати при потребі"></textarea><br>
                                <button class="btn-buyr" type="submit">ОК</button>
                             </form>
                       </td>
                        <td>
                            <form action="" method="post">
                                 <input type="hidden" name="user" value="<?= $zakaz[1] ?>">
                                  <button class="btn-buy" type="submit">Авторизація</button>
                             </form>
                        </td>
                        <td><button class="btn-buy"><a style="color: red;" href="vendor/delete_zakaz.php?id=<?= $zakaz[0] ?>">Видалити</a></button></td>
                            <td><form action="vendor/ok_zakaz.php" method="post">
                                    <input type="hidden" name="FIO" value="<?= $zakaz[2] ?>">
                                    <input type="hidden" name="E-mail" value="<?= $zakaz[3] ?>">
                                    <input type="hidden" name="phone" value="<?= $zakaz[4] ?>">
                                    <input type="hidden" name="text" value="<?= $zakaz[5] ?>">
                                    <input type="hidden" name="suma" value="<?= $zakaz[6] ?>">
                                    <input type="hidden" name="detali" value="<?= $zakaz[7] ?>">
                                    <button class="btn-buy"  type="submit">Обговорено</a>
                            </form>  </td>
                            <td><form action="cat_print.php" method="post">
                                    <input type="hidden" name="Id" value="<?= $zakaz[0] ?>">
                                    <input type="hidden" name="FIO" value="<?= $zakaz[2] ?>">
                                    <input type="hidden" name="E-mail" value="<?= $zakaz[3] ?>">
                                    <input type="hidden" name="phone" value="<?= $zakaz[4] ?>">
                                    <input type="hidden" name="detali" value="<?= $zakaz[7] ?>">
                                    <button class="btn-buy"  type="submit">Друк</a>
                            </form>  </td>


                   </tr>

                <?php
            }}
        else { ?> <h2 class="product_text" align="center">Замовлення відсутні</h2> <?php }
      ?>
</table></div>
<div class="center">
<?Php if($zakaz != null){ ?>
    <br><a href="cat.php"><button class="btn-buy" type="submit">Корзина користувача</button></a><br><br>
    <a href="catalog.php"><button class="btn-buy" type="submit">Добавити товар</button></a><br><br>
<?Php } ?>
    <a href="open.php"><button class="btn-buy" type="submit" >Створити нове замовлення</button></a>
</div></div>
</body>
</html>
