<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'auth/auth/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['se_connecter'] = 'auth/login';
$route['se_deconnecter'] = 'auth/logout';

//Person
$route['ajout_individu'] = 'person/index';
$route['ajouter_individu'] = 'person/enter_data';
$route['recapitulation_finale'] = 'person/resume_finale';
$route['taille_menage'] = 'person/household';
$route['valider_taille_menage'] = 'person/valid_household_size';
$route['resume_avant_sauvegarde'] = 'person/resum_insert';
$route['inserer_nouveau_menage'] = 'person/reset_session';
$route['sauvegarde_final'] = 'person/save_all';
$route['verifier_champs'] = 'person/check_fiedl';
$route['changer_langue'] = 'auth/change_language';

//Territory
$route['enfant_province'] = 'territory/procince_get_childs';
$route['enfant_region'] = 'territory/region_get_childs';
$route['enfant_district'] = 'territory/district_get_childs';
$route['enfant_commune'] = 'territory/common_get_childs';
$route['enfant_commune_avaliable'] = 'territory/common_get_avaliable_childs';


//Company
$route['tableau_bord_societe'] = "company/index";
$route['recuperation_details_enregistrement'] = "company/fokontany_register";
$route['societe_liste_personnes'] = "company/list_persons";
$route['liste_par_fokontany'] = "company/get_list_persons";
$route['verifier_personnne'] = "company/check_fields";
$route['fokontany_personnes'] = 'company/get_people_fokontany';

//Admin
$route['tableau_bord'] = "admin/index";
$route['fokontany_date_enregistrement'] = "admin/fokontany_date";
$route['societe_enregistrement'] = "admin/company_register";
$route['registres_par_fokontany'] = "admin/fokontany_register";
$route['nombre_fokotany_registre'] = 'admin/get_fk_register';
$route['enregistrement_fokotany_registre'] = 'admin/save_fk_register';
$route['modification_fokotany_registre'] = 'admin/edit_fk_register';
$route['nouveau_compte_societe'] = 'admin/save_company_account';
$route['assigne_societe_fokontany'] = 'admin/save_company_fokontany';
$route['supprimer_societe_fokontany'] = 'admin/delete_company_fokontany';
$route['compte_societe'] = 'admin/get_companyaccount';
$route['modifier_societe'] = 'admin/edit_companyaccount';
$route['tableau_menage'] = 'household/index';
$route['societe_registre'] = 'admin/get_company_register';
$route['fokontany_traite'] = 'territory/get_fokontany_treaty';
$route['fokontany_a_traiter'] = 'admin/get_company_treat';
$route['population_traitee'] = 'admin/get_people_treaty';
$route['population_a_traiter'] = 'admin/get_people_treat';
$route['suivi_saisie'] = 'admin/tracking_attachement';
$route['administrateur_verifier_personnne'] = "admin/check_fields";

//Household
$route['liste_personnes'] = 'household/people_list';
$route['nombre_personnes'] = 'household/fokontany_people';
$route['tableau_de_bord_doublons'] = 'household/duplicate';
$route['personnes_dupliquees'] = 'household/get_duplicate';
$route['meme_personnes'] = 'household/get_same_perons';

//Fokontany
$route['fokontany_commune'] = "territory/getCommunByFokontanyId";
//Commune
$route['commune_district'] = 'territory/getDistrictByCommunId';
//region
$route['district_region'] = 'territory/getRegionByDistrictId';
//province
$route['region_province'] = 'territory/getProvinceByRegion';

//nombre Personne
$route['nb_person'] = 'person/canEditPersonNumber';

//SyncPersonNumber
$route['changer_nombre_personnes'] = 'person/sychrPersonNumber';

// Duplicate person
$route['liste_duplicate_persons'] = 'person/get_all_duplicated_persons';

$route['all_fokontanyTreaty'] = 'admin/get_all_fokontanyTreaty';

$route['all_fokontanyNeedTreat'] = 'admin/get_all_fokontanyNeedTreat';

$route['all_peopleTreaty'] = 'admin/get_all_peopleTreaty';
$route['personnes_traitees_par_jour'] = 'admin/get_people_treaty_daily';
$route['personnes_traitees_jour_en_jour'] = 'company/get_people_treaty_daily';

$route['cmp_fokontanyTreaty'] = 'company/get_cmp_fokontanyTreaty';

$route['cmp_fokontanyNeedTreat'] = 'company/get_cmp_fokontanyNeedTreat';

$route['cmp_peopleTreaty'] = 'company/get_cmp_peopleTreaty';
