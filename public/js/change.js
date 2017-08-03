function check (id) {
    var currency = document.getElementById('select_currency_' + id).value;
    var quantity = document.getElementById('quantity_' + id).value;
    var asset = document.getElementById('asset_' + id).value;
    var button = document.getElementById('change_' + id);
    
    if (currency !== '' && quantity !== '' && currency !== asset) {
        button.disabled = false;
    } else {
        button.disabled = true;
    }
}

function change (id) {
    var currency = document.getElementById('select_currency_' + id).value;
    var quantity = document.getElementById('quantity_' + id).value;
    
    var http = new XMLHttpRequest();
    var url = "/check";
    var params = "asset_id=" + id + "&currency=" + currency + "&quantity=" + quantity;
    http.open("POST", url, true);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    http.onreadystatechange = function() {
        if(http.readyState === 4 && http.status === 200) {
           if (http.responseText === "ok") {
               document.getElementById('done').style.display = 'block';
               window.location.replace("/change");
           } else {
                if (http.responseText === "insufficient") {
                    document.getElementById('insufficient').style.display = 'block';
                } else {
                    document.getElementById('error').style.display = 'block';
                }
           }
        }
    };
    http.send(params);
}