<div class="table-responsive">
  <table id="job_rotations_index" class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Personel Adı</th>
        <th>Personel Soyadı</th>
        <th>Departman</th>
        <th>Tc</th>
        <th>Vardiya</th>
        <th>İşlem</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($personels as $personels){ ?>
      <tr>
        <td>  <?= $personels->id ?>                </td>
        <td>  <?= $personels->name ?>              </td>
        <td>  <?= $personels->surname ?>           </td>
        <td>  <?= $personels->title ?>             </td>
        <td>  <?= $personels->tc_no ?>             </td>
        <td>  <?= $personels->job_rotations ?>     </td>
        <td>
          <a href="<?= base_url('/personels/edit/' . $personels->id) ?>" title="Düzenle"><i class="fa fa-edit"></i></a>
          <a href="<?= base_url('/personels/delete/' . $personels->id) ?>" title="Sil"><i class="fa fa-trash"></i></a>
          <a href="<?= base_url('/personels/archive/' . $personels->id) ?>" title="Archive"><i class="fa fa-archive"></i></a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
