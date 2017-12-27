<div class="table-responsive">
  <table id="job_rotations_index" class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Personel Adı</th>
        <th>Personel Soyadı</th>
        
        <th>Tc</th>
        

      </tr>
    </thead>
    <tbody>
      <?php foreach($personels as $personels){ ?>
      <tr>
        <td>  <?= $personels->id ?>                </td>
        <td>  <?= $personels->name ?>              </td>
        <td>  <?= $personels->surname ?>           </td>
        
        <td>  <?= $personels->tc_no ?>             </td>
        
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
