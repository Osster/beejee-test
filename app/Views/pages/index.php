<?php
use App\Kernel;

require Kernel::ViewsDir("header.php");
?>

<?
$links = [
    "id" => "?sort_col=id&" . ($sort[0] == "id" ? ($sort[1] != "ASC" ? "sort_dir=ASC" : "sort_dir=DESC") : "sort_dir={$sort[1]}") . "&p={$items->currentPage()}",
    "user_name" => "?sort_col=user_name&" . ($sort[0] == "user_name" ? ($sort[1] != "ASC" ? "sort_dir=ASC" : "sort_dir=DESC") : "sort_dir={$sort[1]}") . "&p={$items->currentPage()}",
    "user_email" => "?sort_col=user_email&" . ($sort[0] == "user_email" ? ($sort[1] != "ASC" ? "sort_dir=ASC" : "sort_dir=DESC") : "sort_dir={$sort[1]}") . "&p={$items->currentPage()}",
    "content" => "?sort_col=content&" . ($sort[0] == "content" ? ($sort[1] != "ASC" ? "sort_dir=ASC" : "sort_dir=DESC") : "sort_dir={$sort[1]}") . "&p={$items->currentPage()}",
    "state" => "?sort_col=state&" . ($sort[0] == "state" ? ($sort[1] != "ASC" ? "sort_dir=ASC" : "sort_dir=DESC") : "sort_dir={$sort[1]}") . "&p={$items->currentPage()}",
];

?>

<div class="row">
	<div class="col-6">
		<h1 class="display-1">Task list</h1>
	</div>
	<div class="col-6 d-flex justify-content-end align-items-center">
		<a href="<?= Kernel::route("/create") ?>" class="btn btn-primary">Создать задачу</a>
	</div>
</div>

<? foreach ($messages as $message) :?>
	<div class="alert alert-primary" role="alert">
      <?= $message ?>
	</div>
<? endforeach; ?>

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

<?php require Kernel::ViewsDir("footer.php"); ?>
