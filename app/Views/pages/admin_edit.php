<?php
use App\Kernel;

require Kernel::ViewsDir("header.php");
?>

<h1 class="display-1">Редактирование задачи</h1>
<div class="row">
	<div class="col-12">
		<form action="/admin/store/<?= $form_data["id"] ?>" method="post" class="row g-3">
			<div class="mb-3">
				<label for="userName" class="form-label">Имя</label>
				<input
						type="text"
						class="form-control <?= $errors["user_name"] ? 'is-invalid' : '' ?>" id="userName" placeholder="Alex"
						name="user_name" value="<?= $form_data["user_name"] ?>">
          <? if ($errors["user_name"]) : ?>
						<div class="invalid-feedback">
                <?= implode('<br/>', $errors["user_name"]) ?>
						</div>
          <? endif; ?>
			</div>
			<div class="mb-3">
				<label for="userEmail" class="form-label">Email</label>
				<input type="email" class="form-control <?= $errors["user_email"] ? 'is-invalid' : '' ?>" id="userEmail"
				       placeholder="name@example.com" name="user_email" value="<?= $form_data["user_email"] ?>">
          <? if ($errors["user_email"]) : ?>
						<div class="invalid-feedback">
                <?= implode('<br/>', $errors["user_email"]) ?>
						</div>
          <? endif; ?>
			</div>
			<div class="mb-3">
				<label for="taskContent" class="form-label">Задание</label>
				<textarea class="form-control <?= $errors["content"] ? 'is-invalid' : '' ?>" id="taskContent" rows="3"
				          name="content"><?= $form_data["content"] ?></textarea>
          <? if ($errors["content"]) : ?>
						<div class="invalid-feedback">
                <?= implode('<br/>', $errors["content"]) ?>
						</div>
          <? endif; ?>
			</div>
			<div class="mb-3">
				<label for="taskState" class="form-label">Состояние</label>
				<select id="taskState" name="state" class="form-control <?= $errors["state"] ? 'is-invalid' : '' ?>">
					<option value="false" <?= $form_data["state"] == false ? "selected" : "" ?>>В ожидании</option>
					<option value="true" <?= $form_data["state"] == true ? "selected" : "" ?>>Выполнен</option>
				</select>
          <? if ($errors["content"]) : ?>
						<div class="invalid-feedback">
                <?= implode('<br/>', $errors["state"]) ?>
						</div>
          <? endif; ?>
			</div>
			<div class="mb-3">
				<button type="submit" class="btn btn-primary">Сохранить</button>
				<a href="/" class="btn">Отмена</a>
			</div>
		</form>
	</div>
</div>

<?php require Kernel::ViewsDir("footer.php"); ?>
