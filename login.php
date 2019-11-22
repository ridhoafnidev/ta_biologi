<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['username']) && isset($_POST['password'])) {
 
    // menerima parameter POST ( email dan password )
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    // get the user by email and password
    // get user berdasarkan email dan password
    $murid = $db->getMuridByUsernameAndPassword($username, $password);
 
    if ($murid != false) {
        // user ditemukan
        $response["error"] = FALSE;
        $response["uid"]                        = $murid["unique_id"];
        $response["murid"]["nama"]              = $murid["nama"];
        $response["murid"]["username"]          = $murid["username"];
        $response["murid"]["kelas"]             = $murid["kelas"];
        $response["murid"]["mata_pelajaran"]    = $murid["mata_pelajaran"];
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