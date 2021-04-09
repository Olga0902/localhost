<?if($message != null):?>
<div class="message-error"><p><strong><?=$message?></strong></p></div>
<?endif;?>
<script type="text/javascript">
	function CheckError()
	{
		if(document.FormLogin.username.value == ""){ alert("Вы не указали Логин!!!"); document.FormLogin.username.focus(); return(false); }
		if(document.FormLogin.password.value == ""){ alert("Вы не указали Пароль!!!"); document.FormLogin.password.focus(); return(false); }
		return(true);
	}
</script>
<form style="padding-top:20px;margin:0 auto;border-radius:5px;width:300px;border:1px solid#e3e3e3;background-color:#f5f5f5" method="post" name="FormLogin" action="login" onsubmit="return CheckError()">
<p style="margin:10px"><label>Логин</label>&nbsp;<input id="username" name="login" value="" placeholder="Введите логин" title="Логин пользователя" class="inpute required" tabindex="1" type="text"></p>
<p><label>Пароль</label>&nbsp;<input id="password" name="password" value="" placeholder="Введите пароль" title="Пароль пользователя" class="inpute required" tabindex="2" type="password"></p>
<p style="margin:10px"><input class="btn" value="Вход" tabindex="3" type="submit"></p>
</form>

