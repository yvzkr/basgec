<div class="form-group">
  <?= form_open(current_url()) ?>
  <div class="row">
    <div class="col-md-6"><label>Tarih</label><input type="date" name="date_input_1" value=<?=$now?> class="form-control"  ></div>
    <div class="col-md-6"><label>Tarih</label><input type="date" name="date_input_2" class="form-control" value=<?=$now2?> ></div>
     <div class="col-md-6"><label>İsim</label><?= form_dropdown("personels", $options,$selected, 'class="form-control"') ?></div>
       <div class="col-md-6"><br><input type="submit" class="btn btn-default" value="ARAMA YAP"></div>
  </div>
  <?= form_close() ?>
</div>
<div class="table-responsive">
  <table id="personel_activities" class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Personel</th>
        <th>Tarih</th>
        <th>Giriş Saati</th>
        <th>Giriş Türü</th>
        <th>Çıkış Saati</th>
        <th>Çıkış Türü</th>
        <th>Çalışma Saati</th>
        <th>İşlem</th>
      </tr>
    </thead>
    <tbody>
      <?php if(!empty($personel_activities)){ ?>
      <?php foreach($personel_activities as $personel_activity){ ?>
      <tr>
        <td></td>
        <td><?= $personel_activity['name']." ".$personel_activity['surname'] ?></td>
        <td><?= $personel_activity['tarih'] ?></td>
        <td><?= $personel_activity['girisaat'] ?></td>
        <td><?= $personel_activity['giristur'] ?></td>
        <td><?= $personel_activity['cikisaat'] ?></td>
        <td><?= $personel_activity['cikistur'] ?></td>
        <td>
          <?php
          if($personel_activity['girisaat']!=NULL && $personel_activity['cikisaat']!=NULL){
            $zaman= (strtotime($personel_activity['cikisaat'])-strtotime($personel_activity['girisaat'])+strtotime("00:00:00"));
            echo date('H:i:s', $zaman);
          }
          ?>
        </td>
        <td>
          <?php
          $veri="null";
          if($personel_activity['id1']!=NULL && $personel_activity['id2']!=NULL){
          ?>
          <a href="<?= base_url('/personel_activities/edit/'  . $personel_activity['id1']  .'/'.  $personel_activity['id2'])  ?>" title="Düzenle"><i class="fa fa-edit"></i></a>
          <a href="<?= base_url('/personel_activities/delete/'. $personel_activity['id1']  .'/'.  $personel_activity['id2'])  ?>" title="Silme"><i class="fa fa-trash"></i></a>
          <?php
        }else if($personel_activity['id1']==NULL && $personel_activity['id2']!=NULL){
          ?>
            <a href="<?= base_url('/personel_activities/delete/'. $veri  .'/'.  $personel_activity['id2'])  ?>" title="Silme"><i class="fa fa-trash"></i></a>
          <?php
        }else if($personel_activity['id1']!=NULL && $personel_activity['id2']==NULL)
        {
          ?>
            <a href="<?= base_url('/personel_activities/delete/'. $personel_activity['id1']  .'/'.  $veri)  ?>" title="Silme"><i class="fa fa-trash"></i></a>
          <?php
        }
          ?>



        </td>
      </tr>
      <?php } ?>
      <?php } ?>
    </tbody>
  </table>
</div>
