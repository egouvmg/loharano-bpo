
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Loharano - Saisies des informations sur la localisation et taille du ménage</title>
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
			<div class="col-sm-4 text-center progress-item active">
				<?= $this->lang->line('localistion_household_size');?>
				<div class="progress-mark">
					<span class="iconify" data-inline="false" data-icon="uil:check" style="font-size: 24px;"></span>
				</div>
			</div>
			<div class="col-sm-4 text-center progress-item">
				<?= $this->lang->line('person_data');?>
				<div class="progress-mark">
					<span>2</span>
				</div>
			</div>
			<div class="col-sm-4 text-center progress-item">
				<?= $this->lang->line('resume');?>
				<div class="progress-mark">
					<span>3</span>
				</div>
			</div>
		</div>

		<div class="form-block">
			<form id="addPerson">
				<div class="form-title"><?= $this->lang->line('localisation');?></div>
		      	<div class="form-body">
				  	<div class="row">
						<div class="form-group col-md-4">
							<label for="province"><?= $this->lang->line('province');?><span class="text-red">*</span></label>
							<input type="text" readonly placeholder="..." class="form-control" name="province" id="province"/>
						</div>
						<div class="form-group col-md-4">
							<div class="form-group">
								<label for="region"><?= $this->lang->line('region');?><span class="text-red">*</span></label>
								<div class="form-group">
									<input type="text" readonly placeholder="..." class="form-control" name="region" id="region"/>
								</div>
							</div>
						</div>
						<div class="form-group col-md-4">
						<label for="district"><?= $this->lang->line('district');?><span class="text-red">*</span></label>
								<input type="text" readonly placeholder="..." class="form-control" name="district" id="district"/>
						</div>
						<div class="form-group col-md-4">
							<div class="form-group ">
								<label for="common"><?= $this->lang->line('common');?><span class="text-red">*</span></label>
								<input type="text" readonly placeholder="..." class="form-control" name="common" id="common"/>
							</div>
						</div>
						<div class="form-group col-md-4">
							<div class="form-group ">
								<label for="fokontany"><?= $this->lang->line('fokontany');?><span class="text-red">*</span></label>
								<select id="fokontany" name="fokontany" onchange="selectAllByFotonkany('#fokontany');" class="form-control">
									<?php foreach ($fokotanys_user as $fokotany_user) : ?>
										<option value="<?= $fokotany_user->fokontany_id;?>"><?= $fokotany_user->name;?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
						<div class="form-group col-md-4">
							<div class="form-group ">
								<label for="pdf_file">Nom du fichier PDF<span class="text-red">*</span></label>
								<input type="text" maxlength="40" placeholder="..." class="form-control" name="pdf_file" id="pdf_file"/>
								<div class="error_field" id="pdf_fileError"></div>
							</div>
						</div>
					</div>
					<div class="row">
					<div class="form-group col-md-4">
						<label for="notebook_fkt"><?= $this->lang->line('register_number');?></label>
						<input type="text" placeholder="..." class="form-control" name="notebook_fkt" id="notebook_fkt"/>
						<div class="error_field" id="notebook_fktError"></div>
					</div>
					<div class="form-group col-md-4">
						<label for="sector_locality"><?= $this->lang->line('locality');?></label>
						<input type="text" placeholder="..." class="form-control" name="sector_locality" id="sector_locality"/>
						<div class="error_field" id="sector_localityError"></div>
					</div>
					<div class="form-group col-md-4">
						<label for="address"><?= $this->lang->line('address');?><span class="text-red">*</span></label>
						<input type="text" placeholder="..." class="form-control" name="address" id="address"/>
						<div class="error_field" id="addressError"></div>
					</div>
				</div>
				<div class="form-title"><?= $this->lang->line('household_size');?></div>
				<div class="form-body">
					<div class="row">
						<div class="form-group col-md-4">
							<label for="household_size"><?= $this->lang->line('enter_household_size');?><span class="text-red">*</span></label>
							<input type="number" placeholder="0" class="form-control" name="household_size" id="household_size"  min="1" max="75"/>
							<div class="error_field" id="household_sizeError"></div>
						</div>
					</div>
				</div>

				<div class="form-foot">
					<div class="form-group text-center">
						<div id="loadingData" style="display: none;">
							<center>
								<img src="<?= img('loading.gif');?>"> Chargement ...
							</center>
						</div>
						<button type="submit" class="btn btn-primary btn-lg"><?= $this->lang->line('resume');?>
							<span class="iconify" data-inline="false" data-icon="uil:arrow-right" style="font-size: 32px;"></span>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script src="<?= js('jquery.min');?>"></script>
	<script src="<?= plugin('modules', 'person', 'household.js');?>"></script>
</body>
</html>
