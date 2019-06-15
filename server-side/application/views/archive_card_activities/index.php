
<div class="form-group">
  <?= form_open(current_url()) ?>
  <div class="row">
    <div class="col-md-6"><label>Tarih</label><input type="date" name="date_input_1" class="form-control" value=<?=$now?> ></div>
    <div class="col-md-6"><label>Tarih</label><input type="date" name="date_input_2" class="form-control" value=<?=$now2?> ></div>
     <div class="col-md-6"><label>İsim</label><?= form_dropdown("cards", $options, $selected, 'class="form-control"') ?></div>
      <div class="col-md-6"><br> <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> ARAMA YAP</button>
      </div>
  </div>
  <?= form_close() ?>
</div>


<div class="table-responsive">
  <table id="card_activity_index" class="table table-hover">
    <thead>
      <tr>
        
        <th>Personel Adi</th>
        <th>Tarih</th>
        <th>Saati</th>
        <th>Aktivite</th>

      </tr>
    </thead>
    <tbody>
      <?php if(!empty($card_activity)){?>
      <?php foreach($card_activity as $card){  ?>
        <tr id="card-index-<?php echo $card->id ?>">
          <td><?=$card->name." ".$card->surname?></td>
          <td><?=$card->created_at_date?></td>
          <td><?=$card->created_at_hour?></td>
          <td><?=$card->title?></td>
        </tr>
        <?php } ?>
      <?php } ?>
    </tbody>
  </table>
</div>
