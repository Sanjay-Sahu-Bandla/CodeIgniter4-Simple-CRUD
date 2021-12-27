<?= $this->extend('home') ?>
<?= $this->section('content') ?>

<form action="/users" method="post">

	<h3>Create New User</h3><br>

	<div class="mb-3 row col-6">
		<?php csrf_field()  ?>
		<label class="form-label">Name</label>
		<input type="text" class="form-control" name="name" required>
	</div>
	<div class="mb-3 row col-6">
		<label class="form-label">Age</label>
		<input type="number" class="form-control"name="age" required>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>

</form>

<?= $this->endSection() ?>