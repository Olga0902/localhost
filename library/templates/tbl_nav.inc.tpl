<div class="menu_bar">
<ul class="menu">

	<li><a href="/">Головна</a>
	</li>
	<?if(CUsers::Instance()->Can(7)  || CUsers::Instance()->Can(0)|| CUsers::Instance()->Can(5) || CUsers::Instance()->Can(4)):?>
        <li><a href="product"> Асортимент продукції</a>
		<ul class="submenu" >
			<li><a href="product">Все</a></li>

			<?if(CUsers::Instance()->Can(7) || CUsers::Instance()->Can(5)):?>
			<li><a href="pro_oper">Добавити|Редагувати|Видалити</a></li>
				<?endif;?>
				<?if(CUsers::Instance()->Can(7)  || CUsers::Instance()->Can(0)|| CUsers::Instance()->Can(5) || CUsers::Instance()->Can(4)):?>
			<li><a href="graph_pro">Графік</a></li>
			<li><a href="kod">Пошук по штрих-коду</a></li>
			<?endif;?>

		</ul>
	</li>
	<?endif;?>
	<?if( CUsers::Instance()->Can(5) ||CUsers::Instance()->Can(4)):?>
	<li><a href="got_prod">Готова продукція</a>
		<ul class="submenu">
			<li><a href="got_prod">Все</a></li>
			<?if(CUsers::Instance()->Can(4)):?>
			<li><a href="pro_got_prod">Добавити/редагувати/видалити</a></li>
			<?endif;?>
			</ul>
	</li>
<?endif;?>
	<?if(CUsers::Instance()->Can(7)):?>
	<li><a href="users">Користувачі</a></li>
	<?endif;?>
		<?if(CUsers::Instance()->Can(7) || CUsers::Instance()->Can(5) || CUsers::Instance()->Can(3)  || CUsers::Instance()->Can(4)):?>
	<li><a href="klient">Клієнти</a>
		<?endif;?>
		<ul class="submenu">
			<li><a href="klient">Все</a></li>
			<?if(CUsers::Instance()->Can(7) || CUsers::Instance()->Can(5)):?>
			<li><a href="klient_oper">Добавити|Редагувати|Видалити</a></li>
			<?endif;?>
		</ul>
	</li>
	<?if(CUsers::Instance()->Can(7) || CUsers::Instance()->Can(5) ||CUsers::Instance()->Can(4)):?>
	<li><a href="nakladna">Накладні</a>
		<?endif;?>
		<ul class="submenu">
			<li><a href="nakladna">Все</a></li>
			<?if(CUsers::Instance()->Can(7) || CUsers::Instance()->Can(5)||CUsers::Instance()->Can(4)):?>
			<li><a href="nakladna_oper">Добавити|Редагувати|Видалити</a></li>
			<?endif;?>
			</ul>
	</li>
	<?if(CUsers::Instance()->Can(7) || CUsers::Instance()->Can(4)):?>
	<li><a href="video">Відеоспостереження</a></li>
	<?endif;?>
	<?if(CUsers::Instance()->Can(7) || CUsers::Instance()->Can(2)):?>
	<li><a href="wincc">SCADA</a></li>
	<?endif;?>
	<?if(CUsers::Instance()->Can(7) || CUsers::Instance()->Can(0)):?>
<li><a href="/">Клієнту</a>
	<ul class="submenu" >
		<li><a href ="pronas">Про нас </a>
			<li><a href ="spivprazya">Співпраця</a>
			<li><a href ="kontaktu">Контакти </a>
					<li><a href ="poradu">Поради</a>
	</ul>
<?endif;?>
<?if(CUsers::Instance()->Can(7) || CUsers::Instance()->Can(3)):?>
<li ><a href="avtopark">Авто-парк</a>
	<ul class="submenu">
		<li><a href="avtopark">Все</a></li>
		<li><a href="pro_avtopark">Редагувати</a></li>
		<li><a href="neobh_Vantazhopidjomnist">Підбір необх.авто</a></li>
		</ul>
	</li>
	<?endif;?>
	<?if(CUsers::Instance()->Can(3) || CUsers::Instance()->Can(7)):?>
		<li><a href="paluvo">Витрати палива</a>
		<ul class="submenu">
			<li><a href="paluvo">Все</a></li>
			<?if(CUsers::Instance()->Can(3)):?>
			<li><a href="pro_paluvo">Редагувати</a></li>
			<li><a href="zag_obsyag">Розрахувати заг.витрати</a></li>
			<?endif;?>
		</ul>
	</li>
		<?endif;?>
		<?if(CUsers::Instance()->Can(3) || CUsers::Instance()->Can(5) || CUsers::Instance()->Can(7)):?>
		<li><a href="dostavka">Доставка</a>
		<?endif;?>
		<ul class="submenu">
			<li><a href="dostavka">Все</a></li>
			<?if(CUsers::Instance()->Can(3)):?>
			<li><a href="pro_dostavka">Редагувати</a></li>
			<?endif;?>
		</ul>
</li>
	<li><a href="logout">Вихід</a></li>

</ul>
</div>
