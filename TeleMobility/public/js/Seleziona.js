function seleziona() {
    var checkboxes = document.getElementsByName('id_destinatario[]');
    var seleziona = document.getElementsByName('all')[0];

    if (seleziona.checked == false) {
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = false;
        }
    } else {
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = true;
        }
    }
}

function controlla() {
    var checkboxes = document.getElementsByName('id_destinatario[]');
    var seleziona = document.getElementsByName('all')[0];

    for (var i = 0; i < checkboxes.length; i++) {
            if(checkboxes[i].checked == false)
                {
                    seleziona.checked = false;
                    return;
                }
        }
    
    seleziona.checked = true;

    } 
