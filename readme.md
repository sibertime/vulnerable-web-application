![](https://raw.githubusercontent.com/sibertime/sibertime-vulnerable-web-application/master/img/readme/logo.png)

## Büsiber Kış Kampı için hazırlanan Zafiyetli Web Uygulaması Hakkında

2020 Büsiber Kış Kampı için hazırlanmış zafiyetli web uygulaması, kampa katılacak kursiyerler için özel olarak hazırlanmıştır. Uygulama php dili ile kodlanmış ve üzerinde çeşitli birçok zafiyet barındırmaktadır. Bu zafiyetler şunlardır :

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
- Settings dizini içinde bulunan "siber_kamp.sql" adlı dosyayı veritabanına yüklemek yeterli olacaktır.

## Uygulama içi görseller

[![N|Cybrbook](https://raw.githubusercontent.com/sibertime/busiber-kis-kampi-zafiyetli-web-uygulamasi/master/uploads/idor.png)](https://github.com/sibertime/busiber-kis-kampi-zafiyetli-web-uygulamasi/)


[![N|Cybrbook](https://raw.githubusercontent.com/sibertime/busiber-kis-kampi-zafiyetli-web-uygulamasi/master/uploads/csrf.png)](https://github.com/sibertime/busiber-kis-kampi-zafiyetli-web-uygulamasi/)


[![N|Cybrbook](https://raw.githubusercontent.com/sibertime/busiber-kis-kampi-zafiyetli-web-uygulamasi/master/uploads/sql.png)](https://github.com/sibertime/busiber-kis-kampi-zafiyetli-web-uygulamasi/)


[![N|Cybrbook](https://raw.githubusercontent.com/sibertime/busiber-kis-kampi-zafiyetli-web-uygulamasi/master/uploads/xss.png)](https://github.com/sibertime/busiber-kis-kampi-zafiyetli-web-uygulamasi/)

[Sunum sırasında kullanılan python dosyasına ulaşmak için tıklayınız](https://raw.githubusercontent.com/sibertime/busiber-kis-kampi-zafiyetli-web-uygulamasi/master/python.py "python code") 
