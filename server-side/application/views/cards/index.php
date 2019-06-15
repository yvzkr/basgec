<div class="table-responsive">
  <table id="activity_index" class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Personel Adı</th>
        <th>Kart uid</th>
        <th>Oluşturulma Tarihi</th>
        <th>İşlemler</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($card as $card){ ?>
      <tr>
        <td><?= $card->id ?></td>
        <td><?= $card->name . ' ' . $card->surname ?></td>
        <td><?= $card->card_uid ?></td>
        <td><?= $card->created_at ?></td>
        <td>
          <a href="<?= base_url('/cards/edit/' . $card->id) ?>" title="Düzenle"><i class="fa fa-edit"></i></a>
          <a href="<?= base_url('/cards/delete/' . $card->id) ?>" title="Sil"><i class="fa fa-trash"></i></a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
