// prices in cents to avoid numerical javascript errors when multiplying
var prices=[95,60,99];
debug=0;

console.log();
function orderUp(){
    var purchases=[
        document.getElementById("soda").value,
        document.getElementById("candybar").value,
        document.getElementById("chips").value
    ];
    var timestamp=Date.now();
    // Checks inventory, if there's enough, proceed, if not, function ends
    if(inventoryCheck(purchases)){
        var total=
        (prices[0]*purchases[0])
        +
        (prices[1]*purchases[1])
        +
        (prices[2]*purchases[2]);
        var transaction={
            "time": Date.now(),
            "soda": purchases[0],
            "candybar": purchases[1],
            "chips": purchases[2],
            "total": total/100
        };
        fetch('transaction.php?arg='+JSON.stringify(transaction))
            .then(response => response.text())
                .then(data => console.log(data))
                    .then(successReload(timestamp));
    }
}
function inventoryCheck(purchases){
    if(inventory[0] < purchases[0]){alert("Out of Soda!"); return 0}
    else if(inventory[1] < purchases[1]){alert("Out of Candy Bars!"); return 0;}
    else if(inventory[2] < purchases[2]){alert("Out of Chips!"); return 0;}
    return 1;
}
function successReload(){
    // reloads upon success if debug is off
    // can be done away with later with live updates of inventory
    if(!debug){
        //alert("Vending success!");
        setTimeout(function () {
            location.reload()
        });
        return false;
    }
    
}