<?php 
session_start();
include 'config.php';

if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])){
    $id = $_GET['id'];
    foreach($_SESSION["shopping_cart"] as $key => $value) {
        if($value['id'] == $id) {
            unset($_SESSION["shopping_cart"][$key]);
            break; 
        }
    }
    $_SESSION["shopping_cart"] = array_values($_SESSION["shopping_cart"]);
    header('location: mycart.php');
}
?>

<?php 
include 'header.php';
?>
<div class="container">
    <table  class="table table-bordered ">
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Total</th>
            <th>Remove</th>
        </tr>
        <?php
        $total = 0;
        if(!empty($_SESSION["shopping_cart"])) {
            foreach($_SESSION["shopping_cart"] as $key => $value) {
                ?>
                <tr>
                    <td><img src="./image/<?php echo $value["image"]; ?>" width="258" height="150"></td>
                    <td><?php echo $value["name"]; ?></td>
                    <td><?php echo $value["price"]; ?></td>
                    <td><?php echo isset($value["description"]) ? $value["description"] : ""; ?></td>
                    <td><?php echo isset($value["quantity"]) && isset($value["price"]) ? number_format($value["quantity"] * $value["price"]) : ""; ?></td>
                    <td><a href="mycart.php?action=delete&id=<?php echo $value["id"]; ?>">Remove</a></td>
                </tr>
                <?php
                if(isset($value["quantity"]) && isset($value["price"])) {
                    $total += ($value["quantity"] * $value["price"]);
                }
            }
        }
        ?>
        <tr>
            <td>Total</td>
            <td><?php echo number_format($total); ?></td>
        </tr>
    </table>
</div>
</body>
</html>
