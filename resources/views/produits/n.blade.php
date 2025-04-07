function category_on_change(){
    categorieSelect2.addEventListener('change', function() {
        categorieInput2.value = categorieSelect2.options[categorieSelect2.selectedIndex].text;
        const produitsInput2 = document.getElementById('produitsInput2');
        const produitsSelect2 = document.getElementById('produitsSelect2');
        $.ajax({
            url: '/render-produits',
            method: 'GET',
            data: { query: this.value },
            success: function(response) {
                if(response.length > 0){
                    if(response.length == 1){
                        produitsSelect2.innerHTML = '<option disabled value="">1 résultat</option>';
                    }else{
                        produitsSelect2.innerHTML = '<option disabled value="">'+ response.length +' résultats</option>';
                    }
                    response.forEach(function(produit) {
                        produitsSelect2.innerHTML += `<option value="${produit.id}">${produit.reference} _ ${produit.designation} _ ${produit.format} </option>`;
                    });
                }else{
                    produitsSelect2.innerHTML = '<option disabled value="">0 résultat</option>';
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
}