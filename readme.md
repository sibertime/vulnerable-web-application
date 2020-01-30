![](https://raw.githubusercontent.com/sibertime/sibertime-vulnerable-web-application/master/img/readme/logo.png)

## Vulnerable Web Application

Zafiyetli web uygulaması php dili ile kodlanmış ve üzerinde çeşitli birçok zafiyet barındırmaktadır. Bu zafiyetler şunlardır :

  - Sql injection (Blind)
  - Cross Site Scripting (XSS) (Stored)
  - Insecure Direct Object References (IDOR)
  - Cross Site Request Forgery (CSRF)
  - Open Redirect
  - File Upload
  - Broken Authentication
  - Sensitive Data Exposure
  - Broken Access Control
  
  Uygulama Windows Server 2012 üzerinde xampp'ın en gücel sürümü ile test edilmiştir ve sorunsuz bir şekilde çalışmaktadır.
  
## Kurulum

- [XAMPP'i Linux veya windows üzerine indirmek için tıklayınız](https://www.apachefriends.org/tr/download.html "to install xampp") 
- [XAMPP'in nasıl kurulduğunu öğrenmek için tıklayınız](https://www.wikihow.com/Install-XAMPP-for-Windows "How to Install XAMPP") 
- İndirdiginiz dosyaları xampp üzerinden "C:\xampp\htdocs", wamp üzerinden "C:\wamp\www", linux üzerinden ise "/var/www/html" dizini içine yüklemeniz yeterli olacaktır.
- Veritabanı baglantısını gerçekleştirmek için "/config/config.php" adlı dosya içindeki bilgileri kendi sql server bilginiz ile değiştirmeniz yeterli olacaktır.
```config.php
    $con = new mysqli("localhost", "root", "", "veritabani_adi");
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "veritabani_adi";
```
- Settings dizini içinde bulunan "egitim.sql" adlı dosyayı veritabanına yüklemek yeterli olacaktır.
