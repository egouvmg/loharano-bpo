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
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&family=Roboto+Slab:wght@300;400;500&display=swap" rel="stylesheet">
	<link href="<?= plugin('bootstrap', 'css', 'bootstrap.min.css');?>" rel="stylesheet">
	<link href="<?= plugin('tabulator', 'css', 'tabulator.min.css');?>" rel="stylesheet">
	<?= css('company_admin');?>

	<script src="https://code.iconify.design/1/1.0.4/iconify.min.js"></script>
</head>


<body class="loharano">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light static-top">
    <div class="logo-container">
      <img src="<?= img('sautRep.png');?>">
      <div class="separator"></div>
      <img src="<?= img('Logo-Loharano-mini.png');?>">
    </div>
    <a href="se_deconnecter">
    <button type="submit" class="btn">
      Déconnexion
      <span class="iconify" data-icon="uil:arrow-circle-right" data-inline="false"></span>
    </button>
    </a>
  </nav>

  <!-- Page title -->
  <div class="container-fluid page-title">
    <h1>Société : <span><?= $company_details->name;?></span></h1>
    <a href="societe_liste_personnes">
      <button  type="submit" id="showNewFirm" class="btn btn-primary" data-toggle="modal" data-target="#newFirm">
        Liste des personnes saisies par Fokontany
      </button>
    </a>
  </div>

  <!-- Page Content -->
  <div class="container-fluid main-container">
    <div class="row">
    
      <!-- dashboard -->
      <div class="col-md-4">
        <h4>Fokontany</h4>
        <div class="row dashboard-list">
          <div class="col-sm-6 dashboard-item" id="cmp_fokontanyTreaty" data-toggle="modal" data-target="#cmp_listFokontanyTreaty">
            <span class="number"><?= format_number($number_fokontany_done);?></span>
            <span class="text">Traités</span>
          </div>
          <div class="col-sm-6 dashboard-item" id="cmp_fokontanyNeedTreat" data-toggle="modal" data-target="#cmp_listFokontanyNeedTreat">
            <span class="number"><?= format_number($start_company->nbr_fk - $number_fokontany_done);?></span>
            <span class="text">A traiter</span>
          </div>
        </div>

        <h4>Registres</h4>
        <div class="row dashboard-list">
          <div class="col-sm-6 dashboard-item">
            <span class="number"><?= format_number($done_company->nbr_register);?></span>
            <span class="text">Traités</span>
          </div>
					<div class="col-sm-6 dashboard-item">
            <span class="number"><?= format_number($start_company->nbr_register);?></span>
            <span class="text">A traiter</span>
          </div>
        </div>

        <h4>Personnes</h4>
        <div class="row dashboard-list">
          <div class="col-sm-6 dashboard-item" id="cmp_peopleTreaty" data-toggle="modal" data-target="#cmp_listPeopleTreaty">
            <span class="number"><?= format_number($done_company->people);?></span>
            <span class="text">Traitées</span>
          </div>
        </div>
      </div><!-- end dashboard --> 

      <!-- Firm list & infos -->
      <div class="col-md-3">
        <ul class="firm-list" id="firmContent">
          <?= (!empty($fk_rg)) ? $fk_rg : 'Aucune donnée rattachée à cette compagnie.';?>
        </ul>
      </div><!-- end firm list -->

      <div class="col-md-5">
        <div class="firm-infos">
          <!-- firm infos head -->
          <div class="firm-infos-head">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="pills-info-tab" data-toggle="pill" href="#pills-info" role="tab" aria-controls="pills-info" aria-selected="true">Informations</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="pills-survey-tab" data-toggle="pill" href="#pills-survey" role="tab" aria-controls="pills-survey" aria-selected="false">Suivi des saisies</a>
              </li>
            </ul>
          </div>
          
          <div id="loadingData" style="display: none;">
            <center>
              <img src="<?= img('loading.gif');?>"> Chargement ...
            </center>
          </div>
          
          <!-- firm infos body -->
          <div class="firm-infos-body tab-content" id="pills-tabContent">
            <!-- Register infos -->
            <?= $firms_registers;?>
            <!-- end register infos -->
          </div>
        </div>
      </div><!-- end firm infos -->

    </div>
  </div><!-- End page Content -->

	<!-- Modal fokontany treaty  -->
	<div class="modal fade" id="cmp_listFokontanyTreaty" tabindex="-1" role="dialog" aria-labelledby="cmp_listFokontanyTreatyTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cmp_listFokontanyTreatyTitle">
            Liste des fokontany traités
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
					<div id="loadingData" style="display: none;">
						<center>
							<img src="<?= img('loading.gif');?>"> Chargement ...
						</center>
					</div>
					<div id="cmp_fokontanyTreaty-table"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Fermer
            <span class="iconify" data-icon="uil:times-circle" data-inline="false"></span>
          </button>
        </div>
      </div>
    </div>
  </div>
	<!-- Modal fokontany treaty - END -->
	<!-- Modal fokontany to process  -->
	<div class="modal fade" id="cmp_listFokontanyNeedTreat" tabindex="-1" role="dialog" aria-labelledby="cmp_listFokontanyNeedTreatTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cmp_listFokontanyNeedTreatTitle">
            Liste des fokontany à traiter
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
					<div id="loadingData" style="display: none;">
						<center>
							<img src="<?= img('loading.gif');?>"> Chargement ...
						</center>
					</div>
					<div id="cmp_fokontanyProcess-table"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Fermer
            <span class="iconify" data-icon="uil:times-circle" data-inline="false"></span>
          </button>
        </div>
      </div>
    </div>
  </div>
	<!-- Modal fokontany to process - END -->
	<!-- Modal personne treaty -->
	<div class="modal fade" id="cmp_listPeopleTreaty" tabindex="-1" role="dialog" aria-labelledby="cmp_listPeopleTreatyTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cmp_listPeopleTreatyTitle">
            Liste des personnes traitées
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
					<div id="loadingData" style="display: none;">
						<center>
							<img src="<?= img('loading.gif');?>"> Chargement ...
						</center>
					</div>
					<div id="cmp_personTreaty-table"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Fermer
            <span class="iconify" data-icon="uil:times-circle" data-inline="false"></span>
          </button>
        </div>
      </div>
    </div>
  </div>
	<!-- Modal personne treaty -->
	<div class="modal fade" id="listPeopleTreatyDaily" tabindex="-1" role="dialog" aria-labelledby="listPeopleTreatyDailyTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="listPeopleTreatyDailyTitle">
            Liste des personnes traitées
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
					<div id="personTreatyDaily-table"></div>
				</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Fermer
            <span class="iconify" data-icon="uil:times-circle" data-inline="false"></span>
          </button>
        </div>
      </div>
    </div>
  </div>
	<!-- Modal personne treaty - END -->
	<!-- Modal personne treaty - END -->
	<script src="<?= js('jquery.min');?>"></script>
  <script src="<?= plugin('bootstrap', 'js', 'bootstrap.bundle.min.js');?>"></script>
	<script src="<?= plugin('tabulator', 'js', 'tabulator.min.js');?>"></script>
	<script src="<?= plugin('modules', 'company', 'index.js');?>"></script>
	<script src="<?= plugin('modules', 'company', 'cmp_popup_list.js');?>"></script>
</body>
</html>
