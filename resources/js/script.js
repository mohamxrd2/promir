
    
        function ajouter(){
            let adding = document.getElementById('add_contrat')
            adding.classList.remove("hidden")    
            
            let displaying = document.getElementById('display_contrat')
            displaying.classList.add("hidden")
        }
    
        function modifier(){
            let adding = document.getElementById('modify_contrat')
            adding.classList.remove("hidden")    
            let displaying = document.getElementById('display_contrat')
            displaying.classList.add("hidden")
            let trElement = event.target.closest('tr');
    
            const contrat_id = trElement.getAttribute('data-id-contrat');
            const personMatricule = trElement.getAttribute('data-matricule');
            const num_contrat = trElement.getAttribute('data-num-contrat');
            const person_nom = trElement.getAttribute('data-nom');
            const person_prenom = trElement.getAttribute('data-prenom');
            const person_debut_date = trElement.getAttribute('data-date-debut');
            const person_categorie = trElement.getAttribute('data-categorie');
            const type_emploi = trElement.getAttribute('data-type-emploi');
            const salaire_mensuel = trElement.getAttribute('data-salaire-mensuel');
            const njtpj = trElement.getAttribute('data-nbr-jour-tr-pj');
            const nhtpj = trElement.getAttribute('data-nbr-h-tr-pj');
            const heure_debut_travail = trElement.getAttribute('data-h-debut-tr');
            const nbr_heures_pause_par_jour = trElement.getAttribute('data-nbr-h-pause-pj');
    
    
            const formulaire = document.getElementById('formulaire_modif');
            formulaire.querySelector('input[name="id_contratm"]').value = contrat_id ;
            formulaire.querySelector('input[name="num_contratm"]').value = num_contrat ;
            formulaire.querySelector('input[name="date_debutm"]').value = person_debut_date;
            formulaire.querySelector('input[name="categoriem"]').value = person_categorie;
            formulaire.querySelector('select[name="type_emploim"]').value = type_emploi;
            formulaire.querySelector('input[name="salaire_mensuelm"]').value = salaire_mensuel;
            formulaire.querySelector('input[name="nbr_jour_tr_pjm"]').value = njtpj;
            formulaire.querySelector('input[name="nbr_h_tr_pjm"]').value = nhtpj;
            formulaire.querySelector('input[name="h_debut_trm"]').value = heure_debut_travail;
            formulaire.querySelector('input[name="nbr_h_pause_pjm"]').value = nbr_heures_pause_par_jour;
        }
    
    
    
    
        function afficher(){
            let displaying = document.getElementById('display_contrat')
            displaying.classList.remove("hidden")
            let adding = document.getElementById('add_contrat')
            if(adding){
                adding.classList.add("hidden")
            }
            let modifying = document.getElementById('modify_contrat')
            if(modifying){
                modifying.classList.add("hidden")
            }
        }
    
        document.getElementById('matricule').addEventListener('change', function (){
            const id = this.value;
            var input_peronnel = document.getElementById("id_personnel");
            input_peronnel.value = id;
            if(id){
                var request = new XMLHttpRequest();
                request.open('GET', '/display_personnel_for_contrat/' + id);
                request.onreadystatechange = function() {
                    if (request.readyState === XMLHttpRequest.DONE) {
                        if (request.status === 200) {
                            const response = JSON.parse(request.responseText);
                            document.querySelector('input[name="nom"]').value = response.nom;
                            document.querySelector('input[name="prenom"]').value = response.prenom;
                            document.querySelector('input[name="tel"]').value = response.tel;
                            document.querySelector('input[name="date_de_naissance"]').value = response.date_de_naissance;
                            document.querySelector('input[name="lieu_de_naissance"]').value = response.lieu_de_naissance;
                            document.querySelector('input[name="date_recrutement"]').value = response.date_recrutement;
                            document.querySelector('input[name="titre_poste"]').value = response.titre_poste;
                            document.querySelector('input[name="num_cnps"]').value = response.num_cnps;
                        } else {
                            console.error('Une erreur s\'est produite lors de la requête.');
                        }
                    }
                };
                request.send();
            }
        })
        
        var formulaire = document.getElementById('formulaire_ajout');
        formulaire.addEventListener('submit', function(event) {
    
            event.preventDefault();
           if(document.getElementById("id_personnel").value) {
               var formData = new FormData(formulaire);
               var request = new XMLHttpRequest();
               request.open('POST', '/store_personnel_contrat');
               request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
               request.onreadystatechange = function() {
    
                if (request.readyState === XMLHttpRequest.DONE) {
                    if (request.status === 200) {
                        var response = JSON.parse(request.responseText);
                        var errorMessageElements = document.querySelectorAll('.error-message');
                        if(errorMessageElements.length > 0){
                            errorMessageElements.forEach(function(element) {
                                element.parentNode.removeChild(element);
                            });
                        }
                        if (response.errors) {
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
                            alert('Contrat défini avec succès!');
                        }
                    } else {
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
                                var inputField = document.querySelector('[name="' + key + '"]');
                                if (inputField) {
                                    var errorElement = document.createElement('span');
                                    errorElement.className = 'error-message text-red-500';
                                    errorElement.textContent = errors[key][0];
                                    inputField.parentNode.appendChild(errorElement);
                                }
                            });
                        } else {
                            alert('Une erreur s\'est produite lors de la requête.');
                        }
                    }
                }
    
               };
               request.send(formData);
            }else{
                alert("Vous devez choisir un employé!");
            return;
        }
    
        });
    
    
        var formulaire_modif = document.getElementById('formulaire_modif');
        formulaire_modif.addEventListener('submit', function(event) {
            event.preventDefault();
            var data_to_modify = new FormData(formulaire_modif);
            var request = new XMLHttpRequest();
            request.open('POST', '/edit_personnel_contrat');
            request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            request.onreadystatechange = function() {
                
                if (request.readyState === XMLHttpRequest.DONE) {
                    if (request.status === 200) {
                        var response = JSON.parse(request.responseText);
                        var errorMessageElements = document.querySelectorAll('.error-message');
                        if(errorMessageElements.length > 0){
                            errorMessageElements.forEach(function(element) {
                                element.parentNode.removeChild(element);
                            });
                        }
                        if (response.errors) {
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
                            alert('Contrat modifié avec succès!');
                            window.location.reload();
                        }
                    }else if(response.status === 419){
                        alert("Cette a expiré! Veuillez recharger la page pour continuer...")
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
                                var inputField = document.querySelector('[name="' + key + '"]');
                                if (inputField) {
                                    var errorElement = document.createElement('span');
                                    errorElement.className = 'error-message text-red-500';
                                    errorElement.textContent = errors[key][0];
                                    inputField.parentNode.appendChild(errorElement);
                                }
                            });
                        } else {
                            alert('Une erreur s\'est produite lors de la requête.');
                        }
                    }
                }
    
            };
            request.send(data_to_modify);
    
        });

   
        if(document.getElementById("aucuncontrat")){
            document.getElementById("personnelTable").style.display = 'none';
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

        fonction_de_recherche();


