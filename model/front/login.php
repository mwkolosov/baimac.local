<section id="login-box" class="container">
	<div class="row login-box-wrap">
		<div class="col-12 col-md-6">
			<div class="login-box-border">
				<ul class="nav nav-login">
					<li class="active"><a data-toggle="tab" class="active" href="#box-sign-in">Вход</a></li>
					<li><a data-toggle="tab" href="#box-sign-up">Регистрация</a></li>
				</ul>
				<div class="tab-content flex">

					<div id="box-sign-in" class="tab-pane fade in active show flex flex-column box-sign">
						<p class="lite p-box-sign-in">Ты можешь авторизоваться на нашем сайте, введя свой e-mail и пароль или же, войти с помощью социальной сети.</p>
						<input type="text" name="signin[email]" placeholder="Укажи свой e-mail">
						<input type="password" name="signin[password]" placeholder="Введи пароль">
						<input type="submit" name="signin[submit]" value="Войти" class="btn btn-main">
						<a href="#" class="fb-login">Войти через Facebook</a>
						<a data-fancybox data-src="#fancy-restore" href="javascript:;" class="a-box-sign-in">Забыли пароль?</a>

                        <div style="display: none;" id="fancy-restore">
                            <h2>Проблемы со входом? :(</h2>
                            <p>Укажи свой email, после чего, ты получишь письмо со ссылкой, для восстановления пароля.</p>
                            <div class="restore-modal flex">
                                <input type="text" name="restorepass[email]" placeholder="Укажи свой e-mail">
                                <input type="submit" name="restore[submit]" value="Отправить" class="btn btn-main">
                            </div>
                        </div>
					</div>

					<div id="box-sign-up" class="tab-pane fade flex flex-column box-sign">
						<p class="lite p-box-sign-in">Регистрируйся на нашем сайте, чтобы продавать и покупать товар. Введи свой актуальный email и придумай пароль.</p>
						<input type="text" name="signup[email]" placeholder="Укажи свой e-mail">
						<input type="password" name="signup[password]" placeholder="Введи пароль">
						<input type="password" name="signup[password-confirm]" placeholder="Подтверди свой пароль">
						<input type="checkbox" name="confirm-privacy-policy" id="privacy-policy" class="checkbox">
						<label for="privacy-policy">Регистрируясь у нас на сайте, Вы принимаете <a href="#">политику конфиденциальности.</a></label>
						<input type="submit" name="signup[submit]" value="Регистрация" class="btn submit-signup btn-main">
						<a href="#" class="fb-login">Регистрация через Facebook</a>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>

