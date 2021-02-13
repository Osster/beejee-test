<?php
use App\Kernel;

require Kernel::ViewsDir("header.php");
?>

<h1 class="display-1">Регистрация</h1>
<div class="row">
	<div class="col-12">
		<form action="/register" method="post" class="row g-3">
			<div class="mb-3">
				<label for="userName" class="form-label">Имя</label>
				<input
						type="text"
						class="form-control <?= $errors["name"] ? 'is-invalid' : '' ?>" id="userName" placeholder="Alex"
						name="name" value="<?= $form_data["name"] ?>">
          <? if ($errors["name"]) : ?>
						<div class="invalid-feedback">
                <?= implode('<br/>', $errors["name"]) ?>
						</div>
          <? endif; ?>
			</div>
			<div class="mb-3">
				<label for="userEmail" class="form-label">Пароль</label>
				<input type="password" class="form-control <?= $errors["pass"] ? 'is-invalid' : '' ?>" id="userEmail"
				       placeholder="******" name="pass" value="<?= $form_data["pass"] ?>">
          <? if ($errors["pass"]) : ?>
						<div class="invalid-feedback">
                <?= implode('<br/>', $errors["pass"]) ?>
						</div>
          <? endif; ?>
			</div>
			<div class="mb-3">
				<label for="userEmail" class="form-label">Повторите пароль</label>
				<input type="password" class="form-control <?= $errors["confirm_pass"] ? 'is-invalid' : '' ?>" id="userEmail"
				       placeholder="******" name="confirm_pass" value="<?= $form_data["confirm_pass"] ?>">
          <? if ($errors["confirm_pass"]) : ?>
						<div class="invalid-feedback">
                <?= implode('<br/>', $errors["confirm_pass"]) ?>
						</div>
          <? endif; ?>
			</div>
			<div class="mb-3">
				<button type="submit" class="btn btn-primary">Регистрация</button>
				<a href="<?= Kernel::route("/login") ?>" class="btn">Войти</a>
			</div>
		</form>
	</div>
</div>

<?php require Kernel::ViewsDir("footer.php"); ?>
