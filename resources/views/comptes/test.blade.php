<script>
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


    function effacer_erreurs(){
        var errorMessageElements = document.querySelectorAll('.error-message');
        if(errorMessageElements.length > 0){
            errorMessageElements.forEach(function(element) {
                element.parentNode.removeChild(element);
            });
        }
    }

    function disparition_table(){
        if(document.getElementById("aucunelement")){
            document.getElementById("personnelTable").style.display = 'none';
        }
    }

    disparition_table()

    function ajouter(){
        let adding = document.getElementById('adding_erea')
        adding.classList.remove("hidden")    
        let displaying = document.getElementById('displaying_erea')
        displaying.classList.add("hidden")
        effacer_erreurs();
    }
    
    function modifier(){
        let modifying = document.getElementById('modifying_erea')
        modifying.classList.remove("hidden")    
        let displaying = document.getElementById('displaying_erea')
        displaying.classList.add("hidden")
        let trElement = event.target.closest('tr');


        data-id= "{{ $compte->id}}"
        data-numero_iban="{{ $compte->numero_iban }}"
        data-numero_bic="{{ $compte->numero_bic }}"
        data-solde="{{ $compte->solde }}"
        data-devise="{{ $compte->devise }}"
        data-type="{{ $compte->type }}"
        data-code-banque="{{ $compte->code_banque }}"
        data-code-guichet="{{ $compte->code_guichet }}"
        data-cle-rib="{{ $compte->cle_rib }}"
        data-domiciliation="{{ $compte->domiciliation }}"
        data-numero-compte="{{ $compte->numero_compte }}"
        data-cle-iban="{{ $compte->cle_iban }}"
        data-date-creation="{{ $compte->date_creation }}"
        >


        const id_compte = trElement.getAttribute('data-id');
        const numero_iban = trElement.getAttribute('data-numero_iban');
        const numero_bic = trElement.getAttribute('data-numero_bic');
        const solde = trElement.getAttribute('data-solde');
        const devise = trElement.getAttribute('data-devise');
        const type = trElement.getAttribute('data-type');
        const code_banque = trElement.getAttribute('data-code-banque');
        const code_guichet = trElement.getAttribute('data-code-guichet');
        const cle_rib = trElement.getAttribute('data-cle-rib');
        const domiciliation = trElement.getAttribute('data-domiciliation');
        const numero_compte = trElement.getAttribute('numero-compte');
        const cle_iban = trElement.getAttribute('numero-compte');
        const date_creation = trElement.getAttribute('data-date-creation');

        const formulaire = document.getElementById('formulaire_modif');
        formulaire.querySelector('input[name="id_compte"]').value = id_compte;
        formulaire.querySelector('input[name="numero_iban"]').value = numero_iban;
        formulaire.querySelector('input[name="numero_bic"]').value = numero_bic;
        formulaire.querySelector('input[name="solde"]').value = solde;
        formulaire.querySelector('select[name="devise"]').value = devise;
        formulaire.querySelector('select[name="type"]').value = type;
        formulaire.querySelector('input[name="code_banque"]').value = code_banque;
        formulaire.querySelector('input[name="code_guichet"]').value = code_guichet;
        formulaire.querySelector('input[name="cle_rib"]').value = cle_rib;
        formulaire.querySelector('input[name="domiciliation"]').value = domiciliation;
        formulaire.querySelector('input[name="numero_compte"]').value = numero_compte;
        formulaire.querySelector('input[name="cle_iban"]').value = cle_iban;
        formulaire.querySelector('input[name="date_creation"]').value = date_creation;
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
    }

    var formulaire_ajou = document.getElementById('formulaire_ajout');
    formulaire_ajou.addEventListener('submit', function(event) {
        event.preventDefault();

           var formData = new FormData(formulaire_ajou);
           var request = new XMLHttpRequest();
           request.open('POST', '/store_compte_bancaire');
           request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
           request.onreadystatechange = function() {
            if (request.readyState === XMLHttpRequest.DONE) {
                if (request.status === 200) {
                    effacer_erreurs();
                    toastr.success('Ajout éffectué avec succès.', 'OK');
                } else {
                    var response = JSON.parse(request.responseText);
                    if (response.errors) {
                       effacer_erreurs();
                        var errors = response.errors;
                        Object.keys(errors).forEach(function(key) {
                            var inputField = formulaire_ajou.querySelector('[name="' + key + '"]');
                            if (inputField) {
                                var errorElement = document.createElement('span');
                                errorElement.className = 'error-message text-red-500';
                                errorElement.textContent = errors[key][0];
                                inputField.parentNode.appendChild(errorElement);
                            }
                        });
                    } else {
                        toastr.error('Une erreur s\'est produite lors de la requête.', 'Erreur');
                    }
                }
            }

           };
           request.send(formData);
       
    });
  
    var formulaire_modif = document.getElementById('formulaire_modif');
    formulaire_modif.addEventListener('submit', function(event) {

        event.preventDefault();
        var data_to_modify = new FormData(formulaire_modif);
        var request = new XMLHttpRequest();
        request.open('POST', '/edit_compte');
        request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        request.onreadystatechange = function() {
            if (request.readyState === XMLHttpRequest.DONE) {
                if (request.status === 200) {
                    effacer_erreurs();
                    toastr.success('Compte modifié avec succès.', 'OK');
                }else if(request.status === 419){
                    toastr.error('Cette a expiré! Veuillez recharger la page pour continuer...', 'Erreur');
                }else {
                    var response = JSON.parse(request.responseText);
                    if (response.errors) {
                        effacer_erreurs();
                        var errors = response.errors;
                        Object.keys(errors).forEach(function(key) {
                            var inputField = formulaire_modif.querySelector('[name="' + key + '"]');
                            if (inputField) {
                                var errorElement = document.createElement('span');
                                errorElement.className = 'error-message text-red-500';
                                errorElement.textContent = errors[key][0];
                                inputField.parentNode.appendChild(errorElement);
                            }
                        });
                    } else {
                        toastr.error('Une erreur s\'est produite lors de la requête.', 'Erreur');
                    }
                }
            }

        };
        request.send(data_to_modify);
    });

</script> 
   