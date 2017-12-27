<div class="table-responsive">
  <table id="job_rotations_index" class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Vardiya Adı</th>
        <th>Giriş saati</th>
        <th>Çıkış saati</th>
        <th>İşlem</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($job_rotations as $job_rotations){ ?>
      <tr>
        <td><?= $job_rotations->id ?></td>
        <td><?= $job_rotations->title ?></td>
        <td><?= $job_rotations->start_time ?></td>
        <td><?= $job_rotations->finish_time ?></td>
        <td>
          <a href="<?= base_url('/job_rotations/edit/' . $job_rotations->id) ?>" title="Düzenle"><i class="fa fa-edit"></i></a>
          <a href="<?= base_url('/job_rotations/delete/' . $job_rotations->id) ?>" title="Sil"><i class="fa fa-trash"></i></a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
