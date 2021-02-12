<?php
use App\Kernel;

require Kernel::ViewsDir("header.php");
?>

<?
$links = [
    "id" => "?page={$items->currentPage()}&sort_col=id&" . ($sort[0] == "id" ? ($sort[1] != "ASC" ? "sort_dir=ASC" : "sort_dir=DESC") : "sort_dir={$sort[1]}"),
    "user_name" => "?page={$items->currentPage()}&sort_col=user_name&" . ($sort[0] == "user_name" ? ($sort[1] != "ASC" ? "sort_dir=ASC" : "sort_dir=DESC") : "sort_dir={$sort[1]}"),
    "user_email" => "?page={$items->currentPage()}&sort_col=user_email&" . ($sort[0] == "user_email" ? ($sort[1] != "ASC" ? "sort_dir=ASC" : "sort_dir=DESC") : "sort_dir={$sort[1]}"),
    "content" => "?page={$items->currentPage()}&sort_col=content&" . ($sort[0] == "content" ? ($sort[1] != "ASC" ? "sort_dir=ASC" : "sort_dir=DESC") : "sort_dir={$sort[1]}"),
    "state" => "?page={$items->currentPage()}&sort_col=state&" . ($sort[0] == "state" ? ($sort[1] != "ASC" ? "sort_dir=ASC" : "sort_dir=DESC") : "sort_dir={$sort[1]}"),
];
?>

<div class="row">
	<div class="col-6">
		<h1 class="display-1">Dispatch board</h1>
	</div>
	<div class="col-6 d-flex justify-content-end align-items-center">
		<a href="/create" class="btn btn-primary">Создать задачу</a>
	</div>
</div>

<div class="row">
	<table class="table">
		<thead>
		<tr>
			<th scope="col">
				<a href="<?= $links["id"] ?>">ID</a>
			</th>
			<th scope="col">
				<a href="<?= $links["user_name"] ?>">Name</a>
			</th>
			<th scope="col">
				<a href="<?= $links["user_email"] ?>">E-mail</a>
			</th>
			<th scope="col">
				<a href="<?= $links["content"] ?>">Content</a>
			</th>
			<th scope="col">
				<a href="<?= $links["state"] ?>">State</a>
			</th>
			<th scope="col"></th>
		</tr>
		</thead>
		<tbody>
    <? foreach ($items as $task): ?>
			<tr>
				<td scope="row"><?= $task->id ?></td>
				<td><?= $task->user_name ?></td>
				<td><?= $task->user_email ?></td>
				<td><?= $task->content ?></td>
				<td><?= $task->state ? "Done" : "Pending" ?></td>
				<td class="d-flex justify-content-end">
					<a href="/admin/edit/<?= $task->id ?>" class="btn btn-sm btn-warning">Edit</a>
					<a href="#" class="btn btn-sm btn-danger ms-2 btn-delete" data-id="<?= $task->id ?>">Delete</a>
				</td>
			</tr>
    <? endforeach; ?>
		</tbody>
	</table>
</div>
<div class="row">
	<div class="col-12">
      <? require Kernel::ViewsDir("paginator.php") ?>
	</div>
</div>

<form id="hidden-form" method="post"></form>

<script>
	(() => {
		const deleteBtn = document.querySelectorAll('.btn-delete');
		if (deleteBtn.length) {
			deleteBtn.forEach((btn) => {
				console.log('btn', btn);
				btn.addEventListener('click', (e) => {
					e.preventDefault();
					if (confirm("Удалить задачу?")) {
						const form = document.getElementById('hidden-form');
						form.setAttribute('action', `/admin/delete/${e.target.dataset["id"]}`);
						form.submit();
						form.setAttribute('action', ``);
					}
				});
			});
		}
	})();
</script>

<?php require Kernel::ViewsDir("footer.php"); ?>
