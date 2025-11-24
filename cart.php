<?php
session_start();
require 'db.php';

// ------------------ เพิ่มสินค้าลงตะกร้า ------------------
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // ดึงข้อมูลสินค้าจากฐานข้อมูล
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($result);

    if ($product) {
        // ถ้ายังไม่มีตะกร้า → สร้างตะกร้า
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // ถ้าสินค้าเคยถูกเพิ่มมาแล้ว → +1
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity']++;
        } 
        else { // ถ้าเพิ่มครั้งแรก → สร้างสินค้าในตะกร้า
            $_SESSION['cart'][$id] = [
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1
            ];
        }
    }

    // เพิ่มเสร็จแล้วกลับมาหน้า cart.php
    header("Location: cart.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ตะกร้าสินค้า</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">Keyboard Store</div>
    <nav>
        <a href="index.php">หน้าแรก</a>
        <a href="cart.php">ตะกร้าสินค้า</a>
    </nav>
</header>

<h1>ตะกร้าสินค้า</h1>

<?php if (!empty($_SESSION['cart'])): ?>
<table border="1" cellpadding="10" cellspacing="0" style="margin: 20px auto; width: 80%; background: white;">
    <tr>
        <th>สินค้า</th>
        <th>ราคา</th>
        <th>จำนวน</th>
        <th>รวม</th>
    </tr>

    <?php 
    $total = 0;
    foreach ($_SESSION['cart'] as $item): 
        $subtotal = $item['price'] * $item['quantity'];
        $total += $subtotal;
    ?>
    <tr>
        <td><?php echo $item['name']; ?></td>
        <td><?php echo number_format($item['price'], 2); ?> บาท</td>
        <td><?php echo $item['quantity']; ?></td>
        <td><?php echo number_format($subtotal, 2); ?> บาท</td>
    </tr>
    <?php endforeach; ?>

    <tr>
        <th colspan="3" style="text-align: right;">ยอดรวมทั้งหมด</th>
        <th><?php echo number_format($total, 2); ?> บาท</th>
    </tr>
</table>
</tr>
</table>

<p style="text-align:center; margin-top:20px;">
    <a href="checkout.php" class="btn">ยืนยันสั่งซื้อ</a>
</p>

<?php else: ?>
    <p style="text-align:center;">ยังไม่มีสินค้าในตะกร้า</p>
<?php endif; ?>

</body>
</html>
