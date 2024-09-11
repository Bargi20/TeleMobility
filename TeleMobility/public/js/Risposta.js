
    // Seleziona tutti i pulsanti con la classe 'mostra-nascondi'
    var pulsanti = document.querySelectorAll('.mostra-nascondi');

    // Aggiungi un evento di click a ciascun pulsante
    pulsanti.forEach(function(pulsante) {
        pulsante.addEventListener('click', function() {
            // Trova l'elemento del messaggio precedente
            var messaggioPrecedente = this.parentNode.nextElementSibling;

            // Toggle dello stato di visualizzazione del messaggio precedente
            if (messaggioPrecedente.style.display === 'none' || messaggioPrecedente.style.display === '') {
                messaggioPrecedente.style.display = 'block';
            } else {
                messaggioPrecedente.style.display = 'none';
            }
        });
    });
