<?php
 
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
if (
    isset($_POST['murid_id']) || 
    isset($_POST['jawaban1']) || 
    isset($_POST['jawaban2']) || 
    isset($_POST['jawaban3']) || 
    isset($_POST['jawaban4']) || 
    isset($_POST['jawaban5'])
    ) {
        
    $murid_id = $_POST['murid_id'];
    $jawaban1 = $_POST['jawaban1'];
    $jawaban2 = $_POST['jawaban2'];
    $jawaban3 = $_POST['jawaban3'];
    $jawaban4 = $_POST['jawaban4'];
    $jawaban5 = $_POST['jawaban5'];

        // buat jawaban baru
        $jawaban = $db->simpanJawaban($murid_id, $jawaban1, $jawaban2, $jawaban3, $jawaban4, $jawaban5);
        if ($jawaban) {
            // simpan jawaban berhasil
            $response["error"] = FALSE;
            $response["murid_id"] = $jawaban["murid_id"];
            $response["jawaban1"] = $jawaban["jawaban1"];
            $response["jawaban2"] = $jawaban["jawaban2"];
            $response["jawaban3"] = $jawaban["jawaban3"];
            $response["jawaban4"] = $jawaban["jawaban4"];
            $response["jawaban5"] = $jawaban["jawaban5"];
            echo json_encode($response);
        } else {
            // gagal menyimpan user
            $response["error"] = TRUE;
            $response["error_msg"] = "Terjadi kesalahan saat menginput jawaban";
            echo json_encode($response);
        }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Parameter (jawaban1, jawaban2, jawaban3, jawaban4 atau jawaban5) ada yang kurang";
    echo json_encode($response);
}
?>