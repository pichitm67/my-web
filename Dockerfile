# ใช้ PHP 8.2 แบบ CLI
FROM php:8.2-cli

# ติดตั้ง extension สำหรับ MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# โฟลเดอร์ทำงานใน container
WORKDIR /app

# ก็อปปี้ไฟล์ทั้งหมดเข้าไป
COPY . /app

# รันเว็บเซิร์ฟเวอร์ของ PHP และให้ใช้พอร์ตจากตัวแปร $PORT (Render กำหนดให้)
CMD php -S 0.0.0.0:$PORT
