<?php global $_ADM_ROLES; ?>

<section id="home-page">
	<span class="main-header">Пользователи</span>

	<div id="adm-users" class="table">
		
		<div class="thead">
			<span class="td"> <input type="checkbox"> </span>
			<span class="td"> <span>Никнейм</span> </span>
			<span class="td"> <span>Имя</span> </span>
			<span class="td"> <span>Email</span> </span>
			<span class="td"> <span>Роль</span> </span>
		</div>

		<div class="tbody">
			<?php foreach( $mydb->get("SELECT * FROM sudoers") as $user ): ?>
				<div class="tr" data-ajax="<?= _escape_json(array( 'user' => $user['id'] )) ?>">
					<div class="td"> <input type="checkbox" name="sel_users[]" value="<?= $user['id'] ?>"> </div>
					<div class="td">
						<span><?= $user['login'] ?></span>
						<div class="toolbar">
							<a href="/admin/users/<?= $user['id'] ?>/edit/" class="btn edit">Редактировать</a>
							<a
								class="btn red ajax-action confirm"
								data-action="user.remove"
								data-success="hide"
								data-confirm="Вы действительно хотите удалить этого пользователя?"
							>Удалить</a>
						</div>
					</div>
					<div class="td"><?= $user['name'] ?></div>
					<div class="td"><?= $user['email'] ?></div>
					<div class="td"><?= @$_ADM_ROLES[ $user['role'] ] ?></div>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>