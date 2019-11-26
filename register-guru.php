<?php
 
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
if (
    isset($_POST['nama_lengkap']) && 
    isset($_POST['username']) && 
    isset($_POST['password']) && 
    isset($_POST['alamat'])) {
 
    // menerima parameter POST ( nama, email, password )
    $nama_lengkap = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $alamat = $_POST['alamat'];
 
    // Cek jika user ada dengan email yang sama
    if ($db->isGuruExisted($username)) {
        // user telah ada
        $response["error"] = TRUE;
        $response["error_msg"] = "User telah ada dengan username " . $username;
        echo json_encode($response);
    } else {
        // buat user baru
        $guru = $db->simpanGuru($nama_lengkap, $username, $password, $alamat);
        if ($guru) {
            // simpan user berhasil
            $response["error"] = FALSE;
            $response["uid"] = $guru["unique_id"];
            $response["guru"]["nama_lengkap"] = $guru["nama_lengkap"];
            $response["guru"]["username"] = $guru["username"];
            $response["guru"]["password"] = $guru["password"];
            $response["guru"]["alamat"] = $guru["alamat"];
            echo json_encode($response);
        } else {
            // gagal menyimpan user
            $response["error"] = TRUE;
            $response["error_msg"] = "Terjadi kesalahan saat melakukan registrasi";
            echo json_encode($response);
        }
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Parameter (nama, username, atau password) ada yang kurang";
    echo json_encode($response);
}
?>