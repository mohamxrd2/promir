
function disparition_table(){
    if(document.getElementById("aucunelement")){
        document.getElementById("personnelTable").style.display = 'none';
    }
}



function addPaymentDateSection(){
    var compt = 0;
    document.querySelectorAll('.ajouter_date_payement').forEach(function(btn){
        btn.addEventListener('click', function() {
            let container = document.getElementById('sections_container');
            let newSection = document.createElement('div');
            newSection.classList.add('flex', 'mb-2', 'section');
            let dateReglementDiv = document.createElement('div');
            dateReglementDiv.classList.add('col', 'mr-2', 'w-full');
            dateReglementDiv.id = 'date_reglement_div' + String(compt);
            
            let dateLabel = document.createElement('label');
            dateLabel.setAttribute('for', 'date_reglement');
            dateLabel.textContent = 'Date de règlement';
            dateReglementDiv.appendChild(dateLabel);
            
            let dateInput = document.createElement('input');
            dateInput.setAttribute('required', true);
            dateInput.setAttribute('type', 'date');
            dateInput.setAttribute('name', 'date_reglement[]');
            dateInput.classList.add('date_reglement', 'row', 'ltr:pl-8', 'rtl:pr-8', 'form-input', 'border-slate-200', 'dark:border-zink-500', 'focus:outline-none', 'focus:border-custom-500', 'disabled:bg-slate-100', 'dark:disabled:bg-zink-600', 'disabled:border-slate-300', 'dark:disabled:border-zink-500', 'dark:disabled:text-zink-200', 'disabled:text-slate-500', 'dark:text-zink-100', 'dark:bg-zink-700', 'dark:focus:border-custom-800', 'placeholder:text-slate-400', 'dark:placeholder:text-zink-200', 'mr-2', 'w-full');
            dateInput.setAttribute('placeholder', 'Tapez ici...');
            dateInput.setAttribute('autocomplete', 'on');
            dateInput.id = 'date_reglement' + String(compt);
            dateReglementDiv.appendChild(dateInput);

            // Créer le deuxième div pour 'Montant'
            let montantDiv = document.createElement('div');
            montantDiv.classList.add('col', 'mr-2', 'w-full');

            let montantLabel = document.createElement('label');
            montantLabel.setAttribute('for', 'montantARegler');
            montantLabel.textContent = 'Montant';
            montantDiv.appendChild(montantLabel);

            let montantInput = document.createElement('input');
            montantInput.setAttribute('required', true);
            montantInput.setAttribute('type', 'number');
            montantInput.setAttribute('step', 'any');
            montantInput.setAttribute('name', 'montantARegler[]');
            montantInput.classList.add('montantARegler', 'row', 'ltr:pl-8', 'rtl:pr-8', 'form-input', 'border-slate-200', 'dark:border-zink-500', 'focus:outline-none', 'focus:border-custom-500', 'disabled:bg-slate-100', 'dark:disabled:bg-zink-600', 'disabled:border-slate-300', 'dark:disabled:border-zink-500', 'dark:disabled:text-zink-200', 'disabled:text-slate-500', 'dark:text-zink-100', 'dark:bg-zink-700', 'dark:focus:border-custom-800', 'placeholder:text-slate-400', 'dark:placeholder:text-zink-200', 'mr-2', 'w-full');
            montantInput.setAttribute('placeholder', 'Tapez ici...');
            montantInput.setAttribute('autocomplete', 'on');
            montantDiv.appendChild(montantInput);

            // Ajouter les div créés à la nouvelle section
            newSection.appendChild(dateReglementDiv);
            newSection.appendChild(montantDiv);

            // Ajouter la nouvelle section au container
            container.appendChild(newSection);

            // S'assurer que le container est visible
            if(container.classList.contains('hidden')){
                container.classList.remove('hidden');
            }
            checkDateRange(String(compt));
            compt++;
        });
    });
}



function addReglementFutureSection(){
    document.querySelectorAll('.ajouter_date_payement').forEach(function(btn) {
        btn.addEventListener('click', function() {
            let container = document.getElementById('sections_container');
            let newSection = document.createElement('div'); 
            newSection.classList.add('reglementsSection');
    
            // Créer le conteneur flex pour les champs
            let flexDiv = document.createElement('div');
            flexDiv.classList.add('flex', 'mb-2');
    
            // Champ "Année"
            let anneeDiv = document.createElement('div');
            anneeDiv.classList.add('col', 'mr-2', 'w-full');
    
            let anneeLabel = document.createElement('label');
            anneeLabel.setAttribute('for', 'annee');
            anneeLabel.textContent = 'Année';
            anneeDiv.appendChild(anneeLabel);
    
            let anneeSelect = document.createElement('select');
            anneeSelect.setAttribute('name', 'annee[]');
            anneeSelect.setAttribute('required', true);
            anneeSelect.id = 'annee';
            anneeSelect.classList.add('ltr:pl-8', 'rtl:pr-8', 'form-select', 'border-slate-200', 'dark:border-zink-500', 'focus:outline-none', 'focus:border-custom-500', 'disabled:bg-slate-100', 'dark:disabled:bg-zink-600', 'disabled:border-slate-300', 'dark:disabled:border-zink-500', 'dark:disabled:text-zink-200', 'disabled:text-slate-500', 'dark:text-zink-100', 'dark:bg-zink-700', 'dark:focus:border-custom-800', 'placeholder:text-slate-400', 'dark:placeholder:text-zink-200', 'mr-2', 'w-full');
            
            // Ajouter les options pour les années
            let annees = ['Choisir ici', '2000', '2001', '2002', '2003', '2004', '2005', '2006', '2007', '2008', '2009', '2010'];
            annees.forEach(function(annee) {
                let option = document.createElement('option');
                if (annee === 'Choisir ici') {
                    option.setAttribute('disabled', true);
                    option.setAttribute('selected', true);
                }
                option.value = annee;
                option.textContent = annee;
                anneeSelect.appendChild(option);
            });
            anneeDiv.appendChild(anneeSelect);
    
            // Champ "Mois"
            let moisDiv = document.createElement('div');
            moisDiv.classList.add('col', 'mr-2', 'w-full');
    
            let moisLabel = document.createElement('label');
            moisLabel.setAttribute('for', 'mois');
            moisLabel.textContent = 'Mois';
            moisDiv.appendChild(moisLabel);
    
            let moisSelect = document.createElement('select');
            moisSelect.setAttribute('name', 'mois[]');
            moisSelect.setAttribute('required', true);
            moisSelect.id = 'mois';
            moisSelect.classList.add('ltr:pl-8', 'rtl:pr-8', 'form-select', 'border-slate-200', 'dark:border-zink-500', 'focus:outline-none', 'focus:border-custom-500', 'disabled:bg-slate-100', 'dark:disabled:bg-zink-600', 'disabled:border-slate-300', 'dark:disabled:border-zink-500', 'dark:disabled:text-zink-200', 'disabled:text-slate-500', 'dark:text-zink-100', 'dark:bg-zink-700', 'dark:focus:border-custom-800', 'placeholder:text-slate-400', 'dark:placeholder:text-zink-200', 'mr-2', 'w-full');
            
            // Ajouter les options pour les mois
            let mois = ['Choisir ici', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
            mois.forEach(function(moisName, index) {
                let option = document.createElement('option');
                if (moisName === 'Choisir ici') {
                    option.setAttribute('disabled', true);
                    option.setAttribute('selected', true);
                }
                option.value = index;
                option.textContent = moisName;
                moisSelect.appendChild(option);
            });
            moisDiv.appendChild(moisSelect);
    
            // Champ "Montant"
            let montantDiv = document.createElement('div');
            montantDiv.classList.add('col', 'mr-2', 'w-full');
    
            let montantLabel = document.createElement('label');
            montantLabel.setAttribute('for', 'montant_reglement');
            montantLabel.textContent = 'Montant en ' + (sessionStorage.getItem('devise') || 'XOF');
            montantDiv.appendChild(montantLabel);
    
            let montantInput = document.createElement('input');
            montantInput.setAttribute('required', true);
            montantInput.setAttribute('type', 'number');
            montantInput.setAttribute('step', 'any');
            montantInput.setAttribute('name', 'montant_reglement[]');
            montantInput.id = 'montant_reglement';
            montantInput.classList.add('ltr:pl-8', 'rtl:pr-8', 'form-input', 'border-slate-200', 'dark:border-zink-500', 'focus:outline-none', 'focus:border-custom-500', 'disabled:bg-slate-100', 'dark:disabled:bg-zink-600', 'disabled:border-slate-300', 'dark:disabled:border-zink-500', 'dark:disabled:text-zink-200', 'disabled:text-slate-500', 'dark:text-zink-100', 'dark:bg-zink-700', 'dark:focus:border-custom-800', 'placeholder:text-slate-400', 'dark:placeholder:text-zink-200', 'mr-2', 'w-full');
            montantInput.setAttribute('placeholder', 'Tapez ici...');
            montantInput.setAttribute('autocomplete', 'off');
            montantDiv.appendChild(montantInput);
    
            // Bouton de suppression
            let deleteDiv = document.createElement('div');
            deleteDiv.classList.add('col', 'mr-2', 'w-full');
    
            let deleteButton = document.createElement('button');
            deleteButton.setAttribute('type', 'button');
            deleteButton.classList.add('mt-6', 'text-white', 'btn', 'ml-8', 'bg-red-500', 'border-red-500', 'hover:text-white', 'hover:bg-red-600', 'hover:border-red-600', 'active:text-white', 'active:bg-red-600', 'active:border-red-600', 'active:ring', 'active:ring-red-100', 'dark:ring-red-400/20', 'mr-2');
            deleteButton.textContent = '-';
            deleteButton.addEventListener('click', function() {
                newSection.remove();
            });
            deleteDiv.appendChild(deleteButton);
    
            // Ajouter les champs dans le flexDiv
            flexDiv.appendChild(anneeDiv);
            flexDiv.appendChild(moisDiv);
            flexDiv.appendChild(montantDiv);
            flexDiv.appendChild(deleteDiv);
    
            // Ajouter flexDiv à la nouvelle section
            newSection.appendChild(flexDiv);
    
            // Ajouter la nouvelle section au container
            container.appendChild(newSection);
    
            // Rendre le container visible s'il est caché
            if (container.classList.contains('hidden')) {
                container.classList.remove('hidden');
            }
    
        });
    });
    
}



function checkDateRange(compt){
    document.getElementById('date_reglement' + compt).addEventListener('input', function() {
        const startDate = new Date(document.getElementById('date_effet_add').value);
        const endDate = new Date(document.getElementById('date_echeance_add').value);
        const selectedDate = new Date(this.value);
        if (!(selectedDate >= startDate && selectedDate <= endDate)) {
            this.value = "";
            return toastr.warning('La date doit être correcte! (de la date d\'effet à la date d\'échéance inclus). ');
        }
    });
}


function submitPayement(payementForm, route){
    payementForm = document.getElementById(payementForm);
    payementForm.addEventListener('submit', function(event) {
        event.preventDefault();
        if(route !== '/add_payement_dette_sur_avance_produit'){
            document.getElementById('montantARegler').removeAttribute('readonly');
        }
        var data = new FormData(payementForm);
        var request = new XMLHttpRequest();
        request.open('POST', route);
        request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        request.onreadystatechange = function() {
            if (request.readyState === XMLHttpRequest.DONE) {
                if (request.status === 200) {
                    var response = JSON.parse(request.responseText);
                    if(response.problemeDeTraçabilite){
                        if(route !== '/add_payement_dette_sur_avance_produit'){
                            document.getElementById('montantARegler').setAttribute('readonly', true);
                        }
                        return toastr.info('Reference ou fichier de payement manquant!');
                    }
                    
                    if(response.autreProbleme){
                        if(route !== '/add_payement_dette_sur_avance_produit'){
                            document.getElementById('montantARegler').setAttribute('readonly', true);
                        }
                        return toastr.error('Nous avons rencontré un problème. Veuillez recommencer...');
                    }
                    
                    if(response.depassementDeMontant){
                        const errorMessageElements = document.querySelectorAll('.error-message');
                        if(errorMessageElements.length > 0){
                            errorMessageElements.forEach(function(element) {
                                element.parentNode.removeChild(element);
                            });
                        }
                        if(route !== '/add_payement_dette_sur_avance_produit'){
                            document.getElementById('montantARegler').setAttribute('readonly', true);
                        }
                        return toastr.warning("Montant trop élévé! Veuillez recommencer...");
                    }
                    
                    if(response.rienARegler){
                        const errorMessageElements = document.querySelectorAll('.error-message');
                        if(errorMessageElements.length > 0){
                            errorMessageElements.forEach(function(element) {
                                element.parentNode.removeChild(element);
                            });
                        }
                        if(route !== '/add_payement_dette_sur_avance_produit'){
                            document.getElementById('montantARegler').setAttribute('readonly', true);
                        }
                        return toastr.warning("Le montant a été totalement payé...");
                    }
                    
                    const errorMessageElements = document.querySelectorAll('.error-message');
                    if(errorMessageElements.length > 0){
                        errorMessageElements.forEach(function(element) {
                            element.parentNode.removeChild(element);
                        });
                    }
                    if(route !== '/add_payement_dette_sur_avance_produit'){
                        document.getElementById('montantARegler').setAttribute('readonly', true);
                    }
                   return toastr.success('Opération terminée!');
                }else if(request.status === 419){
                    if(route !== '/add_payement_dette_sur_avance_produit'){
                        document.getElementById('montantARegler').setAttribute('readonly', true);
                    }
                   return toastr.error('Cette session a expiré! Veuillez recharger la page pour continuer...', 'Erreur');
                }else {
                    var response = JSON.parse(request.responseText);
                    if (response.errors) {
                        var errorMessageElements = document.querySelectorAll('.error-message');
                        if(errorMessageElements.length > 0){
                            errorMessageElements.forEach(function(element) {
                                element.parentNode.removeChild(element);
                            });
                        }
                        var errors = response.errors;
                        Object.keys(errors).forEach(function(key) {
                            var inputField = payementForm.querySelector('[name="' + key + '"]');
                            if (inputField) {
                                var errorElement = document.createElement('span');
                                errorElement.className = 'error-message text-red-500';
                                errorElement.textContent = errors[key][0];
                                inputField.parentNode.appendChild(errorElement);
                            }
                        });
                    } else {
                        document.getElementById('montantARegler').setAttribute('readonly', true);
                       return toastr.error('Une erreur s\'est produite lors de la requête.', 'Erreur');
                    }
                }
            }
        };
        request.send(data);
    });
}

function cencelProcess(){
    const modalDiv = document.getElementById('modalDiv');
    const modalDivModifyProfil = document.getElementById('modalDivModifyProfil');
    if(modalDiv){
        modalDiv.classList.add('hidden')
    }
    if(modalDivModifyProfil){
        modalDivModifyProfil.classList.add('hidden')
    }
    window.location.reload()
    return;
}

function actualiser(){
    window.location.reload();
}


function payement(event, filtre){
    let trElement = event.target.closest('tr');
    let idDette = trElement.getAttribute('data-id');

    let montantRestant = parseFloat(trElement.getAttribute('data-montant')) - parseFloat(trElement.getAttribute('data-montant_paye'));
    let payementForm = document.getElementById('payement');
    payementForm.querySelector('input[name="idDette"]').value = idDette;
    if(filtre === 'detteClient'){
        
        dynamismeFormModalPayement(trElement, payementForm, montantRestant);
        document.getElementById('modalDiv').classList.remove('hidden');
        submitPayement('payement', '/add_payement_dette_client');
        
    }else if(filtre === 'detteFinanciere'){
        montantRestant = parseFloat(trElement.getAttribute('data-montant_emprunte')) + parseFloat(trElement.getAttribute('data-montant_interet')) - parseFloat(trElement.getAttribute('data-montant_paye'));
        dynamismeFormModalPayement(trElement, payementForm, montantRestant);
        document.getElementById('modalDiv').classList.remove('hidden');
        submitPayement('payement', '/add_payement_dette_financiere');
    }else if(filtre === 'detteFournisseur'){
        dynamismeFormModalPayement(trElement, payementForm, montantRestant);
        document.getElementById('modalDiv').classList.remove('hidden');
        submitPayement('payement', '/add_payement_dette_fournisseur');
    }else if(filtre === 'detteSurAvance'){
        document.getElementById('modalDiv').classList.remove('hidden');
        submitPayement('payement', '/add_payement_dette_sur_avance_produit');
    }else if(filtre === 'investissement'){
        document.getElementById('modalDiv').classList.remove('hidden');
        submitPayement('payement', '/add_payement_investissement');
    }
}

function finaliserPayement(){
    document.getElementById('formForPayementValidation').querySelector('input[name="avanceId"]').value = event.target.closest('tr').getAttribute('data-id');
    document.getElementById('formForPayementValidation').querySelector('input[name="reste_a_regler"]').value = event.target.closest('tr').getAttribute('data-reste_a_regler');
    document.getElementById('modalDivForPayementValidation').classList.remove('hidden');
}

function recouvrement(impayeSurProduitTransforme){
    let trElement = event.target.closest('tr');
    let idImpaye = trElement.getAttribute('data-id');
    let form = document.getElementById('recouvrement');
    form.querySelector('input[name="idImpaye"]').value = idImpaye;
    document.getElementById('modalDiv').classList.remove('hidden');
    if(impayeSurProduitTransforme === 'impayeProduitBrut'){
        submitPayement('recouvrement', '/add_recouvrement');
    }else if(impayeSurProduitTransforme === 'impayeSurProduitTransforme'){
        submitPayement('recouvrement', '/add_recouvrementPT');
    }else if(impayeSurProduitTransforme === 'impayeSurService'){
        submitPayement('recouvrement', '/add_recouvrementService');
    }
}

function client_on_change(){
    clientSelected_id.addEventListener('change', function() {
        $.ajax({
            url: '/render-client_properties',
            method: 'GET',
            data: { query: this.value },
            success: function(response) {
                if(response){
                    clientInput_id.value = response.nom;
                    ableDisable(true, response.type, response.nom, response.adresse, response.email, response.phone, response.seconde_phone, response.region, response.departement, response.localite, response.pays);
                }else{
                    clientSelected_id.innerHTML = '<option disabled value="">0 résultat</option>';
                }
            },
            error: function() {
                toastr.error('Erreur de connexion. Veuillez réessayer.');
            }
        });
    });
}

function ableDisable(boolValue, value1, value2, value3, value4, value5, value6, value7, value8, value9, value10){
    type =  document.getElementById('type_add')
    if(typeof value1 != 'undefined'){
        type.value = value1;
    }
    type.disabled = boolValue;

    nom = document.getElementById('nom_add')
   
    if(typeof value2 != 'undefined'){
        nom.value = value2;
    }
    nom.disabled = boolValue;

    adresse =  document.getElementById('adresse_add')
    if(typeof value3 != 'undefined'){
        adresse.value = value3;
    }
    adresse.disabled = boolValue;

    email =  document.getElementById('email_add')
    if(typeof value4 != 'undefined'){
        email.value = value4;
    }
    email.disabled = boolValue;

    phone =  document.getElementById('phone_add')
    if(typeof value5 != 'undefined'){
        phone.value = value5;
    }
    phone.disabled = boolValue;

    seconde_phone =  document.getElementById('seconde_phone_add')
    if(typeof value6 != 'undefined'){
        seconde_phone.value = value6;
    }
    seconde_phone.disabled = boolValue;

    region =  document.getElementById('region_add')
    if(typeof value7 != 'undefined'){
        region.value = value7;
    }
    region.disabled = boolValue;

    departement =  document.getElementById('departement_add')
    if(typeof value8 != 'undefined'){
        departement.value = value8;
    }
    departement.disabled = boolValue;

    localite =  document.getElementById('localite_add')
    if(typeof value9 != 'undefined'){
        localite.value = value9;
    }
    localite.disabled = boolValue;

    pays =  document.getElementById('pays_add')
    if(typeof value10 != 'undefined'){
        pays.value = value10;
    }
    pays.disabled = boolValue;
}

function ajouterClient(formulaire_ajou){
    formulaire_ajou.addEventListener('submit', function(event) {
    event.preventDefault();
    ableDisable(false);
    var formData = new FormData(formulaire_ajou);
    var request = new XMLHttpRequest();
    request.open('POST', '/store_client');
    request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    request.onreadystatechange = function() {
        if (request.readyState === XMLHttpRequest.DONE) {
            if (request.status === 200) {
                var response = JSON.parse(request.responseText);
                if(response.duplication){toastr.info(response.duplication,'INFORMATION'); return;}
                effacer_erreurs();
                    toastr.success('Client ajouté avec succès!', 'OK');
                    ableDisable(false,'Choisissez un type','','','','','','','','','');
            } else {
                var response = JSON.parse(request.responseText);
                if (response.errors) {
                    effacer_erreurs();
                    var errors = response.errors;
                    Object.keys(errors).forEach(function(key) {
                        var inputField = document.querySelector('[name="' + key + '"]');
                        if (inputField) {
                            var errorElement = document.createElement('span');
                            errorElement.className = 'error-message text-red-500';
                            errorElement.textContent = errors[key][0];
                            inputField.parentNode.appendChild(errorElement);
                        }
                    });
                } else {
                   return toastr.error('Une erreur s\'est produite lors de la requête.', 'Erreur');
                }
            }
        }
    };
    request.send(formData);
    
});

}

function coutPortionUnitaire(pua, nbrPiecesParProduit, nbrPortionsParPiece){
    coutPortion = pua / (nbrPiecesParProduit * nbrPortionsParPiece);
   return coutPortion;
}


function messages(eventName, nature , body,  title = null) {
    Livewire.on(eventName, function() {
        if(nature == 'success'){
             if(title){
                toastr.success(body, title);
            }else{
                toastr.success(body);
            }
        }else if(nature == 'info'){
             if(title){
                toastr.info(body, title);
            }else{
                toastr.info(body);
            }
        }else if(nature == 'error'){
             if(title){
                toastr.error(body, title);
            }else{
                toastr.error(body);
            }
        }else if(nature == 'warning'){
             if(title){
                toastr.warning(body, title);
            }else{
                toastr.warning(body);
            }
        }
    });
}

function gestionImageProfile(profileImage, imageUpload){
    profileImage.addEventListener('click', function() {
        imageUpload.click();
    });

    imageUpload.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                profileImage.src = e.target.result; 
            };

            reader.readAsDataURL(file);
        }
    });
}

function effacer_erreurs(){
    var errorMessageElements = document.querySelectorAll('.error-message');
    if(errorMessageElements.length > 0){
        errorMessageElements.forEach(function(element) {
            element.parentNode.removeChild(element);
        });
    }
}

function afficher(){
    let displaying = document.getElementById('displaying_erea')
    displaying.classList.remove("hidden")
    let adding = document.getElementById('adding_erea')
    if(adding){
        adding.classList.add("hidden")
    }
    let modifying = document.getElementById('modifying_erea')
    if(modifying){
        modifying.classList.add("hidden")
    }
    window.location.reload();
}

function typesInputManager(){
    const type_depense_input_add = document.getElementById('type_depense_input_add');
    const type_depense_select_add = document.getElementById('type_depense_select_add');
    let timeId;
    type_depense_input_add.addEventListener('input', function(e) {

        clearTimeout(timeId);
        timeId = setTimeout(function() {
            var inputValue = e.target.value;
            $.ajax({
                url: '/rechercher-type-depense',
                method: 'GET',
                data: { query: inputValue},
                success: function(response) {
                    if(response.length > 0){
                        if(response.length == 1){
                            type_depense_select_add.innerHTML = '<option disabled value="">1 résultat</option>';
                        }else{
                            type_depense_select_add.innerHTML = '<option disabled value="">'+ response.length +' résultats</option>';
                        }
                        response.forEach(function(types) {
                            type_depense_select_add.innerHTML += `<option value="${types.id}">${types.nom}</option>`;
                        });
                    }else{
                        type_depense_select_add.innerHTML = '<option disabled value="">Pas de type correspondant</option>';
                    }
                },
                error: function() {
                    toastr.error('Erreur de connexion. Veuillez réessayer.');
                }
            });
        }, 250);
    });
}

function dynamismeFormModalPayement(trElement, payementForm, montantRestant = null) {
    const manierePayement = trElement.getAttribute('data-manierePayement');
    const principleDiv = document.getElementById("modaliteModalForPayementDiv");
    principleDiv.innerHTML = "";

    if (manierePayement === "Périodique") {
        document.getElementById('titreDuFormDePayement').textContent = 'Payement en attente (périodique)'
        let modalitePeriodique = trElement.getAttribute('data-modalitePeriodiqueMontant');
        modalitePeriodique = JSON.parse(modalitePeriodique);

        payementForm.querySelector('input[name="iModalite"]').value = modalitePeriodique.id;
        payementForm.querySelector('input[name="typeModalite"]').value = "Périodique";
        // Div de la periodicité
        const periodiciteDiv = document.createElement('div');
        periodiciteDiv.classList.add('col', 'mr-2', 'w-full');
        const periodiciteLabel = document.createElement('label');
        periodiciteLabel.setAttribute('for', 'periodicite_payement');
        periodiciteLabel.textContent = 'Périodicité de règlement';
        const periodiciteInput = document.createElement('input');
        periodiciteInput.readOnly = true;
        periodiciteInput.name = 'periodicite_payement';
        periodiciteInput.type = 'text';
        periodiciteInput.value = modalitePeriodique.periodicite_payement;
        periodiciteInput.classList.add('ltr:pl-8', 'rtl:pr-8', 'form-input', 'border-slate-200', 'dark:border-zink-500', 'focus:outline-none', 'focus:border-custom-500', 'disabled:bg-slate-100', 'dark:disabled:bg-zink-600', 'disabled:border-slate-300', 'dark:disabled:border-zink-500', 'dark:disabled:text-zink-200', 'disabled:text-slate-500', 'dark:text-zink-100', 'dark:bg-zink-700', 'dark:focus:border-custom-800', 'placeholder:text-slate-400', 'dark:placeholder:text-zink-200', 'mr-2', 'w-full');
        periodiciteDiv.appendChild(periodiciteLabel);
        periodiciteDiv.appendChild(periodiciteInput);
        principleDiv.appendChild(periodiciteDiv);

        // Div du montant
        const montantDiv = document.createElement('div');
        montantDiv.classList.add('col', 'mr-2', 'w-full');
        const montantLabel = document.createElement('label');
        montantLabel.setAttribute('for', 'montantARegler');
        montantLabel.textContent = 'Montant en cours';

        const montantInput = document.createElement('input');
        montantInput.readOnly = true;
        montantInput.name = 'montantARegler';
        montantInput.type = 'number';
        montantInput.id = 'montantARegler';
        montantInput.step = 'any';

        montantInput.value = montantRestant !== null ? Math.min(modalitePeriodique.montant, montantRestant) : modalitePeriodique.montant;

        montantInput.classList.add('ltr:pl-8', 'rtl:pr-8', 'form-input', 'border-slate-200', 'dark:border-zink-500', 'focus:outline-none', 'focus:border-custom-500', 'disabled:bg-slate-100', 'dark:disabled:bg-zink-600', 'disabled:border-slate-300', 'dark:disabled:border-zink-500', 'dark:disabled:text-zink-200', 'disabled:text-slate-500', 'dark:text-zink-100', 'dark:bg-zink-700', 'dark:focus:border-custom-800', 'placeholder:text-slate-400', 'dark:placeholder:text-zink-200', 'mr-2', 'w-full');
        montantDiv.appendChild(montantLabel);
        montantDiv.appendChild(montantInput);
        principleDiv.appendChild(montantDiv);

    } else if (manierePayement === "Échelonnée") {
        document.getElementById('titreDuFormDePayement').textContent = 'Payement en attente (échelonné)'
        let modalitesEchellonnees = trElement.getAttribute('data-modalitesEchellonnees');
        modalitesEchellonnees = JSON.parse(modalitesEchellonnees);
        modalitesEchellonnees.sort(function (a, b) {
            return new Date(a.date_reglement) - new Date(b.date_reglement);
        });

        for (const modalite of modalitesEchellonnees) {
            if (modalite.status === "En attente") {

                payementForm.querySelector('input[name="iModalite"]').value = modalite.id;
                payementForm.querySelector('input[name="typeModalite"]').value = "Échelonnée";


                const datePayementDiv = document.createElement('div');
                datePayementDiv.classList.add('col', 'mr-2', 'w-full');
                const datePayementLabel = document.createElement('label');
                datePayementLabel.setAttribute('for', 'date_reglement');
                datePayementLabel.textContent = 'Date en cours';
                const datePayementInput = document.createElement('input');
                datePayementInput.readOnly = true;
                datePayementInput.type = 'date';
                datePayementInput.value = modalite.date_reglement;
                datePayementInput.classList.add('ltr:pl-8', 'rtl:pr-8', 'form-input', 'border-slate-200', 'dark:border-zink-500', 'focus:outline-none', 'focus:border-custom-500', 'disabled:bg-slate-100', 'dark:disabled:bg-zink-600', 'disabled:border-slate-300', 'dark:disabled:border-zink-500', 'dark:disabled:text-zink-200', 'disabled:text-slate-500', 'dark:text-zink-100', 'dark:bg-zink-700', 'dark:focus:border-custom-800', 'placeholder:text-slate-400', 'dark:placeholder:text-zink-200', 'mr-2', 'w-full');
                datePayementDiv.appendChild(datePayementLabel);
                datePayementDiv.appendChild(datePayementInput);
                principleDiv.appendChild(datePayementDiv);

                const montantDiv = document.createElement('div');
                montantDiv.classList.add('col', 'mr-2', 'w-full');

                const montantLabel = document.createElement('label');
                montantLabel.setAttribute('for', 'montantARegler');
                montantLabel.textContent = 'Montant en cours';

                const montantInput = document.createElement('input');
                montantInput.readOnly = true;
                montantInput.type = 'number';
                montantInput.step = 'any';
                

                montantInput.value = montantRestant !== null ? Math.min(modalite.montant, montantRestant) : modalite.montant;

                montantInput.name = 'montantARegler';
                montantInput.id = 'montantARegler';
                montantInput.classList.add('ltr:pl-8', 'rtl:pr-8', 'form-input', 'border-slate-200', 'dark:border-zink-500', 'focus:outline-none', 'focus:border-custom-500', 'disabled:bg-slate-100', 'dark:disabled:bg-zink-600', 'disabled:border-slate-300', 'dark:disabled:border-zink-500', 'dark:disabled:text-zink-200', 'disabled:text-slate-500', 'dark:text-zink-100', 'dark:bg-zink-700', 'dark:focus:border-custom-800', 'placeholder:text-slate-400', 'dark:placeholder:text-zink-200', 'mr-2', 'w-full');
                montantDiv.appendChild(montantLabel);
                montantDiv.appendChild(montantInput);
                principleDiv.appendChild(montantDiv);
                break;
            }
        }
    }
}

function fonction_de_recherche(){
    document.getElementById('searchInput').addEventListener('input', function() {
        let filter = this.value.toLowerCase(); 
        let rows = document.querySelectorAll('#personnelTable tbody tr');
        rows.forEach(function(row) {
            let cells = row.querySelectorAll('td');
            let found = false;
    
            cells.forEach(function(cell) {
                if (cell.textContent.toLowerCase().includes(filter)) { 
                    found = true; 
                }
            });
            row.style.display = found ? '' : 'none';
        });
    });
}

function selectRenderClientsForVentes(route){
    $('#type_de_vente_add').on('change', function() {
        const typeVente = $(this).val();
        let messages = ['...','...','...'];
        if(typeVente === "Dépôt vente"){
            messages = ['Un client a une livraison', 'clients ont des livraisons', 'Pas de client avec livraison'];
            $('.produit-item').each(function() {
                $(this).find('input.quantite_vendue').prev('label').text('Quantité vendue');
                $(this).find('input.quantite_envoyee').prop('disabled', false);
            });
        }else if(typeVente === "Avance"){
            messages = ['Un client trouvé', 'clients trouvés', 'Aucun client trouvé'];
            $('.produit-item').each(function() {
                $(this).find('input.quantite_envoyee').prop('disabled', true);
                $(this).find('input.quantite_vendue').prev('label').text('Nombre concerné');
            });
        }else{
            $('.produit-item').each(function() {
                $(this).find('input.quantite_vendue').prev('label').text('Quantité vendue');
                $(this).find('input.quantite_envoyee').prop('disabled', false);
            });
            messages = ['Un client trouvé', 'clients trouvés', 'Aucun client trouvé'];
        }
        const ligne_client_systeme_selecte = $('#ligne_client_systeme_selecte');
        $.ajax({
            url: route,
            method: 'GET',
            data: { typeVente: typeVente },
            success: function(response) {
                if (response.length > 0) {
                    let options = '';
                    if (response.length == 1) {
                        options = `<option disabled value=""> ${messages[0]}</option>`;
                    } else {
                        options = `<option disabled value="">${response.length} ${messages[1]}</option>`;
                    }
                    response.forEach(function(client) {
                        options += `<option value="${client.id}">${client.client.nom} (${client.client.email}) (${client.client.phone}) (${client.client.type})</option>`;
                    });
                    ligne_client_systeme_selecte.html(options);
                } else {
                    ligne_client_systeme_selecte.html(`<option disabled value="">${messages[2]}</option>`);
                }
            },
            error: function() {
                toastr.error('Erreur de connexion. Veuillez réessayer.');
            }
        });

        
        
    });
}

function verificationReglements(v=false) {
    const t = document.getElementById('type_de_vente_add').value;
    if (t === "Au comptant") {
       
       
        if(v){
            let i = 0;
            let produitNonPaye = null;
            $('.produit-item').each(function() {
                i++;
                const quantite_vendue = $(this).find('input.quantite_vendue').val();
                const prix_reel_vente = $(this).find('input.prix_reel_vente').val();
                const montant_regle = $(this).find('input.montant_regle').val();
                if (Number(quantite_vendue) * Number(prix_reel_vente) != Number(montant_regle)) {
                    produitNonPaye = {
                        trueFalse: true,
                        numeroProduit: i
                    };
                    return false;
                }
            });
            if (produitNonPaye) {
                return produitNonPaye;
            } else {
                return {
                    trueFalse: false,
                    numeroProduit: null
                };
            }
        }




        let i = 0;
        let produitNonPaye = null;
        $('.produit-item').each(function() {
            i++;
            const quantite_vendue = $(this).find('input.quantite_vendue').val();
            const prix_vente = $(this).find('input.prix_vente').val();
            const montant_regle = $(this).find('input.montant_regle').val();
            if (Number(quantite_vendue) * Number(prix_vente) != Number(montant_regle)) {
                produitNonPaye = {
                    trueFalse: true,
                    numeroProduit: i
                };
                return false;
            }
        });
        if (produitNonPaye) {
            return produitNonPaye;
        } else {
            return {
                trueFalse: false,
                numeroProduit: null
            };
        }
    }
}

function submitAvanceValidationData(){
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    document.getElementById('formForPayementValidation').addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        fetch('/finalisation_avance', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken, 
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.SUCCES){
                toastr.success('Opération reussie...');
                document.getElementById('modalDivForPayementValidation').classList.add('hidden');
                window.location.reload();
            }else{
                toastr.error('Opération échouée...');
            }
        })
        .catch(error => {
            toastr.error('Erreur de connexion. Veuillez réessayer.');
        });
    });
}

function ajouterProduitsUtilises(boutonUtiliserProduit, servicesCounter, produitCounter, newService){
    boutonUtiliserProduit.on('click', function(){
        let newProduit = $('#produit_template0').clone();
        newProduit.find('.productLabel').text('Produit '+ (produitCounter+1).toString());
        newProduit.attr('id', 'produit_template' + produitCounter).addClass('produit_template');
        let deleteProduit = $('<button type="button" class="supprimer_produit error text-red-300">--Retirer ce produit</button>');
        newProduit.append(deleteProduit);
        newProduit.find('input, select').each(function() {
            let name = $(this).attr('name');
            if(name === "produits_u"){
                name = 'produits_utilise['  + servicesCounter + '][' + produitCounter + ']';
                $(this).attr('name', name);
            }else if(name === "quantite_u"){
                name = 'quantite_utilisee[' + servicesCounter + '][' + produitCounter + ']';
                $(this).attr('name', name);
            }else if(name === "produits_utilise_in"){
                name = 'produits_utilise_input[' + servicesCounter + '][' + produitCounter + ']';
                $(this).attr('name', name);
            }else{
                let parts = name.split(/[\[\]]+/);
                parts[1] = servicesCounter;
                parts[2] = produitCounter;
                name = parts[0] + '[' + parts[1] + '][' + parts[2] + ']';
                $(this).attr('name', name);
            }
            
            if ($(this).is('input')) {
                $(this).val('');
            } else if ($(this).is('select')) {
                $(this).val('-1');
            }
        });
        let ProduitContainer = newService.find('.produits_container');
        newProduit.removeClass('hidden');
        ProduitContainer.append(newProduit);
        deleteProduit.on('click', function () {
            newProduit.remove();
        });
        produitCounter++
    });
}

function renderServicePropertiesAfterSelet(){
    $('.service_selecte').on('change', function() {
        const idService = $(this).val();
        $.ajax({
            url: '/render-service_properties',
            method: 'GET',
            data: {
                idService: idService ? idService[0] : null,
            },
            success: function(service) {
                if(service.other_error){
                  return  toastr.error('Une erreur s\'est produite. Veuillez recommencer...');
                }
                if (service) {
                    $('.service_input').val(service.designation);
                    $('.prix_vente').val(service.prix_unitaire);
                    return;
                }
            },
            error: function() {
               return toastr.error('Erreur de connexion. Veuillez réessayer.');
            }
        });
    });
}


function searchServiceByInput(){
    let timeId;
    const service_selecte = $('#service_selecte');
    $('.service_input').on('input', function () {
        clearTimeout(timeId);
        let terme = $(this).val();
        timeId = setTimeout(function () {
            $.ajax({
                url: '/rechercher-services',
                method: 'GET',
                data: { terme: terme},
                success: function (services) {
                    if(services.other_error){
                        return toastr.error('Une erreur s\'est produite. Veuillez recommencer...');
                    }
                    if(services){
                        service_selecte.empty();
                        service_selecte.append('<option selected disabled value="">Choisir un service ici...</option>');
                            $.each(services, function(index, service){
                                service_selecte.append(
                                    $('<option></option>').attr('value', service.id).text(service.designation + ' (' + service.reference + ')' + ' (' + service.prix_unitaire + ' FCFA)')
                                );
                            });
                            return;
                        } 
                },
                error: function () {
                    return toastr.error('Erreur de connexion. Veuillez réessayer.');
                }
            });
        }, 250);
    });
}



function manageSpecifiqueProductInput(productsTemplate, timeId){
    const produit_a_utilniser_selecte = $(productsTemplate + ' .produit_a_utiliser_selecte');
    $(productsTemplate + ' .produit_a_utilniser_input').on('input', function () {
        clearTimeout(timeId);
        let terme = $(this).val();
        timeId = setTimeout(function () {
            $.ajax({
                url: '/rechercher-produits-a-utiliser',
                method: 'GET',
                data: { terme: terme},
                success: function (produits) {
                    if(produits.other_error){
                        return toastr.error('Une erreur s\'est produite. Veuillez recommencer...'); 
                    }
                    if(produits){
                        produit_a_utilniser_selecte.empty();
                        produit_a_utilniser_selecte.append('<option selected disabled value="">Choisir un produit ici...</option>');
                        $.each(produits, function(index, produit){
                            produit_a_utilniser_selecte.append(
                                $('<option></option>').attr('value', produit.id).text(produit.produit.designation + ' (' + produit.produit.reference + ')' + ' (' + produit.pua + ' FCFA)')
                            );
                        });
                        return;
                    }
                },
                error: function () {
                    return toastr.error('Erreur de connexion. Veuillez réessayer.');
                }
            });
        }, 250);
    });
}


function a(message = "OK!"){
    alert(message)
}

function c(message = "OK!"){
    console.log(message)
}


function manageSpecifiqueProductChange(productsTemplate, touttesLesProprietes = false){
    $(productsTemplate + ' .produit_a_utiliser_selecte').on('change', function() {
        const idProduit = $(this).val();
        $.ajax({
            url: '/render-produit_a_utiliser_properties',
            method: 'GET',
            data: {
                idProduit: idProduit ? idProduit[0] : null,
            },
            success: function(produit) {
                if(produit.other_error){
                    return toastr.error('Une erreur s\'est produite. Veuillez recommencer...');
                }
                if (produit) {
                    $(productsTemplate + ' .produit_a_utilniser_input').val(produit.produit.designation);
                    
                    if(touttesLesProprietes){
                        $(productsTemplate + ' .pua').val(produit.pua);
                        $(productsTemplate + ' .reference').val(produit.produit.reference);
                        $(productsTemplate + ' .designation').val(produit.produit.designation);
                        $(productsTemplate + ' .conditionnement').val(produit.produit.conditionnement);
                        $(productsTemplate + ' .format').val(produit.produit.format);
                        $(productsTemplate + ' .calibrage').val(produit.produit.calibrage);
                        $(productsTemplate + ' .type').val(produit.produit.type);
                        $(productsTemplate + ' .qte_stck').val(produit.qte_stck);
                        $(productsTemplate + ' .puv').val(produit.puv);
                        $(productsTemplate + ' .nom_piece').val(produit.nom_piece);
                        $(productsTemplate + ' .nombre_pieces').val(produit.nombre_pieces);
                        $(productsTemplate + ' .libelle_portion').val(produit.portion);
                        $(productsTemplate + ' .nombre_portions').val(produit.nombre_portions);
                    }else{
                        $(productsTemplate + ' .prix_achat').val(produit.pua);
                    }
                }
            },
            error: function(error) {
                toastr.error('Erreur de connexion. Veuillez réessayer.');
            }
        });
    });
}

//employe
function manageSpecifiqueEmployeInput(employesTemplate, timeId){
    const employe_a_utiliser_selecte = $(employesTemplate + ' .employe_a_utiliser_selecte');
    $(employesTemplate + ' .employe_a_utilniser_input').on('input', function () {
        clearTimeout(timeId);
        let terme = $(this).val();
        timeId = setTimeout(function () {
            $.ajax({
                url: '/rechercher-employes-a-utiliser',
                method: 'GET',
                data: { terme: terme},
                success: function (employes) {
                    if(employes.other_error){
                        return toastr.error('Une erreur s\'est produite. Veuillez recommencer...'); 
                    }
                    if(employes){
                        employe_a_utiliser_selecte.empty();
                        employe_a_utiliser_selecte.append('<option selected disabled value="">Choisir un employé ici...</option>');
                        $.each(employes, function(index, employe){
                            employe_a_utiliser_selecte.append(
                                $('<option></option>').attr('value', employe.id).text(employe.matricule + ' (' + employe.nom + ')' + ' (' + employe.prenom + ')' + ' (' + employe.date_recrutement + ')' + ' (' + employe.titre_poste + ')')
                            );
                        });
                        return;
                    } 
                },
                error: function () {
                    return toastr.error('Erreur de connexion. Veuillez réessayer.');
                }
            });
        }, 250);
    });
}

function manageSpecifiqueEmployeChange(employesTemplate){
    $(employesTemplate + ' .employe_a_utiliser_selecte').on('change', function() {
        const idEmploye = $(this).val();
        $.ajax({
            url: '/render-employe_a_utiliser_properties',
            method: 'GET',
            data: {
                idEmploye: idEmploye ? idEmploye[0] : null,
            },
            success: function(employe) {
                if(employe.other_error){
                    return toastr.error('Une erreur s\'est produite. Veuillez recommencer...');
                }
                if (employe) {
                    $(employesTemplate + ' .employe_a_utilniser_input').val(employe.nom);
                    $(employesTemplate + ' .salaire_mensuel').val(employe.contrat.salaire_mensuel);
                    $(employesTemplate + ' .nbr_jour_tr_pj').val(employe.contrat.nbr_jour_tr_pj);
                    $(employesTemplate + ' .nbr_h_tr_pj').val(employe.contrat.nbr_h_tr_pj);
                }
            },
            error: function(error) {
                toastr.error('Erreur de connexion. Veuillez réessayer.');
            }
        });
    });
}


function inputBanques(input, select){  
    let timeId;
    input.addEventListener('input', function(e) {
        clearTimeout(timeId);
        timeId = setTimeout(function() {
            var inputValue = e.target.value;
            $.ajax({
                url: '/rechercher-banques',
                method: 'GET',
                data: { query: inputValue},
                success: function(response) {
                    if(response.banquesTrouvees.length > 0){
                        if(response.banquesTrouvees.length == 1){
                            select.innerHTML = '<option disabled value="">Une banque trouvée</option>';
                        }else{
                            select.innerHTML = '<option disabled value="">'+ response.banquesTrouvees.length +' banques trouvées</option>';
                        }
                        response.banquesTrouvees.forEach(function(banque) {
                            select.innerHTML += `<option value="${banque.id}">${banque.nom} (${banque.sigle}) </option>`;
                        });
                    }else{
                        select.innerHTML = '<option disabled value="">Aucune banque trouvée</option>';
                    }
                },
                error: function(error) {
                    toastr.error('Erreur de connexion. Veuillez réessayer.');
                }
            });
        }, 250);
    });
}

function onChangeBanques(input, select) {
    select.addEventListener('change', function() {
        const txt = this.options[this.selectedIndex].text;
        const parenthesisIndex = txt.indexOf('(');
        if (parenthesisIndex !== -1) {
            input.value = txt.substring(0, parenthesisIndex - 1);
        } else {
            input.value = txt;
        }
    });
}



function clients_on_change(url){
    const ligne_client_systeme_selecte = document.getElementById('ligne_client_systeme_selecte');
    ligne_client_systeme_selecte.addEventListener('change', function() {
        document.getElementById('ligne_client_systeme_input').value = (ligne_client_systeme_selecte.options[ligne_client_systeme_selecte.selectedIndex].text).split(' (')[0];
        // if(document.getElementById('type_de_vente_add').value == "Dépôt vente"){
            $.ajax({
                url: url,
                method: 'GET',
                data: { 
                    typeVente: document.getElementById('type_de_vente_add').value,
                    client: document.getElementById('ligne_client_systeme_selecte').value,
                    },
                success: function (response) {
                    if(response.produits){
                        $('.produit-item').each(function() {
                            const element_a_vendre_selecte = $(this).find('select.element_a_vendre_selecte');
                            element_a_vendre_selecte.empty();
                            element_a_vendre_selecte.append('<option selected disabled value="">Choisir un produit ici...</option>');
                            if(response.estProduitTransforme){
                                $.each(response.produits, function(index, produit){
                                    element_a_vendre_selecte.append($('<option></option>').attr('value', produit.id).text(produit.designation + ' (' + produit.reference + ')' + ' (' + produit.portion_unitaire + ')' + ' (' + produit.prix_unitaire_portion + ' FCFA)'));
                                });
                                return;
                            }else if(response.estProduitBrute){
                                $.each(response.produits, function(index, produit){
                                    element_a_vendre_selecte.append(
                                        $('<option></option>').attr('value', produit.id).text(produit.produit.designation + ' (' + produit.produit.reference + ')' + ' (' + produit.puv + ' FCFA)' + ' (' + produit.nom_piece + ')' + ' (' + produit.nombre_pieces + ')'+ ' (' + produit.portion + ')' + ' (' + produit.nombre_portions + ')')
                                    );
                                });
                                return;
                            }
                            
                        });
                    }else if(response.other_error){
                        toastr.error('Une erreur s\'est produite. Veuillez recommencer...');
                        return;
                    }
                },
                error: function (xhr, status, error) {
                    return toastr.error('Erreur de connexion...')
                }
            });

        // }
    })
}



function chargerElementChargesJson() {   
    $.ajax({
        url: '/api/json/charges',
        method: 'GET',
        success: function(data) {
            const types = Object.keys(data);
            types.forEach(type => {
                $('#type').append(`<option value="${type}">${type}</option>`);
                $('#categorie').prop('disabled', true).append('<option value="">Sélectionnez une catégorie</option>');
                $('#libelle').prop('disabled', true).append('<option value="">Sélectionnez un libellé</option>');
            });
            $('#type').change(function() {
                var typeSelected = $(this).val();
                $('#libelle').append('<option value="">Sélectionnez un libellé</option>').prop('disabled', true);
                $('#categorie').empty().prop('disabled', false).append('<option value="">Sélectionnez une catégorie</option>');
                if (typeSelected) {
                    var categories = Object.keys(data[typeSelected]);
                    categories.forEach(function(categorie) {
                        $('#categorie').append(`<option value="${categorie}">${categorie}</option>`); 
                    });
                }
            }); 
                
            $('#categorie').change(function() {
                var typeSelected = $('#type').val();
                var categorieSelected = $(this).val();
                $('#libelle').empty().prop('disabled', false).append('<option value="" >Sélectionnez un libellé</option>');
                if (categorieSelected) {
                    var libelles = data[typeSelected][categorieSelected]; // Accéder aux libellés
                    libelles.forEach(function(libelle) {
                        $('#libelle').append(`<option value="${libelle}">${libelle}</option>`);
                    });
                }
            });
        },
        error: function(error) {
            console.error('Erreur:', error);
        }
    }); 
}




function chargerElementInvestissementsJson() {   
    $.ajax({
        url: '/api/json/investissements',
        method: 'GET',
        success: function(data) {
            const types = Object.keys(data);
            types.forEach(type => {
                $('#type').append(`<option value="${type}">${type}</option>`);
                $('#categorie').prop('disabled', true).append('<option value="">Sélectionnez une catégorie</option>');
                $('#libelle').prop('disabled', true).append('<option value="" disabled>Sélectionnez un libellé</option>');
            });
            $('#type').change(function() {
                var typeSelected = $(this).val();
                $('#libelle').append('<option value="" disabled>Sélectionnez un libellé</option>').prop('disabled', true);
                $('#categorie').empty().prop('disabled', false).append('<option value="">Sélectionnez une catégorie</option>');
                if (typeSelected) {
                    var categories = Object.keys(data[typeSelected]);
                    categories.forEach(function(categorie) {
                        $('#categorie').append(`<option value="${categorie}">${categorie}</option>`); 
                    });
                }
            }); 
                
            $('#categorie').change(function() {
                var typeSelected = $('#type').val();
                var categorieSelected = $(this).val();
                $('#libelle').empty().prop('disabled', false).append('<option value="" disabled>Sélectionnez un libellé</option>');
                if (categorieSelected) {
                    var libelles = data[typeSelected][categorieSelected]; // Accéder aux libellés
                    libelles.forEach(function(libelle) {
                        $('#libelle').append(`<option value="${libelle}">${libelle}</option>`);
                    });
                }
            });
        },
        error: function(error) {
            console.error('Erreur:', error);
        }
    }); 
}




function generateCostomisedConpteDeResultat(selectedDates){
    const startDate = new Date(selectedDates[0]);
    const endDate = new Date(selectedDates[1]);
    const formattedStartDate = startDate.toLocaleDateString('fr-CA');
    const formattedEndDate = endDate.toLocaleDateString('fr-CA');
    $.ajax({
        url: '/compte_resultat_in_range',
        method: 'GET',
        data: { startDate: formattedStartDate, endDate: formattedEndDate},
        success: function(response) {
           document.getElementById('ca').textContent = response.ca;
           document.getElementById('charges_d_interets').textContent = response.charges_d_interets;
           document.getElementById('autres_recettes').textContent = response.autres_recettes;
           document.getElementById('depenses_sur_loyer').textContent = response.depenses_sur_loyer;
           document.getElementById('depenses_sur_salaires').textContent = response.depenses_sur_salaires;
           document.getElementById('depenses_sur_achats').textContent = response.depenses_sur_achats;
           document.getElementById('autres_depenses_sur_activites').textContent = response.autres_depenses_sur_activites;
           document.getElementById('depenses_sur_impots_et_taxes').textContent = response.depenses_sur_impots_et_taxes;
           document.getElementById('variation_stock').textContent = response.variation_stock;
           document.getElementById('variationCreance').textContent = response.variationCreance;
           document.getElementById('variationDettes').textContent = response.variationDettes;
           document.getElementById('total_recettes').textContent = response.total_recettes;
           document.getElementById('solde').textContent = response.solde;
           document.getElementById('total_depenses').textContent = response.total_depenses;
           document.getElementById('dotataion_aux_amortissements').textContent = response.dotataion_aux_amortissements;

           document.getElementById('resultat_exercice').textContent = response.resultat_exercice;
        },
        error: function(error) {
            toastr.error('Erreur de connexion. Veuillez réessayer.');
        }

    });
}


// Bien formater les nombres pour un bon affichage

function formatNumber(number) {
    const parts = number.toFixed(2).split('.');
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
    return parts.join('.');
}

function generateCostomisedConpteDeBilan(){
    document.getElementById('date').addEventListener('change', function (){
        $.ajax({
            url: '/compte_bilan_on_date',
            method: 'GET',
            data: {date: this.value},
            success: function(response) {
               document.getElementById('frais_etablissement_brut').textContent = formatNumber(response.fraisEtablissement[0]);
               document.getElementById('frais_etablissement_amort').textContent = formatNumber(response.fraisEtablissement[1]);
               document.getElementById('frais_etablissement_net').textContent = formatNumber(response.fraisEtablissement[2]);

               document.getElementById('frais_recherche_brut').textContent = formatNumber(response.fraisDeRechercheDeDeveloppement[0]);
               document.getElementById('frais_recherche_amort').textContent = formatNumber(response.fraisDeRechercheDeDeveloppement[1]);
               document.getElementById('frais_recherche_net').textContent = formatNumber(response.fraisDeRechercheDeDeveloppement[2]);
               
               document.getElementById('concession_brevet_droit_brut').textContent = formatNumber(response.brevetsLicense[0]);
               document.getElementById('concession_brevet_droit_amort').textContent = formatNumber(response.brevetsLicense[1]);
               document.getElementById('concession_brevet_droit_net').textContent = formatNumber(response.brevetsLicense[2]);
                
               document.getElementById('autres_immobilisations_incorporelles_brut').textContent = formatNumber(response.autresImmobilisationsIncorporelles[0]);
               document.getElementById('autres_immobilisations_incorporelles_amort').textContent = formatNumber(response.autresImmobilisationsIncorporelles[1]);
               document.getElementById('autres_immobilisations_incorporelles_net').textContent = formatNumber(response.autresImmobilisationsIncorporelles[2]);
                
               document.getElementById('tarrain_brut').textContent = formatNumber(response.terrain[0]);
               document.getElementById('tarrain_amort').textContent = formatNumber(response.terrain[1]);
               document.getElementById('tarrain_net').textContent = formatNumber(response.terrain[2]);
               
               document.getElementById('constructions_brut').textContent = formatNumber(response.constructions[0]);
               document.getElementById('constructions_amort').textContent = formatNumber(response.constructions[1]);
               document.getElementById('constructions_net').textContent = formatNumber(response.constructions[2]);
               
               document.getElementById('installations_technique_brut').textContent = formatNumber(response.installationsTechniques[0]);
               document.getElementById('installations_technique_amort').textContent = formatNumber(response.installationsTechniques[1]);
               document.getElementById('installations_technique_net').textContent = formatNumber(response.installationsTechniques[2]);
                
               document.getElementById('avance_acompte_brut').textContent = formatNumber(response.avancesEtAcompte[0]);
               document.getElementById('avance_acompte_amort').textContent = formatNumber(response.avancesEtAcompte[1]);
               document.getElementById('avance_acompte_net').textContent = formatNumber(response.avancesEtAcompte[2]);
               
               document.getElementById('materiel_de_bureau_brut').textContent = formatNumber(response.materielDeBureau[0]);
               document.getElementById('materiel_de_bureau_amort').textContent = formatNumber(response.materielDeBureau[1]);
               document.getElementById('materiel_de_bureau_net').textContent = formatNumber(response.materielDeBureau[2]);
               
               document.getElementById('autre_immobilisation_corporelle_brut').textContent = formatNumber(response.autresImmobilisationsCorporelle[0]);
               document.getElementById('autre_immobilisation_corporelle_amort').textContent = formatNumber(response.autresImmobilisationsCorporelle[1]);
               document.getElementById('autre_immobilisation_corporelle_net').textContent = formatNumber(response.autresImmobilisationsCorporelle[2]);
               
               document.getElementById('matiere_premiere_brut').textContent = formatNumber(response.matierePremiere[0]);
               document.getElementById('matiere_premiere_amort').textContent = formatNumber(response.matierePremiere[1]);
               document.getElementById('matiere_premiere_net').textContent = formatNumber(response.matierePremiere[2]);
                
               document.getElementById('produits_finis_brut').textContent = formatNumber(response.produitsFinis[0]);
               document.getElementById('produits_finis_amort').textContent = formatNumber(response.produitsFinis[1]);
               document.getElementById('produits_finis_net').textContent = formatNumber(response.produitsFinis[2]);
                
               document.getElementById('creances_clients_brut').textContent = formatNumber(response.creanceClients[0]);
               document.getElementById('creances_clients_amort').textContent = formatNumber(response.creanceClients[1]);
               document.getElementById('creances_clients_net').textContent = formatNumber(response.creanceClients[2]);
               
               document.getElementById('dispoibilites_brut').textContent = formatNumber(response.disponiblites[0]);
               document.getElementById('dispoibilites_amort').textContent = formatNumber(response.disponiblites[1]);
               document.getElementById('dispoibilites_net').textContent = formatNumber(response.disponiblites[2]);
               
               document.getElementById('dettes_bancaires_net').textContent = formatNumber(response.dettesBancaires[2]);
               document.getElementById('autres_dettes_net').textContent = formatNumber(response.autresDettesFinancieres[2]);
               document.getElementById('dettes_fournisseurs_net').textContent = formatNumber(response.dettesFournisseurs[2]);
               
               document.getElementById('capital_net').textContent = formatNumber(response.capital[2]);

               document.getElementById('resultat_de_l_exercice_net').textContent = formatNumber(response.resultatExercice);

               document.getElementById('dettes_sociales_et_fiscales_net').textContent = formatNumber(response.dettesSocialesEtFiscales[2]);

               document.getElementById('dettes_sur_immobilisations_net').textContent = formatNumber(response.dettesSurImmobilisations[2]);

               document.getElementById('total_actif').textContent = formatNumber(response.totalActif);
               
               document.getElementById('total_passif').textContent = formatNumber(response.totalPassif);
            },


            error: function(error) {
                toastr.error('Erreur de connexion. Veuillez réessayer.');
            }
    
        });
    });
}



// Controleuse des entrées des cellules pour les tables comme celle des provisions et celle de la trasorerie.
function controlCellInput(cell){
    cell.addEventListener('keydown', (event) => {
        if (['Backspace', 'Delete', 'Tab', 'ArrowLeft', 'ArrowRight'].includes(event.key)) {
            return;
        }
        if (!/^[0-9.]$/.test(event.key) || (event.key === '.' && cell.textContent.includes('.'))) {
            event.preventDefault();
        }
    });

    cell.addEventListener('blur', (event) => {
        const value = event.target.textContent.trim();

        if (value === '' || isNotConvertibleToNumber(value)) {
            event.target.textContent = '0.00';
        }
    });
}


// CONVERTIR EN NOMBRE POUR NE PAS AVOIR DES PROBLEME DE CALCULS

function isNotConvertibleToNumber(valeur){
    return isNaN(valeur.replace(/\s+/g, ""));
}



function convertirEnNombre(input) {
    let cleaned = input.replace(/[^0-9.]/g, '');
    let parts = cleaned.split('.');
    let partieEntiere = parts[0];
    let validNumber = partieEntiere;
    let partieDecimale = '';
    for(let i = 1 ; i < parts.length ; i++){
        if (parts[i] !== '') {
            partieDecimale += String(parts[i]);
        }
    }

    if(partieDecimale !== ''){
        validNumber += '.'
    }

    validNumber += String(partieDecimale);
   
    return parseFloat(validNumber);
}


