<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
    <div class="w3-container w3-display-container w3-padding-16">
        <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
        <h3 class="w3-wide"><b>Sibertime</b></h3>
    </div>
    <div class="w3-padding-28 w3-large w3-text-grey" style="font-weight:bold">
        <a href="index.php" class="w3-bar-item w3-button">SQL Injection</a>
        <a href="brute-force.php" class="w3-bar-item w3-button">Brute Force</a>
        <a href="xss.php" class="w3-bar-item w3-button">XSS</a>
        <a href="csrf.php" class="w3-bar-item w3-button">CSRF</a>
        <a href="open-redirect.php" class="w3-bar-item w3-button">Open Redirect</a>
        <a href="file-upload.php" class="w3-bar-item w3-button">File Upload</a>
        <a href="idor.php" class="w3-bar-item w3-button">IDOR</a>
    </div>
</nav>

<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
    <div class="w3-bar-item w3-padding-24 w3-wide">LOGO</div>
    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i
            class="fa fa-bars"></i></a>
</header>