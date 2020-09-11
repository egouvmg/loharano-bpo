<?php
	$active = ($tab_index == 1) ? 'active' : '';
?>
<div class="form-body tab-pane fade show <?=$active;?>" id="pers<?= $tab_index;?>" data-number="<?= $tab_number;?>" data-index="<?= $tab_index;?>" role="tabpanel" aria-labelledby="pers<?= $tab_index;?>-tab">
	<div class="form-row">
		<div class="form-group col-md-2">
			<label for="household_head<?= $tab_index;?>"><?= $this->lang->line('household_head');?><span class="text-red">*</span></label>
			<select id="household_head<?= $tab_index;?>" class="form-control household_head" name="household_head[]">
				<option value="0">Non</option>
				<option value="1">Oui</option>
			</select>
			<div class="error_field household_headError"></div>
		</div>
		<div class="form-group col-md-4">
			<label for="last_name<?= $tab_index;?>"><?= $this->lang->line('last_name');?><span class="text-red">*</span></label>
			<input type="text" name="last_name[]" class="form-control last_name" id="last_name<?= $tab_index;?>"/>
			<div class="error_field last_name<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-3">
			<label for="first_name<?= $tab_index;?>"><?= $this->lang->line('first_name');?></label>
			<input type="text" name="first_name[]" class="form-control first_name" id="first_name<?= $tab_index;?>"/>
			<div class="error_field first_name<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-3">
			<label for="marital_status<?= $tab_index;?>"><?= $this->lang->line('marital_status');?></label>
			<select id="marital_status<?= $tab_index;?>" class="form-control"  name="marital_status[]">
				<option value="5"></option>
				<option value="1">Célibataire</option>
				<option value="2">Marié(e)</option>
				<option value="3">Veuf/Veuve</option>
				<option value="4">Divorcé(e)</option>
			</select>
			<div class="error_field marital_status<?= $tab_index;?>Error"></div>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-3">
			<label for="parent_link<?= $tab_index;?>"><?= $this->lang->line('parent_link');?></label>
			<select id="parent_link<?= $tab_index;?>" onchange="controlFilsFille('#parent_link<?= $tab_index;?>', '#sexe<?= $tab_index;?>');" class="form-control parent_link" name="parent_link[]">
				<option value="0"></option>
				<option value="pere">Père</option>
				<option value="mere">Mère</option>
				<option value="fils">Fils</option>
				<option value="fille">Fille</option>
				<option value="autre">Autres</option>
			</select>
			<input type="text" name="other_pl[]" id="otherParentLink<?= $tab_index;?>" placeholder="Préciser le lien de parenté" style="display: none; margin-top: 3px;" class="form-control" />
			<div class="error_field parent_link<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-3">
			<label for="birth<?= $tab_index;?>"><?= $this->lang->line('birth');?><span class="text-red">*</span></label>
			<input type="text" class="form-control date_type" placeholder="jj/mm/aaaa" name="birth[]" id="birth<?= $tab_index;?>"/>
			<div class="error_field birth<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-4">
			<label for="birth_place<?= $tab_index;?>"><?= $this->lang->line('birth_place');?><span class="text-red">*</span></label>
			<input type="text" class="form-control" name="birth_place[]" id="birth_place<?= $tab_index;?>"/>
			<div class="error_field birth_place<?= $tab_index;?>Error"></div>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-3">
			<label for="sexe<?= $tab_index;?>"><?= $this->lang->line('sexe');?></label>
			<select id="sexe<?= $tab_index;?>" class="form-control"  name="sexe[]">
				<option value="2"></option>
				<option value="1">Homme</option>
				<option value="0">Femme</option>
			</select>
			<div class="error_field sexe<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-3">
			<label for="handicapped<?= $tab_index;?>"><?= $this->lang->line('handicapped');?></label>
			<select id="handicapped<?= $tab_index;?>" class="form-control" name="handicapped[]">
				<option value="0">Non</option>
				<option value="1">Oui</option>
			</select>
			<div class="error_field handicapped<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-4">
			<label for="nationality<?= $tab_index;?>"><?= $this->lang->line('nationnality');?></label>
			<select class="form-control nationality" name="nationality[]" class="form-control" id="nationality<?= $tab_index;?>">
				<option value="Malgache">Malgache</option>
				<option value="Française">Française</option>
				<option value="Americaine">Americaine</option>
				<option value="Afghane">Afghane</option>
				<option value="Albanaise">Albanaise</option>
				<option value="Algerienne">Algerienne</option>
				<option value="Allemande">Allemande</option>
				<option value="Andorrane">Andorrane</option>
				<option value="Angolaise">Angolaise</option>
				<option value="Antiguaise et barbudienne">Antiguaise et barbudienne</option>
				<option value="Argentine">Argentine</option>
				<option value="Armenienne">Armenienne</option>
				<option value="Australienne">Australienne</option>
				<option value="Autrichienne">Autrichienne</option>
				<option value="Azerbaïdjanaise">Azerbaïdjanaise</option>
				<option value="Bahamienne">Bahamienne</option>
				<option value="Bahreinienne">Bahreinienne</option>
				<option value="Bangladaise">Bangladaise</option>
				<option value="Barbadienne">Barbadienne</option>
				<option value="Belge">Belge</option>
				<option value="Belizienne">Belizienne</option>
				<option value="Beninoise">Beninoise</option>
				<option value="Bhoutanaise">Bhoutanaise</option>
				<option value="Bielorusse">Bielorusse</option>
				<option value="Birmane">Birmane</option>
				<option value="Bissau-Guinéenne">Bissau-Guinéenne</option>
				<option value="Bolivienne">Bolivienne</option>
				<option value="Bosnienne">Bosnienne</option>
				<option value="Botswanaise">Botswanaise</option>
				<option value="Bresilienne">Bresilienne</option>
				<option value="Britannique">Britannique</option>
				<option value="Bruneienne">Bruneienne</option>
				<option value="Bulgare">Bulgare</option>
				<option value="Burkinabe">Burkinabe</option>
				<option value="Burundaise">Burundaise</option>
				<option value="Cambodgienne">Cambodgienne</option>
				<option value="Camerounaise">Camerounaise</option>
				<option value="Canadienne">Canadienne</option>
				<option value="Cap-verdienne">Cap-verdienne</option>
				<option value="Centrafricaine">Centrafricaine</option>
				<option value="Chilienne">Chilienne</option>
				<option value="Chinoise">Chinoise</option>
				<option value="Chypriote">Chypriote</option>
				<option value="Colombienne">Colombienne</option>
				<option value="Comorienne">Comorienne</option>
				<option value="Congolaise">Congolaise</option>
				<option value="Costaricaine">Costaricaine</option>
				<option value="Croate">Croate</option>
				<option value="Cubaine">Cubaine</option>
				<option value="Danoise">Danoise</option>
				<option value="Djiboutienne">Djiboutienne</option>
				<option value="Dominicaine">Dominicaine</option>
				<option value="Dominiquaise">Dominiquaise</option>
				<option value="Egyptienne">Egyptienne</option>
				<option value="Emirienne">Emirienne</option>
				<option value="Equato-guineenne">Equato-guineenne</option>
				<option value="Equatorienne">Equatorienne</option>
				<option value="Erythreenne">Erythreenne</option>
				<option value="Espagnole">Espagnole</option>
				<option value="Est-timoraise">Est-timoraise</option>
				<option value="Estonienne">Estonienne</option>
				<option value="Ethiopienne">Ethiopienne</option>
				<option value="Fidjienne">Fidjienne</option>
				<option value="Finlandaise">Finlandaise</option>
				<option value="Gabonaise">Gabonaise</option>
				<option value="Gambienne">Gambienne</option>
				<option value="Georgienne">Georgienne</option>
				<option value="Ghaneenne">Ghaneenne</option>
				<option value="Grenadienne">Grenadienne</option>
				<option value="Guatemalteque">Guatemalteque</option>
				<option value="Guineenne">Guineenne</option>
				<option value="Guyanienne">Guyanienne</option>
				<option value="Haïtienne">Haïtienne</option>
				<option value="Hellenique">Hellenique</option>
				<option value="Hondurienne">Hondurienne</option>
				<option value="Hongroise">Hongroise</option>
				<option value="Indienne">Indienne</option>
				<option value="Indonesienne">Indonesienne</option>
				<option value="Irakienne">Irakienne</option>
				<option value="Irlandaise">Irlandaise</option>
				<option value="Islandaise">Islandaise</option>
				<option value="Israélienne">Israélienne</option>
				<option value="Italienne">Italienne</option>
				<option value="Ivoirienne">Ivoirienne</option>
				<option value="Jamaïcaine">Jamaïcaine</option>
				<option value="Japonaise">Japonaise</option>
				<option value="Jordanienne">Jordanienne</option>
				<option value="Kazakhstanaise">Kazakhstanaise</option>
				<option value="Kenyane">Kenyane</option>
				<option value="Kirghize">Kirghize</option>
				<option value="Kiribatienne">Kiribatienne</option>
				<option value="Kittitienne-et-nevicienne">Kittitienne-et-nevicienne</option>
				<option value="Kossovienne">Kossovienne</option>
				<option value="Koweitienne">Koweitienne</option>
				<option value="Laotienne">Laotienne</option>
				<option value="Lesothane">Lesothane</option>
				<option value="Lettone">Lettone</option>
				<option value="Libanaise">Libanaise</option>
				<option value="Liberienne">Liberienne</option>
				<option value="Libyenne">Libyenne</option>
				<option value="Liechtensteinoise">Liechtensteinoise</option>
				<option value="Lituanienne">Lituanienne</option>
				<option value="Luxembourgeoise">Luxembourgeoise</option>
				<option value="Macedonienne">Macedonienne</option>
				<option value="Malaisienne">Malaisienne</option>
				<option value="Malawienne">Malawienne</option>
				<option value="Maldivienne">Maldivienne</option>
				<option value="Malienne">Malienne</option>
				<option value="Maltaise">Maltaise</option>
				<option value="Marocaine">Marocaine</option>
				<option value="Marshallaise">Marshallaise</option>
				<option value="Mauricienne">Mauricienne</option>
				<option value="Mauritanienne">Mauritanienne</option>
				<option value="Mexicaine">Mexicaine</option>
				<option value="Micronesienne">Micronesienne</option>
				<option value="Moldave">Moldave</option>
				<option value="Monegasque">Monegasque</option>
				<option value="Mongole">Mongole</option>
				<option value="Montenegrine">Montenegrine</option>
				<option value="Mozambicaine">Mozambicaine</option>
				<option value="Namibienne">Namibienne</option>
				<option value="Nauruane">Nauruane</option>
				<option value="Neerlandaise">Neerlandaise</option>
				<option value="Neo-zelandaise">Neo-zelandaise</option>
				<option value="Nepalaise">Nepalaise</option>
				<option value="Nicaraguayenne">Nicaraguayenne</option>
				<option value="Nigeriane">Nigeriane</option>
				<option value="Nigerienne">Nigerienne</option>
				<option value="Nord-coréenne">Nord-coréenne</option>
				<option value="Norvegienne">Norvegienne</option>
				<option value="Omanaise">Omanaise</option>
				<option value="Ougandaise">Ougandaise</option>
				<option value="Ouzbeke">Ouzbeke</option>
				<option value="Pakistanaise">Pakistanaise</option>
				<option value="Palau">Palau</option>
				<option value="Palestinienne">Palestinienne</option>
				<option value="Panameenne">Panameenne</option>
				<option value="Papouane-neoguineenne">Papouane-neoguineenne</option>
				<option value="Paraguayenne">Paraguayenne</option>
				<option value="Peruvienne">Peruvienne</option>
				<option value="Philippine">Philippine</option>
				<option value="Polonaise">Polonaise</option>
				<option value="Portoricaine">Portoricaine</option>
				<option value="Portugaise">Portugaise</option>
				<option value="Qatarienne">Qatarienne</option>
				<option value="Roumaine">Roumaine</option>
				<option value="Russe">Russe</option>
				<option value="Rwandaise">Rwandaise</option>
				<option value="Saint-lucienne">Saint-lucienne</option>
				<option value="Saint-marinaise">Saint-marinaise</option>
				<option value="Saint-vincentaise-et-grenadine">Saint-vincentaise-et-grenadine</option>
				<option value="Salomonaise">Salomonaise</option>
				<option value="Salvadorienne">Salvadorienne</option>
				<option value="Samoane">Samoane</option>
				<option value="Santomeenne">Santomeenne</option>
				<option value="Saoudienne">Saoudienne</option>
				<option value="Senegalaise">Senegalaise</option>
				<option value="Serbe">Serbe</option>
				<option value="Seychelloise">Seychelloise</option>
				<option value="Sierra-leonaise">Sierra-leonaise</option>
				<option value="Singapourienne">Singapourienne</option>
				<option value="Slovaque">Slovaque</option>
				<option value="Slovene">Slovene</option>
				<option value="Somalienne">Somalienne</option>
				<option value="Soudanaise">Soudanaise</option>
				<option value="Sri-lankaise">Sri-lankaise</option>
				<option value="Sud-africaine">Sud-africaine</option>
				<option value="Sud-coréenne">Sud-coréenne</option>
				<option value="Suedoise">Suedoise</option>
				<option value="Suisse">Suisse</option>
				<option value="Surinamaise">Surinamaise</option>
				<option value="Swazie">Swazie</option>
				<option value="Syrienne">Syrienne</option>
				<option value="Tadjike">Tadjike</option>
				<option value="Taiwanaise">Taiwanaise</option>
				<option value="Tanzanienne">Tanzanienne</option>
				<option value="Tchadienne">Tchadienne</option>
				<option value="Tcheque">Tcheque</option>
				<option value="Thaïlandaise">Thaïlandaise</option>
				<option value="Togolaise">Togolaise</option>
				<option value="Tonguienne">Tonguienne</option>
				<option value="Trinidadienne">Trinidadienne</option>
				<option value="Tunisienne">Tunisienne</option>
				<option value="Turkmene">Turkmene</option>
				<option value="Turque">Turque</option>
				<option value="Tuvaluane">Tuvaluane</option>
				<option value="Ukrainienne">Ukrainienne</option>
				<option value="Uruguayenne">Uruguayenne</option>
				<option value="Vanuatuane">Vanuatuane</option>
				<option value="Venezuelienne">Venezuelienne</option>
				<option value="Vietnamienne">Vietnamienne</option>
				<option value="Yemenite">Yemenite</option>
				<option value="Zambienne">Zambienne</option>
				<option value="Zimbabweenne">Zimbabweenne</option>
			</select>
			<div class="error_field nationality<?= $tab_index;?>Error"></div>
		</div>
	</div>
	<div class="form-row cin-container-<?= $tab_index;?>">
		<div class="form-group col-md-3">
			<label for="cin<?= $tab_index;?>"><?= $this->lang->line('cin');?></label>
			<input type="text" placeholder="000 000 000 000" class="form-control cin" name="cin[]" id="cin<?= $tab_index;?>"/>
			<div class="error_field cin<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-3">
			<label for="cin_date<?= $tab_index;?>"><?= $this->lang->line('cin_date');?></label>
			<input type="text" class="form-control date_type" placeholder="jj/mm/aaaa" name="cin_date[]" id="cin_date<?= $tab_index;?>" onchange="controlBirthAndCinDate(<?= $tab_index;?>);"/>
			<div class="error_field cin_date<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-3">
			<label for="cin_place<?= $tab_index;?>"><?= $this->lang->line('cin_place');?></label>
			<input type="text" class="form-control" name="cin_place[]" id="cin_place<?= $tab_index;?>"/>
			<div class="error_field cin_place<?= $tab_index;?>Error"></div>
		</div>
	</div>
	<div class="form-row passport-container-<?= $tab_index;?>"  style="display:none;">
		<div class="form-group col-md-4">
			<label for="passport<?= $tab_index;?>">Numéro CIN/Passeport/Carte de résident</label>
			<input type="text" class="form-control" maxlenght="20" placeholder="xxxxxxxxxxxxxxxxxxxx" name="passport[]" id="passport<?= $tab_index;?>"/>
			<div class="error_field passport<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-4">
			<label for="passport_date<?= $tab_index;?>">Date CIN/Passeport/Carte de résident</label>
			<input type="text" class="form-control date_type" placeholder="jj/mm/aaaa" name="passport_date[]" id="passport_date<?= $tab_index;?>"/>
			<div class="error_field passport_date<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-4">
			<label for="passport_place<?= $tab_index;?>">Lieu CIN/Passeport/Carte de résident</label>
			<input type="text" class="form-control" placeholder="..." name="passport_place[]" id="passport_place<?= $tab_index;?>"/>
			<div class="error_field passport_place<?= $tab_index;?>Error"></div>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-4">
			<label for="father<?= $tab_index;?>"><?= $this->lang->line('father');?></label>
			<input type="text" class="form-control father" name="father[]" id="father<?= $tab_index;?>"/>
			<div class="error_field father<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-2">
			<label for="father_status<?= $tab_index;?>"><?= $this->lang->line('father_status');?></label>
			<select name="father_status[]"  class="form-control" id="father_status<?= $tab_index;?>">
				<option value="0">Vivant</option>
				<option value="1">Mort</option>
			</select>
			<div class="error_field father_status<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-4">
			<label for="mother<?= $tab_index;?>"><?= $this->lang->line('mother');?></label>
			<input type="text" class="form-control" name="mother[]" id="mother<?= $tab_index;?>"/>
			<div class="error_field mother<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-2">
			<label for="mother_status<?= $tab_index;?>"><?= $this->lang->line('mother_status');?></label>
			<select name="mother_status[]"  class="form-control" id="mother_status<?= $tab_index;?>">
				<option value="0">Vivante</option>
				<option value="1">Morte</option>
			</select>
			<div class="error_field mother_status<?= $tab_index;?>Error"></div>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-4">
			<label for="phone<?= $tab_index;?>"><?= $this->lang->line('phone');?></label>
			<input type="text" placeholder="032 00 000 00; 033 00 000 00; 034 00 000 00" class="form-control" name="phone[]" id="phone<?= $tab_index;?>"/>
			<div class="error_field phone<?= $tab_index;?>Error"></div>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-4">
			<label for="job<?= $tab_index;?>"><?= $this->lang->line('job');?></label>
			<select id="job<?= $tab_index;?>" class="form-control job" name="job[]">
				<option value="-1"></option>
				<?php foreach ($jobs as $key => $job): ?>
					<option value="<?= $job->id;?>"><?= $job->id;?> - <?= $this->lang->line('mg_job_'.$job->id);?> - <?= $this->lang->line('fr_job_'.$job->id);?></option>
				<?php endforeach ?>
					<option value="0">Autres</option>
			</select>
			<input type="text" name="other_job[]" id="otherJob<?= $tab_index;?>" placeholder="Préciser la profession" style="display: none; margin-top: 3px;" class="form-control" />
			<div class="error_field job<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-3"></div>
		<div class="form-group col-md-5">
			<label for="job_status"><?= $this->lang->line('job_status');?></label>
			<input type="text" class="form-control" name="job_status[]" id="job_status"/>
			<div class="error_field job_statusError"></div>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-12">
			<label for="observation"><?= $this->lang->line('observation');?></label>
			<textarea class="form-control" placeholer="..." name="observation[]" id="observation"></textarea>
			<div class="error_field observationError"></div>
		</div>
	</div>
</div>
