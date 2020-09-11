<?php if (!empty($fk_rg)): ?>
<li class="firm-item active" data-index="<?=$fk_rg[0]->company_id;?>"  data-date="<?=$fk_rg[0]->day_done;?>">
  <div class="firm-item-info">
    <div class="separator"></div>
    <div class="text">
      <h5>Saisie : <?= date('d / m / Y', strtotime($fk_rg[0]->day_done));?></h5>
      <p>
        <span><?= format_number($fk_rg[0]->nbr_fokontany);?> Fokontany traités</span>
        <span>-</span>
        <span><?= format_number($fk_rg[0]->nbr_register);?> Registres traités</span>
      </p>
    </div>
  </div>
  <div class="chevron">
    <span class="iconify" data-icon="uil:angle-right" data-inline="false"></span>
  </div>
</li>
<?php for ($i=1; $i < count($fk_rg); $i++) :?>
  <li class="firm-item"  data-index="<?=$fk_rg[$i]->company_id;?>"  data-date="<?=$fk_rg[$i]->day_done;?>">
  <div class="firm-item-info">
    <div class="separator"></div>
    <div class="text">
      <h5>Saisie : <?= date('d / m / Y',strtotime($fk_rg[$i]->day_done));?></h5>
      <p>
        <span><?= format_number($fk_rg[$i]->nbr_fokontany);?> Fokontany traités</span>
        <span>-</span>
        <span><?= format_number($fk_rg[$i]->nbr_register);?> Registres traités</span>
      </p>
    </div>
  </div>
  <div class="chevron">
    <span class="iconify" data-icon="uil:angle-right" data-inline="false"></span>
  </div>
</li>
<?php endfor;?>
<?php else : ?>
  <p>Traitement encours.</p>
<?php endif ?>