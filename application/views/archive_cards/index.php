<div class="table-responsive">
  <table id="activity_index" class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Personel Adı</th>
        <th>Kart uid</th>
        <th>Oluşturulma Tarihi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($cards as $card){ ?>
      <tr>
        <td><?= $card->id ?></td>
        <td><?= $card->name . ' ' . $card->surname ?></td>
        <td><?= $card->card_uid ?></td>
        <td><?= $card->created_at ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
