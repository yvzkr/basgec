<?= form_open(current_url()) ?>
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
<input type="submit" class="btn btn-default" value="Gönder">
<?= form_close() ?>
