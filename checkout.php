<?php
session_start();
require 'db.php';

if (empty($_SESSION['cart'])) {
    die("ไม่มีสินค้าในตะกร้า");
}

foreach ($_SESSION['cart'] as $id => $item) {
    $qty = $item['quantity'];

    // ลด stock
    $sql = "UPDATE products SET stock = stock - $qty WHERE id = $id";
    mysqli_query($conn, $sql);
}

// ล้างตะกร้า
$_SESSION['cart'] = [];
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>สั่งซื้อสำเร็จ</title>
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

<h1 style="text-align:center; margin-top:40px;">🎉 สั่งซื้อสำเร็จแล้ว!</h1>
<p style="text-align:center;">ระบบได้ทำการหักสต็อกสินค้าเรียบร้อย</p>
<p style="text-align:center; margin-top:15px;">
    <a href="index.php" class="btn">กลับไปหน้าร้าน</a>
</p>
</body>
</html>
