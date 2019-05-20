
<?php
	global $_msg;
	if( is_array($_msg) )
	{
		?> <div class="msg <?= @$_msg['type'] ?>"><?= @$_msg['msg'] ?></div> <?php
	}
?>

<form name="f-login" method="post">

	<span class="main-header">Админ-панель</span>

	<input type="text" name="fl-login" placeholder="Логин или e-mail" required>
	<input type="password" name="fl-pass" placeholder="Пароль" required>

	<input type="submit" value="Войти">
</form>