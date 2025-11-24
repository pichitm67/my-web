<?php
require 'db.php';

if (isset($_POST['product_id']) && isset($_POST['amount'])) {
    $id = $_POST['product_id'];
    $amount = $_POST['amount'];

    $sql = "UPDATE products SET stock = stock + $amount WHERE id = $id";
    mysqli_query($conn, $sql);

    $msg = "อัปเดตสต็อกสำเร็จแล้ว 🎉";
}

$result = mysqli_query($conn, "SELECT * FROM products");
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>เพิ่มสต็อกสินค้า</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">Keyboard Store</div>
    <nav>
        <a href="index.php">หน้าแรก</a>
        <a href="cart.php">ตะกร้าสินค้า</a>
        <a href="add_stock.php">เติมสต็อก</a>
    </nav>
</header>

<div class="container">
    <h1>เพิ่มสต็อกสินค้า</h1>

    <?php if (!empty($msg)): ?>
        <p style="color: green;"><?php echo $msg; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>เลือกสินค้า:</label><br>
        <select name="product_id" required>
            <?php while($p = mysqli_fetch_assoc($result)): ?>
                <option value="<?php echo $p['id']; ?>">
                    <?php echo $p['name']; ?> (คงเหลือ: <?php echo $p['stock']; ?>)
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label>จำนวนที่ต้องการเติม:</label><br>
        <input type="number" name="amount" required min="1"><br><br>

        <button type="submit" class="btn">เพิ่มสต็อก</button>
    </form>
</div>

</body>
</html>
 