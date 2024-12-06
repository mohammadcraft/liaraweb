<?php
// اطلاعات اتصال به دیتابیس
$host = 'licenses'; // آدرس سرور
$dbname = 'ecstatic_driscoll'; // نام دیتابیس
$username = 'root'; // نام کاربری
$password = '7AV7xkXbROrKjsQAAb2RylgX'; // پسورد

// تلاش برای اتصال به دیتابیس
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // تنظیم ویژگی‌ها برای مدیریت ارور‌ها
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // پرس و جو به دیتابیس برای گرفتن داده‌ها از جدول 'lic'
    $stmt = $pdo->query("SELECT * FROM lic");

    // شروع HTML
    echo "<!DOCTYPE html>
    <html lang='fa'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>داده‌های جدول lic</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                color: #333;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            .container {
                width: 80%;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                padding: 20px;
            }
            h1 {
                text-align: center;
                color: #007BFF;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            table, th, td {
                border: 1px solid #ddd;
            }
            th, td {
                padding: 12px;
                text-align: center;
            }
            th {
                background-color: #007BFF;
                color: white;
            }
            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            .no-data {
                text-align: center;
                color: #ff0000;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h1>داده‌های جدول lic</h1>";

    // نمایش داده‌ها
    if ($stmt->rowCount() > 0) {
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Data</th>
                </tr>";
        // اگر رکوردها وجود داشته باشن، نمایش داده می‌شن
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['data'] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p class='no-data'>هیچ داده‌ای پیدا نشد.</p>";
    }

    // پایان HTML
    echo "</div>
    </body>
    </html>";

} catch (PDOException $e) {
    // در صورت بروز خطا در اتصال
    echo "اتصال به دیتابیس با خطا مواجه شد: " . $e->getMessage();
}
?>
