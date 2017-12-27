<div class="table-responsive">
  <table id="departmant_index" class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Departman Adı</th>
        <th>Açıklama</th>
        <th>İşlemler</th>

      </tr>
    </thead>
    <tbody>
      <?php foreach($departments as $department){ ?>
      <tr>
        <td><?= $department->id ?></td>
        <td><?= $department->title ?></td>
        <td><?= $department->description ?></td>
        <td>
          <a href="<?= base_url('/departments/edit/' . $department->id) ?>" title="Düzenle"><i class="fa fa-edit"></i></a>
          <a href="<?= base_url('/departments/delete/' . $department->id) ?>" title="Sil"><i class="fa fa-trash"></i></a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
