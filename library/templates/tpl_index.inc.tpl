<div>
  <p> <h1 style="font-family: georgia;font-size:20px;font-weight:bold;color:	#2F4F4F"> Горбушка - це домашня випічка для всієї родини! </h1>
</p>
<p style="font-size:24px; color:#CD5C5C">Випікаємо більше 30 видів хліба і більше 1000 посмішок щодня!
</p>
<div  style="float: right; margin-right:370px;">

<img src="/images/gif1.gif"
style="width: 600px;	height: 400px; /* Размеры */
    background: #006400; /* Цвет фона */
    border: 5px solid #556B2F; /* Белая рамка */
    border-radius: 10px; /* Радиус скругления */>">
    </div>
<div style= "float: left">
  <?if(CUsers::Instance()->Can(7)):?>
  <if(!$id_user="1")>
  <p> <h1 align="center" style="font-size:16px;font-weight:bold; color:	#FF1493">Ви зайшли під іменем <p>"Головного директора"!</h1></p></p>
  <p>
   <img src="images/durekt.jpg" style="margin-left:10px;" width="270" height="370" alt="" />
  </p>
<?endif;?>
<?if(CUsers::Instance()->Can(0)):?>

    <p> <h1 align="center" style="font-size:16px;font-weight:bold; color:	#FFE4C4">Доброго дня, <p>шановний клієнте!</h1></p></p>
    <p>
     <img src="images/klient.png" style="margin-left:10px;border: 3px solid #FFE4C4;" width="270" height="330" alt="" />
    </p>
<?endif;?>
<?if(CUsers::Instance()->Can(5)):?>

    <p> <h1 align="center" style="font-size:16px;font-weight:bold; color:	#FFE4C4">Ви зайшли під іменем <p>"Головний менеджер"</h1></p></p>
    <p>
     <img src="images/men_zakaz.jpg" style="margin-left:10px;border: 3px solid #FFE4C4;" width="270" height="370" alt="" />
    </p>
<?endif;?>
<?if(CUsers::Instance()->Can(4)):?>

    <p> <h1 align="center" style="font-size:16px;font-weight:bold; color:	#FFE4C4">Ви зайшли під іменем <p>"Начальник відділу продажів"</h1></p></p>
    <p>
     <img src="images/men_prod.jpg" style="margin-left:10px;border: 3px solid #FFE4C4;" width="270" height="370" alt="" />
    </p>
<?endif;?>
<?if(CUsers::Instance()->Can(3)):?>

    <p> <h1 align="center" style="font-size:16px;font-weight:bold; color:	#FFE4C4">Ви зайшли під іменем <p>"Керівник транспортного відділу"</h1></p></p>
    <p>
     <img src="images/tansp.jpg" style="margin-left:10px;border: 3px solid #FFE4C4;" width="270" height="370" alt="" />
    </p>
<?endif;?>
<?if(CUsers::Instance()->Can(2)):?>

    <p> <h1 align="center" style="font-size:16px;font-weight:bold; color:	#FFE4C4">Ви зайшли під іменем <p>"Головний технолог"</h1></p></p>
    <p>
     <img src="images/tehn.jpg" style="margin-left:10px;border: 3px solid #FFE4C4;" width="300" height="350" alt="" />
    </p>
<?endif;?>
  </div>

</div>
