<?= form_open(current_url().'/home') ?>
<?php if( ! empty( $errors ) ){ ?>
<div class="alert alert-danger" role="alert">
  <?= $errors ?>
</div>
<?php } ?>
<div class="form-group"><?php if(isset($asd)) echo $asd;?>
  <?php foreach($inputs as $input){ ?>
    <?= form_label($input['label'], $input['name']) ?>
      <?php unset($input['label']) ?>
      <?php if($input['tag'] == 'input'){ ?>
        <?php unset($input['tag']) ?>
        <?= form_input($input) ?>
      <?php }elseif($input['tag'] == 'select'){ ?>
        <?php unset($input['tag']) ?>
        <?= form_dropdown($input['name'], $input['options'], $input['selected']) ?>
      <?php } ?>
  <?php } ?>
</div>
<input type="submit" class="btn btn-info" value="Gönder">
<?= form_close() ?>
