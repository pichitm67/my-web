<?php
require 'db.php';

$sql = "SELECT p.*, c.name AS category_name
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.id
        ORDER BY p.created_at DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Keyboard Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="container">
        <div class="logo">Keyboard Store</div>
        <nav>
            <a href="index.php">หน้าแรก</a>
            <a href="cart.php">ตะกร้าสินค้า</a>
        </nav>
    </div>
</header>

<h1>สินค้าในร้าน Keyboard Store</h1>

<?php while($row = mysqli_fetch_assoc($result)): ?>
    <div class="product">
<a href="cart.php?id=<?php echo $row['id']; ?>" class="btn">เพิ่มลงตะกร้า</a>

        <img src="uploads/<?php echo $row['image']; ?>" 
             alt="<?php echo $row['name']; ?>" 
             style="width:200px; height:auto; display:block; margin-bottom:10px;">

        <strong><?php echo $row['name']; ?></strong><br>
        หมวดหมู่: <?php echo $row['category_name']; ?><br>
        ราคา: <?php echo number_format($row['price'], 2); ?> บาท<br>
        คงเหลือ: <?php echo $row['stock']; ?> ชิ้น<br>
        <div>
            <?php echo nl2br(htmlspecialchars($row['description'])); ?>
        </div>
    </div>
<?php endwhile; ?>

</body>
</html>
