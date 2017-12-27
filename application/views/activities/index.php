<div class="table-responsive">
  <table id="activity_index" class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Activite Adı</th>
        <th>İşlemler</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($activity as $activity){ ?>
      <tr>
        <td><?= $activity->id ?></td>
        <td><?= $activity->title ?></td>
        <td>
          <?php if($activity->need_approve!=1){ ?>
          <a href="<?= base_url('/activities/edit/' . $activity->id) ?>" title="Düzenle"><i class="fa fa-edit"></i></a>
          <a href="<?= base_url('/activities/delete/' . $activity->id) ?>" title="Sil"><i class="fa fa-trash"></i></a>
          <?php } ?>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
