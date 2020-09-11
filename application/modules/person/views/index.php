
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Loharano - Saisies des informations personnelles</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	<link href="<?= plugin('bootstrap', 'css', 'bootstrap.min.css');?>" rel="stylesheet">
	<?= css('custom');?>

	<script src="https://code.iconify.design/1/1.0.4/iconify.min.js"></script>
</head>
<body class="loharano">

	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light static-top">
		<div class="container">
			<img src="<?= img('sautRep.png');?>">
			<div class="separator"></div>
		  	<a href="taille_menage"><img src="<?= img('Logo-Loharano-mini.png');?>"></a>
			<div class="separator"></div>
			<h4><?= $company->name ?></h4>
		</div>
    <a href="se_deconnecter">
    <button type="submit" class="btn">
      Déconnexion
      <span class="iconify" data-icon="uil:arrow-circle-right" data-inline="false"></span>
    </button>
    </a>
	</nav>

	<!-- Page Content -->
	<div class="container">
		<div class="row progess-block">
			<div class="col-4 text-center progress-item active">
				<?= $this->lang->line('localistion_household_size');?>
				<div class="progress-mark">
					<span class="iconify" data-inline="false" data-icon="uil:check" style="font-size: 24px;"></span>
				</div>
			</div>
			<div class="col-4 text-center progress-item active">
				<?= $this->lang->line('person_data');?>
				<div class="progress-mark">
					<span class="iconify" data-inline="false" data-icon="uil:check" style="font-size: 24px;"></span>
				</div>
			</div>
			<div class="col-4 text-center progress-item">
				<?= $this->lang->line('resume');?>
				<div class="progress-mark">
					<span>3</span>
				</div>
			</div>
		</div>
		<br/>
		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="household_size_tab_content"><?= $this->lang->line('household_size');?> : </label>
				<strong id="household_size_tab_content" style="margin-right: 15px;"><?= $this->session->household_size;?></strong>
				<button type="button" id="houseSizeAdd" class="btn-sm btn-primary btn-lg">
					+ Ajouter
				</button>
				<button type="button" id="houseSizeRemove" class="btn-sm btn-secondary btn-lg">
					- Enlever
				</button>
				<div id="changeData" style="display: none;">
					<center>
						<img src="<?= img('loading.gif');?>" style="width:60px;"> Chargement ...
					</center>
				</div>
			</div>
		</div>
		<form id="addPersons" method="POST" action="recapitulation_finale">
		<div class="form-block">
			<!-- Tab Head -->
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<?php foreach ($tabs_nav as $tab_nav): ?>
					<?php echo $tab_nav;?>
				<?php endforeach ?>
			</ul>

			<div class="tab-content" id="myTabContent">
				<?php foreach ($tabs_content as $tab_content): ?>
					<?php echo $tab_content;?>
				<?php endforeach ?>
			</div>
		</div>

		<!-- Form foot -->
		<div class="form-foot">
			<div class="form-group text-center">

				<div id="loadingData" style="display: none;">
					<center>
						<img src="<?= img('loading.gif');?>"> Chargement ...
					</center>
				</div>
				<a href="taille_menage"><button type="button" class="btn btn-cancel btn-lg float-left"><?= $this->lang->line('cancel');?></button></a>

				<button type="button" id="persNext" class="btn btn-secondary btn-lg float-right">
					<strong><?= $this->lang->line('next_person');?></strong>
					<span class="iconify" data-inline="false" data-icon="uil:arrow-right" style="font-size: 32px;"></span>
				</button>

				<button type="button" id="persPrec" class="btn btn-primary btn-lg float-right">
					<span class="iconify" data-inline="false" data-icon="uil:arrow-left" style="font-size: 32px;"></span>
					<strong><?= $this->lang->line('previous_person');?></strong>
				</button>
			</div>
		</div>
		</form>

	</div>
	<script src="<?= js('jquery.min');?>"></script>
  	<script src="<?= plugin('bootstrap', 'js', 'bootstrap.bundle.min.js');?>"></script>
	<script src="<?= plugin('modules', 'person', 'person.js');?>"></script>
	<script src="<?= plugin('modules', 'person', 'tab_content.js');?>"></script>
</body>
</html>
