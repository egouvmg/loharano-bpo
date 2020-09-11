
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Loharano - Récapitulation</title>
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
			<div class="col-sm-4 text-center progress-item active">
			<?= $this->lang->line('resume');?>
				<div class="progress-mark">
					<span class="iconify" data-inline="false" data-icon="uil:check" style="font-size: 24px;"></span>
				</div>
			</div>
		</div>

		<div class="location-block">
		<div class="row">
		<div class="col-sm-3">
		<span class="label"><?= $this->lang->line('province');?> :</span>
		<span class="data"><?= $territory->pname;?></span>
		</div>
		<div class="col-sm-3">
		<span class="label"><?= $this->lang->line('region');?> :</span>
		<span class="data"><?= $territory->rname;?></span>
		</div>
		<div class="col-sm-3">
		<span class="label"><?= $this->lang->line('district');?> :</span>
		<span class="data"><?= $territory->dname;?></span>
		</div>
		<div class="col-sm-3">
		<span class="label"><?= $this->lang->line('common');?> :</span>
		<span class="data"><?= $territory->cname;?></span>
		</div>
		</div>
		<div class="row">
			<div class="col-sm-3">
			<span class="label"><?= $this->lang->line('fokontany');?> :</span>
			<span class="data"><?= $territory->fname;?></span>
			</div>
			<div class="col-sm-3">
			<span class="label"><?= $this->lang->line('notebook_number');?> : :</span>
			<span class="data"><?= $_SESSION['notebook_fkt'];?></span>
			</div>
			<div class="col-sm-3">
			<span class="label"><?= $this->lang->line('locality');?> :</span>
			<span class="data"><?= $_SESSION['sector_locality'];?></span>
			</div>
			<div class="col-sm-3">
			<span class="label"><?= $this->lang->line('address');?> :</span>
			<span class="data"><?= $_SESSION['address'];?></span>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-3">
			<span class="label">Fichier PDF :</span>
			<span class="data"><?= $_SESSION['pdf_file'];?></span>
			</div></div>
		</div>
		<div class="card-block">
			<div class="row">
				<?php foreach ($persons as $key => $person): ?>	
					<div class="col-lg-6 align-self-stretch">
						<div class="card">
							<div class="card-body">
								<?php
									$_sexe = 'I';
									$_sexe = ($person['sexe'] == 1) ? 'H' : $_sexe;
									$_sexe = ($person['sexe'] == 0) ? 'F' : $_sexe;
								?>
								<h5 class="card-title">N° <?= $key + 1;?> - <?= $_sexe;?></h5>
								<div class="card-list row">
								<div class="col-md-6">
								<span class="label"><?= $this->lang->line('last_name');?> - <?= $this->lang->line('first_name');?> :</span>
								<span class="data"><?=$person['last_name'];?> <?=$person['first_name'];?></span>
								</div>
								<div class="col-md-6">
								<span class="label"><?= $this->lang->line('parent_link');?> :</span>
								<span class="data">
									<?php
										switch ($person['parent_link']) {
											case 'pere':
												echo 'Père';
												break;
											case 'mere':
												echo 'Mère';
												break;
											case 'fils':
												echo 'Fils';
												break;
											case 'fille':
												echo 'Fille';
												break;
											case '0':
												echo '';
												break;
											default:
												echo $person['parent_link'];
												break;
										}
									?>
								</span>
								</div>
								</div>
								<div class="card-list row">
								<div class="col-md-6">
								<span class="label"><?= $this->lang->line('birth');?> :</span>
								<span class="data">
									<?= $person['birth'];?> - <?= $person['birth_place'];?>
								</span>
								</div>
								<div class="col-md-6">
								<span class="label"><?= $this->lang->line('job');?></span>
								<span class="data">
									<?php if($person['job'] == 0) :?>
										<?=$person['job_other'];?> - <?=$person['job_status'];?>
									<?php elseif($person['job'] > 0) :?>
										<?= $this->lang->line('fr_job_'.$person['job']);?> - <?=$person['job_status'];?>
									<?php endif;?>
								</span>
								</div>
								</div>
								<div class="card-list row">
								<div class="col-md-6">
								<span class="label"><?= $this->lang->line('cin');?> :</span>
								<span class="data"><?=$person['cin'];?>
									<?php
										echo " le ".$person['cin_date'];
										echo " à ".$person['cin_place'];
									?>
								</div>
								<div class="col-md-6">
								<span class="label"><?= $this->lang->line('handicapped');?> :</span>
								<span class="data"><?= ($person['handicapped'] == 1) ? 'Oui' : 'Non';?></span>
								</div>
								</div>
							</div>
						</div>
					</div>
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
          <a href="inserer_nouveau_menage"><button type="submit" class="btn btn-cancel btn-lg float-left">
            <span class="iconify" data-inline="false" data-icon="uil:times-circle" style="font-size: 24px;"></span>
            <?= $this->lang->line('cancel');?>
          </button></a>
          <button type="submit" class="btn btn-primary btn-lg float-right" id="confirmationData">
            <span class="iconify" data-inline="false" data-icon="uil:check" style="font-size: 32px;"></span>
            <?= $this->lang->line('save');?>
          </button>
          <a href="ajout_individu" class="float-right">
          		<button type="submit" class="btn btn-primary btn-lg">
	            	<span class="iconify" data-inline="false" data-icon="uil:arrow-left" style="font-size: 32px;"></span>
	            	<?= $this->lang->line('previous');?>
	          	</button>
	      </a>
        </div>
      </div>

    </div>
  </div>

  <!-- Modal confirmation -->

  <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body text-center">
          <span class="icon-check">
            <span class="iconify" data-inline="false" data-icon="uil:check" style="font-size: 32px;"></span>
          </span>
          <p>Fiche de recensement population remplie avec succès</p>
          <a href="inserer_nouveau_menage"><button type="button" class="btn btn-primary btn-lg">Ok</button></a>
        </div>
      </div>
    </div>
  </div>
	</div>
	<script src="<?= js('jquery.min');?>"></script>
  	<script src="<?= plugin('bootstrap', 'js', 'bootstrap.bundle.min.js');?>"></script>
	<script src="<?= plugin('modules', 'person', 'resume.js');?>"></script>
</body>
</html>
