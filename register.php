<?php
 
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['nama']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['kelas']) && isset($_POST['mata_pelajaran'])) {
 
    // menerima parameter POST ( nama, email, password )
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $kelas = $_POST['kelas'];
    $mata_pelajaran = $_POST['mata_pelajaran'];
 
    // Cek jika user ada dengan email yang sama
    if ($db->isUserExisted($username)) {
        // user telah ada
        $response["error"] = TRUE;
        $response["error_msg"] = "User telah ada dengan email " . $username;
        echo json_encode($response);
    } else {
        // buat user baru
        $murid = $db->simpanMurid($nama, $username, $password, $kelas, $mata_pelajaran);
        if ($murid) {
            // simpan user berhasil
            $response["error"] = FALSE;
            $response["uid"] = $murid["unique_id"];
            $response["murid"]["nama"] = $murid["nama"];
            $response["murid"]["username"] = $murid["username"];
            $response["murid"]["password"] = $murid["password"];
            $response["murid"]["kelas"] = $murid["kelas"];
            $response["murid"]["mata_pelajaran"] = $murid["mata_pelajaran"];
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
    $response["error_msg"] = "Parameter (nama, email, atau password) ada yang kurang";
    echo json_encode($response);
}
?>