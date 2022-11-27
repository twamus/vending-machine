<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$items=getInventory();

function getInventory(){
    //Get items from inventory file, return them in an array
    $inv=file_get_contents("inventory.txt") or die("Unable to open inventory file!");
    $items=json_decode($inv);
    return $items;
}
?>
<html>
    <head>
        <title>Vending Machine</title>
        <link rel="stylesheet" href="styles.css">
        <script type="text/javascript" src="core.js"></script>
        <script>
            // Passes PHP inventory to JavaScript for inventory changing
            // Also, handling PHP nuance of changing numbers to string
            var inventory=<?php echo json_encode($items,JSON_NUMERIC_CHECK);?>;
        </script>
    </head>
    <body>
        <form>
            <table>
            <tr>
                <td>Soda</td>
                <td>$0.95</td>
                <td><input type="number" id="soda" value=0></td>
                <td><?php echo $items[0];?> items remaining</td>
            </tr>
            <tr>
                <td>Candy Bar</td>
                <td>$0.60</td>
                <td><input type="number" id="candybar" value=0></td>
                <td><?php echo $items[1];?> items remaining</td>
            </tr>
            <tr>
                <td>Chips</td>
                <td>$0.99</td>
                <td><input type="number" id="chips" value=0></td>
                <td><?php echo $items[2];?> items remaining</td>
            </tr>
            <tr colspan="2">
                <td><input type="button" value="Order" onclick="orderUp();"></td>
            </table>
        </form>
        <textarea id="transactions"><?php echo file_get_contents("transactionlog.txt"); ?></textarea>

    </body>

</html>
