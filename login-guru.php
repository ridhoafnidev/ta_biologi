<?php
require_once 'include/DB_Functions_Guru.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['username']) && isset($_POST['password'])) {
 
    // menerima parameter POST ( email dan password )
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    // get the user by email and password
    // get user berdasarkan email dan password
    $guru = $db->getGuruByUsernameAndPassword($username, $password);
 
    if ($guru != false) {
        // user ditemukan
        $response["error"] = FALSE;
        $response["uid"]                       = $guru["unique_id"];
        $response["guru"]["nama_lengkap"]      = $guru["nama_lengkap"];
        $response["guru"]["username"]          = $guru["username"];
        $response["guru"]["alamat"]            = $guru["alamat"];
        echo json_encode($response);
    } else {
        // user tidak ditemukan password/email salah
        $response["error"] = TRUE;
        $response["error_msg"] = "Login gagal. Password/Email salah";
        echo json_encode($response);
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Parameter (email atau password) ada yang kurang";
    echo json_encode($response);
}
?>