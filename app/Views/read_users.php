<?= $this->extend('home') ?>
<?= $this->section('content') ?>
<?= $this->include('Templates/header') ?>

<table class="table table-striped table-hover table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Age</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>

    <?php foreach($users as $user) : ?>

    <tr>
      <td><?= $user->id ?></td>
      <td><?= $user->name ?></td>
      <td><?= $user->age ?></td>
      <td>
        <a href="<?= base_url('/users/'.$user->id.'/edit') ?>" class="btn btn-primary">Edit</a>
      </td>
      <td>
        <a class="btn btn-danger" onclick='if(confirm(`Do you want delete this record`)) { document.forms[`form_<?= $user->id ?>`].submit() }'>Delete</a>
      </td>
    </tr>

    <!-- DELETE Form -->
    <form action='/users/<?= $user->id ?>' method='post' name='form_<?= $user->id ?>' class="d-none">
      <?= csrf_field() ?>
      <input type='hidden' name='_method' value='DELETE' />
    </form>
      
    <?php endforeach ?>

  </tbody>
</table>

<?= $this->endSection() ?>