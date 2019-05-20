<?php global $_USER; ?>

<div id="user-plate">
	<img src="<?= @$_USER->avatar ?: _imaged('logo.png', "150xauto") ?>">
	<span><?= $_USER->name ?></span>
</div>

<nav>
	<ul>
		<li><a href="/"><i class="fa fa-globe" aria-hidden="true"></i>Сайт</a></li>
		<li><a href="/admin/"><i class="fa fa-home" aria-hidden="true"></i>Главная панель</a></li>
		<li><a href="/admin/ads/"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Объявления</a></li>
		<li><a href="/admin/users/"><i class="fa fa-users" aria-hidden="true"></i>Пользователи</a></li>
		<li><a href="/admin/settings/"><i class="fa fa-cogs" aria-hidden="true"></i>Настройки</a></li>
		<li><a href="/admin/logout/"><i class="fa fa-sign-out" aria-hidden="true"></i>Выйти</a></li>
	</ul>
</nav>