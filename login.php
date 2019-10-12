<html>
    <head>
        <link rel="stylesheet" href="style.css" type="text/css" />
    </head>
    <body>
        <div id="konten">
            <form method="POST" action="">
            <fieldset>
                <legend>Form Member</legend>
                <label>username</label>
                <input type="text" name="username" />
                <label>email</label>
                <input type="text" name="email" />
                <label>password</label>
                <input type="password" name="password" />
                <input type="submit" name="submit" value="Submit" />
            </fieldset>
            </form>
        </div>
    </body>
</html>
<?php
    if(isset($_POST['submit'])) {
 
        define('ROOT', 'http://localhost/fatimah/latihan/');
        $koneksi = mysqli_connect("localhost","root","","login");
 
        $kode   = md5(uniqid(rand()));
        $password = md5($_POST['password']);
 
        $query = mysqli_query($koneksi,"INSERT INTO user (id, username, password, email, aktif, kode) VALUES ('', '$_POST[username]', '$password', '$_POST[email]','T', '$kode' )") or die (mysql_error());
        
 
        $to     = $_POST['email'];
        $judul  = "Aktivasi Akun Anda";
        $dari   = "From: fbadriyah07@gmail.com \n";
        $dari   .= "Content-type: text/html \r\n";
 
        $pesan  = "Klik link berikut untuk mengaktifkan akun: <br />";
        $pesan  .= "<a href='".ROOT."konfirm.php?email=".$_POST['email']."&kode=$kode&username=".$_POST['username']."'>".ROOT."konfirm.php?email=".$_POST['email']."&kode=$kode</a>";
 
        $kirim  = mail($to, $judul, $pesan, $dari);
 
        if($kirim AND $query)
        {
            echo "<p class='info'>Berhasil Dikirim</p>";
        }
        else
        {
            echo "<p class='infoGagal'>Gagal Dikirim</p>";
        }
 
    }
?>