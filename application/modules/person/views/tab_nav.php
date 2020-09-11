
<?php
	$active = ($tab_index == 1) ? 'active' : '';
?>
<li class="nav-item" id="itemPerson<?=$tab_index;?>">
	<a class="nav-link <?=$active;?>" id="pers<?=$tab_index;?>-tab" data-toggle="tab" href="#pers<?=$tab_index;?>" role="tab" aria-controls="pers<?=$tab_index;?>" aria-selected="true">
		<?= $this->lang->line('person_numnber');?><?=$tab_index;?> 
		<span>
		<span class="iconify" data-inline="false" data-icon="uil:check" style="font-size: 16px;"></span>
		</span>
	</a>
</li>