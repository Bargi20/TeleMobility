// Seleziona tutte le domande e la rispettiva risposta
var domande = document.querySelectorAll('.Domanda');

// Aggiungi un evento di click a ciascuna domanda
domande.forEach(function(domanda) {
    domanda.addEventListener('click', function() {
        // Trova la risposta relativa a questa domanda
        var risposta = this.nextElementSibling;
        
        // Toggle dello stato di visualizzazione della risposta
        if (risposta.style.display === 'none' || risposta.style.display === '') {
            risposta.style.display = 'block';
        } else {
            risposta.style.display = 'none';
        }
    });
});

//fa la stessa cosa di quella di sopra ma avendo cambiato i nomi delle classi per le FAQ dell'admin
//l'ho dovuta riscrivere con  le classi nuove
var domandeNew = document.querySelectorAll('.domandaFaqAdmin');

domandeNew.forEach(function(domandaNew) {
    domandaNew.addEventListener('click', function() {
        // Trova la risposta relativa a questa domanda
        var rispostaNew = this.nextElementSibling;
        
        // Toggle dello stato di visualizzazione della risposta
        if (rispostaNew.style.display === 'none' || rispostaNew.style.display === '') {
            rispostaNew.style.display = 'block';
        } else {
            rispostaNew.style.display = 'none';
        }
    });
});