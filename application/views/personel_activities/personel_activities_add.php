<div class="container">
<button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModal">
  Yeni Personel Aktiviteler Ekle
</button>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Yeni Personel Aktiviteler Ekle</h4>
      </div>
      <div class="modal-body">
        <!-- personel ekleme -->
        <form action="<?=base_url('personel_activities/new')?>" id="addPersonelAktivityForm" >
        <?php if( ! empty( $errors ) ){ ?>
        <div class="alert alert-danger" role="alert">
          <?= $errors ?>
        </div>
        <?php } ?>
        <div class="form-group">
          <?php foreach($inputs as $input){ ?>
            <?= form_label($input['label'], $input['name']) ?>
              <?php unset($input['label']) ?>
              <?php if($input['tag'] == 'input'){ ?>
                <?php unset($input['tag']) ?>
                <?= form_input($input) ?>
              <?php }elseif($input['tag'] == 'select'){ ?>
                <?php unset($input['tag']) ?>
                <?= form_dropdown($input['name'], $input['options'], $input['selected'], 'class="form-control"') ?>
              <?php } ?>
          <?php } ?>
        </div>
        <input type="submit"  value="Gönder">
      </form>
        <!--personel ekleme-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>
