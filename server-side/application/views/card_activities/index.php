
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
<div class="row">
  <div class="col-md-12">
    <input type="checkbox" id="actvity_all" name="mycheck" value="1"/>

    <button id="all_approve" href="<?=base_url('/card_activities/approve/')?>" class="btn btn-danger pull-right"><i class="fa fa-pencil"></i> onayla</button>

  </div>
</div>

<div class="table-responsive">
  <table id="card_activity_index" class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Personel Adi</th>
        <th>Tarih</th>
        <th>Saati</th>
        <th>Aktivite</th>
        <th>İşlemler</th>
      </tr>
    </thead>
    <tbody>
      <?php if(!empty($card_activity)){?>
      <?php foreach($card_activity as $card){  ?>
        <tr id="card-index-<?php echo $card->id ?>">
          <th>
            <?php if($card->approve==0){?>
            <input type="checkbox" id="def" class="secim" value="<?=$card->id?>">
          <?php } ?>
        </th>
          <td><?=$card->name." ".$card->surname?></td>
          <td><?=$card->created_at_date?></td>
          <td><?=$card->created_at_hour?></td>
          <td><?=$card->title?></td>
          <td>
            <?php if($card->approve==0){?>
            <a href="<?= base_url('/card_activities/edit/' .$card->id) ?>" title="Düzenle"><i class="fa fa-edit"></i></a>
            <a class="card_delete" href="<?= base_url('/card_activities/delete/' . $card->id) ?>" title="Silme"><i class="fa fa-trash"></i></a>

            <?php }?>
          </td>

        </tr>
        <?php } ?>
      <?php } ?>
    </tbody>
  </table>
</div>
