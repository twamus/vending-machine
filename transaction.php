<?php
    // Get current inventory numbers
    
    $inv=file_get_contents("inventory.txt") or die("Unable to open inventory file!");
    $items=json_decode($inv);

    // Convert passed JSON string to object, add current inventory to transaction
    $json=json_decode($_GET['arg'],true);
    
    // Update inventory items array, update inventory
    $items[0]-=$json['soda'];
    $items[1]-=$json['candybar'];
    $items[2]-=$json['chips'];
    $json['remaining']=[$items[0],$items[1],$items[2]];
    file_put_contents("inventory.txt",json_encode($items, JSON_NUMERIC_CHECK)) or die("Write access issue! Check permissions on write access to file on server.");

    // Add to ledger with items remaining
    $inv=fopen("transactionlog.txt", "a") or die("Unable to open transaction file! Likely write access issue or file already in use.");
    fwrite($inv,json_encode($json,JSON_NUMERIC_CHECK).PHP_EOL);
    fclose($inv);
    return 1;
    

?>