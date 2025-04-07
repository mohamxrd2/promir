
    <script>
     function addEventsToCells(rows, correspondantCell, correspondantCellColumnTotal, isLastRowOfTable_){
            const isLastRowOfTable = document.getElementById(isLastRowOfTable_);
            rows.forEach(function(row){
                controlCellInput(row.children[correspondantCell])
                row.children[correspondantCell].addEventListener('input', function(){
                    tPortions = 0.0;
                    rows.forEach(function(row){
                        tPortions += convertirEnNombre(row.children[correspondantCell].textContent.trim()) || 0;
                    })

                    row.children[12].textContent = formatNumber((convertirEnNombre(row.children[11].textContent.trim())  || 0) + (convertirEnNombre(row.children[10].textContent.trim()) || 0))
                    row.children[13].textContent = formatNumber((convertirEnNombre(row.children[12].textContent.trim())  || 0) - (convertirEnNombre(row.children[8].textContent.trim()) || 0))
                    row.children[14].textContent = 
                    (convertirEnNombre(row.children[8].textContent.trim()) || 0) !== 0 
                    ? formatNumber((convertirEnNombre(row.children[13].textContent.trim()) || 0) / 
                    (convertirEnNombre(row.children[8].textContent.trim()) || 0)) + " %" 
                    : "0 %";


                    isLastRowOfTable.children[correspondantCellColumnTotal].textContent = formatNumber(tPortions);

                    isLastRowOfTable.children[8].textContent = formatNumber((convertirEnNombre(isLastRowOfTable.children[7].textContent.trim())  || 0) + (convertirEnNombre(isLastRowOfTable.children[6].textContent.trim()) || 0));
                    isLastRowOfTable.children[9].textContent = formatNumber((convertirEnNombre(isLastRowOfTable.children[8].textContent.trim())  || 0) - (convertirEnNombre(isLastRowOfTable.children[totalDuOfTableCell].textContent.trim()) || 0));


                    isLastRowOfTable.children[10].textContent = 
                    (convertirEnNombre(isLastRowOfTable.children[totalDuOfTableCell].textContent.trim()) || 0) !== 0 
                    ? formatNumber((convertirEnNombre(isLastRowOfTable.children[9].textContent.trim()) || 0) / 
                    (convertirEnNombre(isLastRowOfTable.children[totalDuOfTableCell].textContent.trim()) || 0)) + " %" 
                    : "0 %";
                });


            })
        }


                                            //#Dette fournisseur table
       
        //  Calling the function for the CUMUL J-1 cells
         addEventsToCells(rows("#detteFournisseursTable"), 10, 6 ,"isLastRowOfDetteFournisseurs")
        // Function called for the CUMUL J-1 cells
        

        // Calling the function for the J-0 cells
            addEventsToCells(rows("#detteFournisseursTable"), 11, 7,"isLastRowOfDetteFournisseurs")
        // Function called for the J-0 cells
        


                                        // #Dette banque table
        
        // // Calling the function for the CUMUL J-1 cells
         addEventsToCells(rows("#dettesBancairesTable"), 10, 6 , "isLastRowOfDetteBanques")
        // Function called for the CUMUL J-1 cells
        

        // Calling the function for the J-0 cells
            addEventsToCells(rows("#dettesBancairesTable"), 11, 7 , "isLastRowOfDetteBanques")
        // Function called for the J-0 cells


                                        // #autresDettesFinancieresTable

        // // // Calling the function for the CUMUL J-1 cells
         addEventsToCells(rows("#autresDettesFinancieresTable"), 10, 6 , "isLastRowOfCharges")
        // Function called for the CUMUL J-1 cells
        

        // Calling the function for the J-0 cells
            addEventsToCells(rows("#autresDettesFinancieresTable"), 11, 7 , "isLastRowOfCharges")
        // Function called for the J-0 cells





                                            // #Charges table

        // // // Calling the function for the CUMUL J-1 cells
        addEventsToCells(rows("#chargesTable"), 8, 4 , "isLastRowOfAutreDetteFinancieres")
        // Function called for the CUMUL J-1 cells
        

        // Calling the function for the J-0 cells
            addEventsToCells(rows("#chargesTable"), 9, 5 , "isLastRowOfAutreDetteFinancieres")
        // Function called for the J-0 cells

    </script>