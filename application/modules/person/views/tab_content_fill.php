<?php
	$active = ($tab_index == 1) ? 'active' : '';
?>
<div class="form-body tab-pane fade show <?=$active;?>" id="pers<?= $tab_index;?>" data-number="<?= $tab_number;?>" data-index="<?= $tab_index;?>" role="tabpanel" aria-labelledby="pers<?= $tab_index;?>-tab">
	<div class="form-row">
		<div class="form-group col-md-2">
			<label for="household_head<?= $tab_index;?>"><?= $this->lang->line('household_head');?><span class="text-red">*</span></label>
			<select id="household_head<?= $tab_index;?>" class="form-control household_head" name="household_head[]">
				<option value="0" <?= ($person['household_head'] == '1') ? 'selected' : '';?>>Non</option>
				<option value="1" <?= ($person['household_head'] == '1') ? 'selected' : '';?>>Oui</option>
			</select>
			<div class="error_field household_headError"></div>
		</div>
		<div class="form-group col-md-4">
			<label for="last_name<?= $tab_index;?>"><?= $this->lang->line('last_name');?><span class="text-red">*</span></label>
			<input type="text" name="last_name[]" class="form-control last_name" value="<?= $person['last_name'];?>" id="last_name<?= $tab_index;?>"/>
			<div class="error_field last_name<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-3">
			<label for="first_name<?= $tab_index;?>"><?= $this->lang->line('first_name');?></label>
			<input type="text" name="first_name[]" class="form-control first_name" value="<?= $person['first_name'];?>" id="first_name<?= $tab_index;?>"/>
			<div class="error_field first_name<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-3">
			<label for="marital_status<?= $tab_index;?>"><?= $this->lang->line('marital_status');?></label>
			<select id="marital_status<?= $tab_index;?>" class="form-control"  name="marital_status[]">
				<option value="5" <?= ($person['marital_status'] == '5') ? 'selected' : '';?>></option>
				<option value="1" <?= ($person['marital_status'] == '1') ? 'selected' : '';?>>Célibataire</option>
				<option value="2" <?= ($person['marital_status'] == '2') ? 'selected' : '';?>>Marié(e)</option>
				<option value="3" <?= ($person['marital_status'] == '3') ? 'selected' : '';?>>Veuf/Veuve</option>
				<option value="4" <?= ($person['marital_status'] == '4') ? 'selected' : '';?>>Divorcé(e)</option>
			</select>
			<div class="error_field marital_status<?= $tab_index;?>Error"></div>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-3">
			<label for="parent_link<?= $tab_index;?>"><?= $this->lang->line('parent_link');?></label>
			<select id="parent_link<?= $tab_index;?>" class="form-control parent_link"  onchange="controlFilsFille('#parent_link<?= $tab_index;?>', '#sexe<?= $tab_index;?>');" name="parent_link[]">
				<?php
					$other_pl = '';
					$style = 'display:none;';

					if($person['parent_link'] != '0' && $person['parent_link'] != 'pere' && $person['parent_link'] != 'mere' && $person['parent_link'] != 'fils' && $person['parent_link'] != 'fille'){
						$other_pl = 'selected';
						$style = '';
					}
				?>
				<option value="0" <?= ($person['parent_link'] == 0) ? 'selected' : '';?>></option>
				<option value="pere" <?= ($person['parent_link'] == 'pere') ? 'selected' : '';?>>Père</option>
				<option value="mere" <?= ($person['parent_link'] == 'mere') ? 'selected' : '';?>>Mère</option>
				<option value="fils" <?= ($person['parent_link'] == 'fils') ? 'selected' : '';?>>Fils</option>
				<option value="fille" <?= ($person['parent_link'] == 'fille') ? 'selected' : '';?>>Fille</option>
				<option value="autre" <?= $other_pl;?>>Autres</option>
			</select>
			<input type="text" name="other_pl[]" value="<?= $person['parent_link'];?>" id="otherParentLink<?= $tab_index;?>" placeholder="Préciser le lien de parenté" style="<?= $style;?> margin-top: 3px;" class="form-control" />
			<div class="error_field parent_link<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-3">
			<label for="birth<?= $tab_index;?>"><?= $this->lang->line('birth');?><span class="text-red">*</span></label>
			<input type="text" placeholder="jj/mm/aaaa" value="<?= $person['birth'];?>" class="form-control date_type" name="birth[]" id="birth<?= $tab_index;?>"/>
			<div class="error_field birth<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-4">
			<label for="birth_place<?= $tab_index;?>"><?= $this->lang->line('birth_place');?><span class="text-red">*</span></label>
			<input type="text" class="form-control" value="<?= $person['birth_place'];?>" name="birth_place[]" id="birth_place<?= $tab_index;?>"/>
			<div class="error_field birth_place<?= $tab_index;?>Error"></div>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-3">
			<label for="sexe<?= $tab_index;?>"><?= $this->lang->line('sexe');?></label>
			<select id="sexe<?= $tab_index;?>" class="form-control" name="sexe[]">
				<option value="2" <?= ($person['sexe'] == '2') ? 'selected' : '';?>></option>
				<option value="1" <?= ($person['sexe'] == '1') ? 'selected' : '';?>>Homme</option>
				<option value="0" <?= ($person['sexe'] == '0') ? 'selected' : '';?>>Femme</option>
			</select>
			<div class="error_field sexe<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-3">
			<label for="handicapped<?= $tab_index;?>"><?= $this->lang->line('handicapped');?></label>
			<select id="handicapped<?= $tab_index;?>" class="form-control" name="handicapped[]">
				<option value="0" <?= ($person['handicapped'] == '0') ? 'selected' : '';?>>Non</option>
				<option value="1" <?= ($person['handicapped'] == '1') ? 'selected' : '';?>>Oui</option>
			</select>
			<div class="error_field handicapped<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-4">
			<label for="nationality<?= $tab_index;?>"><?= $this->lang->line('nationnality');?></label>
			<select class="form-control nationality" name="nationality[]" class="form-control" id="nationality<?= $tab_index;?>">
				<option <?= ($person['nationality'] == "Malgache") ? 'selected' : '';?> value="Malgache">Malgache</option>
				<option <?= ($person['nationality'] == "Française") ? 'selected' : '';?> value="Française">Française</option>
				<option <?= ($person['nationality'] == "Americaine") ? 'selected' : '';?> value="Americaine">Americaine</option>
				<option <?= ($person['nationality'] == "Afghane") ? 'selected' : '';?> value="Afghane">Afghane</option>
				<option <?= ($person['nationality'] == "Albanaise") ? 'selected' : '';?> value="Albanaise">Albanaise</option>
				<option <?= ($person['nationality'] == "Algerienne") ? 'selected' : '';?> value="Algerienne">Algerienne</option>
				<option <?= ($person['nationality'] == "Allemande") ? 'selected' : '';?> value="Allemande">Allemande</option>
				<option <?= ($person['nationality'] == "Andorrane") ? 'selected' : '';?> value="Andorrane">Andorrane</option>
				<option <?= ($person['nationality'] == "Angolaise") ? 'selected' : '';?> value="Angolaise">Angolaise</option>
				<option <?= ($person['nationality'] == "Antiguaise et barbudienne") ? 'selected' : '';?> value="Antiguaise et barbudienne">Antiguaise et barbudienne</option>
				<option <?= ($person['nationality'] == "Argentine") ? 'selected' : '';?> value="Argentine">Argentine</option>
				<option <?= ($person['nationality'] == "Armenienne") ? 'selected' : '';?> value="Armenienne">Armenienne</option>
				<option <?= ($person['nationality'] == "Australienne") ? 'selected' : '';?> value="Australienne">Australienne</option>
				<option <?= ($person['nationality'] == "Autrichienne") ? 'selected' : '';?> value="Autrichienne">Autrichienne</option>
				<option <?= ($person['nationality'] == "Azerbaïdjanaise") ? 'selected' : '';?> value="Azerbaïdjanaise">Azerbaïdjanaise</option>
				<option <?= ($person['nationality'] == "Bahamienne") ? 'selected' : '';?> value="Bahamienne">Bahamienne</option>
				<option <?= ($person['nationality'] == "Bahreinienne") ? 'selected' : '';?> value="Bahreinienne">Bahreinienne</option>
				<option <?= ($person['nationality'] == "Bangladaise") ? 'selected' : '';?> value="Bangladaise">Bangladaise</option>
				<option <?= ($person['nationality'] == "Barbadienne") ? 'selected' : '';?> value="Barbadienne">Barbadienne</option>
				<option <?= ($person['nationality'] == "Belge") ? 'selected' : '';?> value="Belge">Belge</option>
				<option <?= ($person['nationality'] == "Belizienne") ? 'selected' : '';?> value="Belizienne">Belizienne</option>
				<option <?= ($person['nationality'] == "Beninoise") ? 'selected' : '';?> value="Beninoise">Beninoise</option>
				<option <?= ($person['nationality'] == "Bhoutanaise") ? 'selected' : '';?> value="Bhoutanaise">Bhoutanaise</option>
				<option <?= ($person['nationality'] == "Bielorusse") ? 'selected' : '';?> value="Bielorusse">Bielorusse</option>
				<option <?= ($person['nationality'] == "Birmane") ? 'selected' : '';?> value="Birmane">Birmane</option>
				<option <?= ($person['nationality'] == "Bissau-Guinéenne") ? 'selected' : '';?> value="Bissau-Guinéenne">Bissau-Guinéenne</option>
				<option <?= ($person['nationality'] == "Bolivienne") ? 'selected' : '';?> value="Bolivienne">Bolivienne</option>
				<option <?= ($person['nationality'] == "Bosnienne") ? 'selected' : '';?> value="Bosnienne">Bosnienne</option>
				<option <?= ($person['nationality'] == "Botswanaise") ? 'selected' : '';?> value="Botswanaise">Botswanaise</option>
				<option <?= ($person['nationality'] == "Bresilienne") ? 'selected' : '';?> value="Bresilienne">Bresilienne</option>
				<option <?= ($person['nationality'] == "Britannique") ? 'selected' : '';?> value="Britannique">Britannique</option>
				<option <?= ($person['nationality'] == "Bruneienne") ? 'selected' : '';?> value="Bruneienne">Bruneienne</option>
				<option <?= ($person['nationality'] == "Bulgare") ? 'selected' : '';?> value="Bulgare">Bulgare</option>
				<option <?= ($person['nationality'] == "Burkinabe") ? 'selected' : '';?> value="Burkinabe">Burkinabe</option>
				<option <?= ($person['nationality'] == "Burundaise") ? 'selected' : '';?> value="Burundaise">Burundaise</option>
				<option <?= ($person['nationality'] == "Cambodgienne") ? 'selected' : '';?> value="Cambodgienne">Cambodgienne</option>
				<option <?= ($person['nationality'] == "Camerounaise") ? 'selected' : '';?> value="Camerounaise">Camerounaise</option>
				<option <?= ($person['nationality'] == "Canadienne") ? 'selected' : '';?> value="Canadienne">Canadienne</option>
				<option <?= ($person['nationality'] == "Cap-verdienne") ? 'selected' : '';?> value="Cap-verdienne">Cap-verdienne</option>
				<option <?= ($person['nationality'] == "Centrafricaine") ? 'selected' : '';?> value="Centrafricaine">Centrafricaine</option>
				<option <?= ($person['nationality'] == "Chilienne") ? 'selected' : '';?> value="Chilienne">Chilienne</option>
				<option <?= ($person['nationality'] == "Chinoise") ? 'selected' : '';?> value="Chinoise">Chinoise</option>
				<option <?= ($person['nationality'] == "Chypriote") ? 'selected' : '';?> value="Chypriote">Chypriote</option>
				<option <?= ($person['nationality'] == "Colombienne") ? 'selected' : '';?> value="Colombienne">Colombienne</option>
				<option <?= ($person['nationality'] == "Comorienne") ? 'selected' : '';?> value="Comorienne">Comorienne</option>
				<option <?= ($person['nationality'] == "Congolaise") ? 'selected' : '';?> value="Congolaise">Congolaise</option>
				<option <?= ($person['nationality'] == "Costaricaine") ? 'selected' : '';?> value="Costaricaine">Costaricaine</option>
				<option <?= ($person['nationality'] == "Croate") ? 'selected' : '';?> value="Croate">Croate</option>
				<option <?= ($person['nationality'] == "Cubaine") ? 'selected' : '';?> value="Cubaine">Cubaine</option>
				<option <?= ($person['nationality'] == "Danoise") ? 'selected' : '';?> value="Danoise">Danoise</option>
				<option <?= ($person['nationality'] == "Djiboutienne") ? 'selected' : '';?> value="Djiboutienne">Djiboutienne</option>
				<option <?= ($person['nationality'] == "Dominicaine") ? 'selected' : '';?> value="Dominicaine">Dominicaine</option>
				<option <?= ($person['nationality'] == "Dominiquaise") ? 'selected' : '';?> value="Dominiquaise">Dominiquaise</option>
				<option <?= ($person['nationality'] == "Egyptienne") ? 'selected' : '';?> value="Egyptienne">Egyptienne</option>
				<option <?= ($person['nationality'] == "Emirienne") ? 'selected' : '';?> value="Emirienne">Emirienne</option>
				<option <?= ($person['nationality'] == "Equato-guineenne") ? 'selected' : '';?> value="Equato-guineenne">Equato-guineenne</option>
				<option <?= ($person['nationality'] == "Equatorienne") ? 'selected' : '';?> value="Equatorienne">Equatorienne</option>
				<option <?= ($person['nationality'] == "Erythreenne") ? 'selected' : '';?> value="Erythreenne">Erythreenne</option>
				<option <?= ($person['nationality'] == "Espagnole") ? 'selected' : '';?> value="Espagnole">Espagnole</option>
				<option <?= ($person['nationality'] == "Est-timoraise") ? 'selected' : '';?> value="Est-timoraise">Est-timoraise</option>
				<option <?= ($person['nationality'] == "Estonienne") ? 'selected' : '';?> value="Estonienne">Estonienne</option>
				<option <?= ($person['nationality'] == "Ethiopienne") ? 'selected' : '';?> value="Ethiopienne">Ethiopienne</option>
				<option <?= ($person['nationality'] == "Fidjienne") ? 'selected' : '';?> value="Fidjienne">Fidjienne</option>
				<option <?= ($person['nationality'] == "Finlandaise") ? 'selected' : '';?> value="Finlandaise">Finlandaise</option>
				<option <?= ($person['nationality'] == "Gabonaise") ? 'selected' : '';?> value="Gabonaise">Gabonaise</option>
				<option <?= ($person['nationality'] == "Gambienne") ? 'selected' : '';?> value="Gambienne">Gambienne</option>
				<option <?= ($person['nationality'] == "Georgienne") ? 'selected' : '';?> value="Georgienne">Georgienne</option>
				<option <?= ($person['nationality'] == "Ghaneenne") ? 'selected' : '';?> value="Ghaneenne">Ghaneenne</option>
				<option <?= ($person['nationality'] == "Grenadienne") ? 'selected' : '';?> value="Grenadienne">Grenadienne</option>
				<option <?= ($person['nationality'] == "Guatemalteque") ? 'selected' : '';?> value="Guatemalteque">Guatemalteque</option>
				<option <?= ($person['nationality'] == "Guineenne") ? 'selected' : '';?> value="Guineenne">Guineenne</option>
				<option <?= ($person['nationality'] == "Guyanienne") ? 'selected' : '';?> value="Guyanienne">Guyanienne</option>
				<option <?= ($person['nationality'] == "Haïtienne") ? 'selected' : '';?> value="Haïtienne">Haïtienne</option>
				<option <?= ($person['nationality'] == "Hellenique") ? 'selected' : '';?> value="Hellenique">Hellenique</option>
				<option <?= ($person['nationality'] == "Hondurienne") ? 'selected' : '';?> value="Hondurienne">Hondurienne</option>
				<option <?= ($person['nationality'] == "Hongroise") ? 'selected' : '';?> value="Hongroise">Hongroise</option>
				<option <?= ($person['nationality'] == "Indienne") ? 'selected' : '';?> value="Indienne">Indienne</option>
				<option <?= ($person['nationality'] == "Indonesienne") ? 'selected' : '';?> value="Indonesienne">Indonesienne</option>
				<option <?= ($person['nationality'] == "Irakienne") ? 'selected' : '';?> value="Irakienne">Irakienne</option>
				<option <?= ($person['nationality'] == "Irlandaise") ? 'selected' : '';?> value="Irlandaise">Irlandaise</option>
				<option <?= ($person['nationality'] == "Islandaise") ? 'selected' : '';?> value="Islandaise">Islandaise</option>
				<option <?= ($person['nationality'] == "Israélienne") ? 'selected' : '';?> value="Israélienne">Israélienne</option>
				<option <?= ($person['nationality'] == "Italienne") ? 'selected' : '';?> value="Italienne">Italienne</option>
				<option <?= ($person['nationality'] == "Ivoirienne") ? 'selected' : '';?> value="Ivoirienne">Ivoirienne</option>
				<option <?= ($person['nationality'] == "Jamaïcaine") ? 'selected' : '';?> value="Jamaïcaine">Jamaïcaine</option>
				<option <?= ($person['nationality'] == "Japonaise") ? 'selected' : '';?> value="Japonaise">Japonaise</option>
				<option <?= ($person['nationality'] == "Jordanienne") ? 'selected' : '';?> value="Jordanienne">Jordanienne</option>
				<option <?= ($person['nationality'] == "Kazakhstanaise") ? 'selected' : '';?> value="Kazakhstanaise">Kazakhstanaise</option>
				<option <?= ($person['nationality'] == "Kenyane") ? 'selected' : '';?> value="Kenyane">Kenyane</option>
				<option <?= ($person['nationality'] == "Kirghize") ? 'selected' : '';?> value="Kirghize">Kirghize</option>
				<option <?= ($person['nationality'] == "Kiribatienne") ? 'selected' : '';?> value="Kiribatienne">Kiribatienne</option>
				<option <?= ($person['nationality'] == "Kittitienne-et-nevicienne") ? 'selected' : '';?> value="Kittitienne-et-nevicienne">Kittitienne-et-nevicienne</option>
				<option <?= ($person['nationality'] == "Kossovienne") ? 'selected' : '';?> value="Kossovienne">Kossovienne</option>
				<option <?= ($person['nationality'] == "Koweitienne") ? 'selected' : '';?> value="Koweitienne">Koweitienne</option>
				<option <?= ($person['nationality'] == "Laotienne") ? 'selected' : '';?> value="Laotienne">Laotienne</option>
				<option <?= ($person['nationality'] == "Lesothane") ? 'selected' : '';?> value="Lesothane">Lesothane</option>
				<option <?= ($person['nationality'] == "Lettone") ? 'selected' : '';?> value="Lettone">Lettone</option>
				<option <?= ($person['nationality'] == "Libanaise") ? 'selected' : '';?> value="Libanaise">Libanaise</option>
				<option <?= ($person['nationality'] == "Liberienne") ? 'selected' : '';?> value="Liberienne">Liberienne</option>
				<option <?= ($person['nationality'] == "Libyenne") ? 'selected' : '';?> value="Libyenne">Libyenne</option>
				<option <?= ($person['nationality'] == "Liechtensteinoise") ? 'selected' : '';?> value="Liechtensteinoise">Liechtensteinoise</option>
				<option <?= ($person['nationality'] == "Lituanienne") ? 'selected' : '';?> value="Lituanienne">Lituanienne</option>
				<option <?= ($person['nationality'] == "Luxembourgeoise") ? 'selected' : '';?> value="Luxembourgeoise">Luxembourgeoise</option>
				<option <?= ($person['nationality'] == "Macedonienne") ? 'selected' : '';?> value="Macedonienne">Macedonienne</option>
				<option <?= ($person['nationality'] == "Malaisienne") ? 'selected' : '';?> value="Malaisienne">Malaisienne</option>
				<option <?= ($person['nationality'] == "Malawienne") ? 'selected' : '';?> value="Malawienne">Malawienne</option>
				<option <?= ($person['nationality'] == "Maldivienne") ? 'selected' : '';?> value="Maldivienne">Maldivienne</option>
				<option <?= ($person['nationality'] == "Malienne") ? 'selected' : '';?> value="Malienne">Malienne</option>
				<option <?= ($person['nationality'] == "Maltaise") ? 'selected' : '';?> value="Maltaise">Maltaise</option>
				<option <?= ($person['nationality'] == "Marocaine") ? 'selected' : '';?> value="Marocaine">Marocaine</option>
				<option <?= ($person['nationality'] == "Marshallaise") ? 'selected' : '';?> value="Marshallaise">Marshallaise</option>
				<option <?= ($person['nationality'] == "Mauricienne") ? 'selected' : '';?> value="Mauricienne">Mauricienne</option>
				<option <?= ($person['nationality'] == "Mauritanienne") ? 'selected' : '';?> value="Mauritanienne">Mauritanienne</option>
				<option <?= ($person['nationality'] == "Mexicaine") ? 'selected' : '';?> value="Mexicaine">Mexicaine</option>
				<option <?= ($person['nationality'] == "Micronesienne") ? 'selected' : '';?> value="Micronesienne">Micronesienne</option>
				<option <?= ($person['nationality'] == "Moldave") ? 'selected' : '';?> value="Moldave">Moldave</option>
				<option <?= ($person['nationality'] == "Monegasque") ? 'selected' : '';?> value="Monegasque">Monegasque</option>
				<option <?= ($person['nationality'] == "Mongole") ? 'selected' : '';?> value="Mongole">Mongole</option>
				<option <?= ($person['nationality'] == "Montenegrine") ? 'selected' : '';?> value="Montenegrine">Montenegrine</option>
				<option <?= ($person['nationality'] == "Mozambicaine") ? 'selected' : '';?> value="Mozambicaine">Mozambicaine</option>
				<option <?= ($person['nationality'] == "Namibienne") ? 'selected' : '';?> value="Namibienne">Namibienne</option>
				<option <?= ($person['nationality'] == "Nauruane") ? 'selected' : '';?> value="Nauruane">Nauruane</option>
				<option <?= ($person['nationality'] == "Neerlandaise") ? 'selected' : '';?> value="Neerlandaise">Neerlandaise</option>
				<option <?= ($person['nationality'] == "Neo-zelandaise") ? 'selected' : '';?> value="Neo-zelandaise">Neo-zelandaise</option>
				<option <?= ($person['nationality'] == "Nepalaise") ? 'selected' : '';?> value="Nepalaise">Nepalaise</option>
				<option <?= ($person['nationality'] == "Nicaraguayenne") ? 'selected' : '';?> value="Nicaraguayenne">Nicaraguayenne</option>
				<option <?= ($person['nationality'] == "Nigeriane") ? 'selected' : '';?> value="Nigeriane">Nigeriane</option>
				<option <?= ($person['nationality'] == "Nigerienne") ? 'selected' : '';?> value="Nigerienne">Nigerienne</option>
				<option <?= ($person['nationality'] == "Nord-coréenne") ? 'selected' : '';?> value="Nord-coréenne">Nord-coréenne</option>
				<option <?= ($person['nationality'] == "Norvegienne") ? 'selected' : '';?> value="Norvegienne">Norvegienne</option>
				<option <?= ($person['nationality'] == "Omanaise") ? 'selected' : '';?> value="Omanaise">Omanaise</option>
				<option <?= ($person['nationality'] == "Ougandaise") ? 'selected' : '';?> value="Ougandaise">Ougandaise</option>
				<option <?= ($person['nationality'] == "Ouzbeke") ? 'selected' : '';?> value="Ouzbeke">Ouzbeke</option>
				<option <?= ($person['nationality'] == "Pakistanaise") ? 'selected' : '';?> value="Pakistanaise">Pakistanaise</option>
				<option <?= ($person['nationality'] == "Palau") ? 'selected' : '';?> value="Palau">Palau</option>
				<option <?= ($person['nationality'] == "Palestinienne") ? 'selected' : '';?> value="Palestinienne">Palestinienne</option>
				<option <?= ($person['nationality'] == "Panameenne") ? 'selected' : '';?> value="Panameenne">Panameenne</option>
				<option <?= ($person['nationality'] == "Papouane-neoguineenne") ? 'selected' : '';?> value="Papouane-neoguineenne">Papouane-neoguineenne</option>
				<option <?= ($person['nationality'] == "Paraguayenne") ? 'selected' : '';?> value="Paraguayenne">Paraguayenne</option>
				<option <?= ($person['nationality'] == "Peruvienne") ? 'selected' : '';?> value="Peruvienne">Peruvienne</option>
				<option <?= ($person['nationality'] == "Philippine") ? 'selected' : '';?> value="Philippine">Philippine</option>
				<option <?= ($person['nationality'] == "Polonaise") ? 'selected' : '';?> value="Polonaise">Polonaise</option>
				<option <?= ($person['nationality'] == "Portoricaine") ? 'selected' : '';?> value="Portoricaine">Portoricaine</option>
				<option <?= ($person['nationality'] == "Portugaise") ? 'selected' : '';?> value="Portugaise">Portugaise</option>
				<option <?= ($person['nationality'] == "Qatarienne") ? 'selected' : '';?> value="Qatarienne">Qatarienne</option>
				<option <?= ($person['nationality'] == "Roumaine") ? 'selected' : '';?> value="Roumaine">Roumaine</option>
				<option <?= ($person['nationality'] == "Russe") ? 'selected' : '';?> value="Russe">Russe</option>
				<option <?= ($person['nationality'] == "Rwandaise") ? 'selected' : '';?> value="Rwandaise">Rwandaise</option>
				<option <?= ($person['nationality'] == "Saint-lucienne") ? 'selected' : '';?> value="Saint-lucienne">Saint-lucienne</option>
				<option <?= ($person['nationality'] == "Saint-marinaise") ? 'selected' : '';?> value="Saint-marinaise">Saint-marinaise</option>
				<option <?= ($person['nationality'] == "Saint-vincentaise-et-grenadine") ? 'selected' : '';?> value="Saint-vincentaise-et-grenadine">Saint-vincentaise-et-grenadine</option>
				<option <?= ($person['nationality'] == "Salomonaise") ? 'selected' : '';?> value="Salomonaise">Salomonaise</option>
				<option <?= ($person['nationality'] == "Salvadorienne") ? 'selected' : '';?> value="Salvadorienne">Salvadorienne</option>
				<option <?= ($person['nationality'] == "Samoane") ? 'selected' : '';?> value="Samoane">Samoane</option>
				<option <?= ($person['nationality'] == "Santomeenne") ? 'selected' : '';?> value="Santomeenne">Santomeenne</option>
				<option <?= ($person['nationality'] == "Saoudienne") ? 'selected' : '';?> value="Saoudienne">Saoudienne</option>
				<option <?= ($person['nationality'] == "Senegalaise") ? 'selected' : '';?> value="Senegalaise">Senegalaise</option>
				<option <?= ($person['nationality'] == "Serbe") ? 'selected' : '';?> value="Serbe">Serbe</option>
				<option <?= ($person['nationality'] == "Seychelloise") ? 'selected' : '';?> value="Seychelloise">Seychelloise</option>
				<option <?= ($person['nationality'] == "Sierra-leonaise") ? 'selected' : '';?> value="Sierra-leonaise">Sierra-leonaise</option>
				<option <?= ($person['nationality'] == "Singapourienne") ? 'selected' : '';?> value="Singapourienne">Singapourienne</option>
				<option <?= ($person['nationality'] == "Slovaque") ? 'selected' : '';?> value="Slovaque">Slovaque</option>
				<option <?= ($person['nationality'] == "Slovene") ? 'selected' : '';?> value="Slovene">Slovene</option>
				<option <?= ($person['nationality'] == "Somalienne") ? 'selected' : '';?> value="Somalienne">Somalienne</option>
				<option <?= ($person['nationality'] == "Soudanaise") ? 'selected' : '';?> value="Soudanaise">Soudanaise</option>
				<option <?= ($person['nationality'] == "Sri-lankaise") ? 'selected' : '';?> value="Sri-lankaise">Sri-lankaise</option>
				<option <?= ($person['nationality'] == "Sud-africaine") ? 'selected' : '';?> value="Sud-africaine">Sud-africaine</option>
				<option <?= ($person['nationality'] == "Sud-coréenne") ? 'selected' : '';?> value="Sud-coréenne">Sud-coréenne</option>
				<option <?= ($person['nationality'] == "Suedoise") ? 'selected' : '';?> value="Suedoise">Suedoise</option>
				<option <?= ($person['nationality'] == "Suisse") ? 'selected' : '';?> value="Suisse">Suisse</option>
				<option <?= ($person['nationality'] == "Surinamaise") ? 'selected' : '';?> value="Surinamaise">Surinamaise</option>
				<option <?= ($person['nationality'] == "Swazie") ? 'selected' : '';?> value="Swazie">Swazie</option>
				<option <?= ($person['nationality'] == "Syrienne") ? 'selected' : '';?> value="Syrienne">Syrienne</option>
				<option <?= ($person['nationality'] == "Tadjike") ? 'selected' : '';?> value="Tadjike">Tadjike</option>
				<option <?= ($person['nationality'] == "Taiwanaise") ? 'selected' : '';?> value="Taiwanaise">Taiwanaise</option>
				<option <?= ($person['nationality'] == "Tanzanienne") ? 'selected' : '';?> value="Tanzanienne">Tanzanienne</option>
				<option <?= ($person['nationality'] == "Tchadienne") ? 'selected' : '';?> value="Tchadienne">Tchadienne</option>
				<option <?= ($person['nationality'] == "Tcheque") ? 'selected' : '';?> value="Tcheque">Tcheque</option>
				<option <?= ($person['nationality'] == "Thaïlandaise") ? 'selected' : '';?> value="Thaïlandaise">Thaïlandaise</option>
				<option <?= ($person['nationality'] == "Togolaise") ? 'selected' : '';?> value="Togolaise">Togolaise</option>
				<option <?= ($person['nationality'] == "Tonguienne") ? 'selected' : '';?> value="Tonguienne">Tonguienne</option>
				<option <?= ($person['nationality'] == "Trinidadienne") ? 'selected' : '';?> value="Trinidadienne">Trinidadienne</option>
				<option <?= ($person['nationality'] == "Tunisienne") ? 'selected' : '';?> value="Tunisienne">Tunisienne</option>
				<option <?= ($person['nationality'] == "Turkmene") ? 'selected' : '';?> value="Turkmene">Turkmene</option>
				<option <?= ($person['nationality'] == "Turque") ? 'selected' : '';?> value="Turque">Turque</option>
				<option <?= ($person['nationality'] == "Tuvaluane") ? 'selected' : '';?> value="Tuvaluane">Tuvaluane</option>
				<option <?= ($person['nationality'] == "Ukrainienne") ? 'selected' : '';?> value="Ukrainienne">Ukrainienne</option>
				<option <?= ($person['nationality'] == "Uruguayenne") ? 'selected' : '';?> value="Uruguayenne">Uruguayenne</option>
				<option <?= ($person['nationality'] == "Vanuatuane") ? 'selected' : '';?> value="Vanuatuane">Vanuatuane</option>
				<option <?= ($person['nationality'] == "Venezuelienne") ? 'selected' : '';?> value="Venezuelienne">Venezuelienne</option>
				<option <?= ($person['nationality'] == "Vietnamienne") ? 'selected' : '';?> value="Vietnamienne">Vietnamienne</option>
				<option <?= ($person['nationality'] == "Yemenite") ? 'selected' : '';?> value="Yemenite">Yemenite</option>
				<option <?= ($person['nationality'] == "Zambienne") ? 'selected' : '';?> value="Zambienne">Zambienne</option>
				<option <?= ($person['nationality'] == "Zimbabweenne") ? 'selected' : '';?> value="Zimbabweenne">Zimbabweenne</option>
			</select>
			<div class="error_field nationality<?= $tab_index;?>Error"></div>
		</div>
	</div>
	<?php
		$display_cin = 'style="display:none;"';
		$display_passport = 'style="display:none;"';
		if($person['nationality'] == "Malgache"  || $person['nationality'] == '0') $display_cin = '';
		else $display_passport = '';
	?>
	<div class="form-row cin-container-<?= $tab_index;?>" <?= $display_cin;?>>
		<div class="form-group col-md-3">
			<label for="cin<?= $tab_index;?>"><?= $this->lang->line('cin');?></label>
			<input type="text" maxlength="15" value="<?= $person['cin'];?>" placeholder="000 000 000 000" class="form-control cin" name="cin[]" id="cin<?= $tab_index;?>"/>
			<div class="error_field cin<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-3"  <?= $display_cin;?>>
			<label for="cin_date<?= $tab_index;?>"><?= $this->lang->line('cin_date');?></label>
			<input type="text" class="form-control date_type" placeholder="jj/mm/aaaa" value="<?= $person['cin_date'];?>" name="cin_date[]" id="cin_date<?= $tab_index;?>"/>
			<div class="error_field cin_date<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-3" <?= $display_cin;?>>
			<label for="cin_place<?= $tab_index;?>"><?= $this->lang->line('cin_place');?></label>
			<input type="text" class="form-control" value="<?= $person['cin_place'];?>" name="cin_place[]" id="cin_place<?= $tab_index;?>"/>
			<div class="error_field cin_place<?= $tab_index;?>Error"></div>
		</div>
	</div>
	<div class="form-row passport-container-<?= $tab_index;?>" <?= $display_passport;?>>
		<div class="form-group col-md-4">
			<label for="passport<?= $tab_index;?>">Numéro CIN/Passeport/Carte de résident</label>
			<input type="text" class="form-control"  maxlenght="20" placeholder="xxxxxxxxxxxxxxxxxxxx" value="<?= $person['passport'];?>" name="passport[]" id="passport<?= $tab_index;?>"/>
			<div class="error_field passport<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-4">
			<label for="passport_date<?= $tab_index;?>">Date CIN/Passeport/Carte de résident</label>
			<input type="text" class="form-control date_type" value="<?= $person['passport_date'];?>" placeholder="jj/mm/aaaa" name="passport_date[]" id="passport_date<?= $tab_index;?>"/>
			<div class="error_field passport_date<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-4">
			<label for="passport_place<?= $tab_index;?>">Lieu CIN/Passeport/Carte de résident</label>
			<input type="text" class="form-control" value="<?= $person['passport_place'];?>" placeholder="..." name="passport_place[]" id="passport_place<?= $tab_index;?>"/>
			<div class="error_field passport_place<?= $tab_index;?>Error"></div>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-4">
			<label for="father<?= $tab_index;?>"><?= $this->lang->line('father');?></label>
			<input type="text" value="<?= $person['father'];?>" class="form-control father" name="father[]" id="father<?= $tab_index;?>"/>
			<div class="error_field father<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-2">
			<label for="father_status<?= $tab_index;?>"><?= $this->lang->line('father_status');?></label>
			<select name="father_status[]"  class="form-control" id="father_status<?= $tab_index;?>">
				<option value="0" <?= ($person['father_status'] == '0') ? 'selected' : '';?>>Vivant</option>
				<option value="1" <?= ($person['father_status'] == '1') ? 'selected' : '';?>>Mort</option>
			</select>
			<div class="error_field father_status<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-4">
			<label for="mother<?= $tab_index;?>"><?= $this->lang->line('mother');?></label>
			<input type="text" class="form-control" value="<?= $person['mother'];?>" name="mother[]" id="mother<?= $tab_index;?>"/>
			<div class="error_field mother<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-2">
			<label for="mother_status<?= $tab_index;?>"><?= $this->lang->line('mother_status');?></label>
			<select name="mother_status[]"  class="form-control" id="mother_status<?= $tab_index;?>">
				<option value="0" <?= ($person['mother_status'] == '0') ? 'selected' : '';?>>Vivante</option>
				<option value="1" <?= ($person['mother_status'] == '1') ? 'selected' : '';?>>Morte</option>
			</select>
			<div class="error_field mother_status<?= $tab_index;?>Error"></div>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-4">
			<label for="phone<?= $tab_index;?>"><?= $this->lang->line('phone');?></label>
			<input type="text" value="<?= $person['phone'];?>" placeholder="032 00 000 00; 033 00 000 00; 034 00 000 00" class="form-control" name="phone[]" id="phone<?= $tab_index;?>"/>
			<div class="error_field phone<?= $tab_index;?>Error"></div>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-4">
			<label for="job<?= $tab_index;?>"><?= $this->lang->line('job');?></label>
			<select id="job<?= $tab_index;?>" class="form-control job" name="job[]">
				<option value="-1" <?= ($person['job'] == -1) ? 'selected' : '';?>></option>
				<?php foreach ($jobs as $key => $job): ?>
					<option value="<?= $job->id;?>" <?= ($job->id == $person['job']) ? 'selected' : '';?>><?= $job->id;?> - <?= $this->lang->line('mg_job_'.$job->id);?> - <?= $this->lang->line('fr_job_'.$job->id);?></option>
				<?php endforeach ?>
					<option value="0" <?= ($person['job'] == 0) ? 'selected' : '';?>>Autres</option>
			</select>
			<?php 
				$style = ($person['job'] != 0) ? 'display:none;' : '';
			?>
			<input type="text" value="<?= $person['job_other'];?>" name="other_job[]" id="otherJob<?= $tab_index;?>" placeholder="Préciser la profession" style="<?= $style;?> margin-top: 3px;" class="form-control" />
			<div class="error_field job<?= $tab_index;?>Error"></div>
		</div>
		<div class="form-group col-md-3"></div>
		<div class="form-group col-md-5">
			<label for="job_status"><?= $this->lang->line('job_status');?></label>
			<input type="text" class="form-control"  value="<?= $person['job_status'];?>" name="job_status[]" id="job_status"/>
			<div class="error_field job_statusError"></div>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-12">
			<label for="observation"><?= $this->lang->line('observation');?></label>
			<textarea class="form-control" value="<?= $person['observation'];?>" placeholer="..." name="observation[]" id="observation"></textarea>
			<div class="error_field observationError"></div>
		</div>
	</div>
</div>