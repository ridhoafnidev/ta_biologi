<?php 
require __DIR__ . '/vendor/autoload.php';
require 'libs/NotORM.php'; 

use \Slim\App;

$app = new App();

$dbhost = '127.0.0.1';
$dbuser = 'n6171848_biologi';
$dbpass = 'biologi';
$dbname = 'n6171848_biologi';
$dbmethod = 'mysql:dbname=';

$dsn = $dbmethod.$dbname;
$pdo = new PDO($dsn, $dbuser, $dbpass);
$db  = new NotORM($pdo);

$app-> get('/', function(){
    echo "API Biologi";
});

$app ->get('/semuamguru', function() use($app, $db){
	$murid["error"] = false;
	$murid["message"] = "Berhasil mendapatkan data murid";
    foreach($db->tbl_murid() as $data){
        $murid['semuaguru'][] = array(
            'id' => $data['id'],
            'nama_lengkap' => $data['nama_lengkap'],
            'username' => $data['username'],
            'alamat' => $data['alamat'],
            'unique_id' => $data['unique_id'],
            'password' => $data['password']
            );
    }
    echo json_encode($murid);
});

$app ->get('/murid/{id}', function($request, $response, $args) use($app, $db){
    $murid = $db->tbl_murid()->where('id',$args['id']);
    $muriddetail = $murid->fetch();

    if ($murid->count() == 0) {
        $responseJson["error"] = true;
        $responseJson["message"] = "Nama murid belum tersedia di database";
        $responseJson["nama"] = null;
        $responseJson["username"] = null;
        $responseJson["mata_pelajaran"] = null;
        $responseJson["kelas"] = null;
        $responseJson["password"] = null;
    } else {
        $responseJson["error"] = false;
        $responseJson["message"] = "Berhasil mengambil data";
        $responseJson["nama"] = $muriddetail['nama'];
        $responseJson["mata_pelajaran"] = $muriddetail['mata_pelajaran'];
        $responseJson["username"] = $muriddetail['username'];
        $responseJson["email"] = $muriddetail['email'];
        $responseJson["kelas"] = $muriddetail['kelas'];
    }

    echo json_encode($responseJson); 
});

$app ->get('/matkul', function() use($app, $db){
    if ($db->tbl_matkul()->count() == 0) {
        $responseJson["error"] = true;
        $responseJson["message"] = "Belum mengambil mata kuliah";
    } else {
        $responseJson["error"] = false;
        $responseJson["message"] = "Berhasil mendapatkan data mata kuliah";
        foreach($db->tbl_matkul() as $data){
        $responseJson['semuamatkul'][] = array(
            'id' => $data['id'],
            'nama_dosen' => $data['nama_dosen'],
            'matkul' => $data['matkul']
            );
        }
    }
    echo json_encode($responseJson);
});

$app->post('/matkul', function($request, $response, $args) use($app, $db){
    $matkul = $request->getParams();
    $result = $db->tbl_matkul->insert($matkul);

    $responseJson["error"] = false;
    $responseJson["message"] = "Berhasil menambahkan ke database";
    echo json_encode($responseJson);
});

$app->delete('/matkul/{id}', function($request, $response, $args) use($app, $db){
    $matkul = $db->tbl_matkul()->where('id', $args);
    if($matkul->fetch()){
        $result = $matkul->delete();
        echo json_encode(array(
            "error" => false,
            "message" => "Matkul berhasil dihapus"));
    }
    else{
        echo json_encode(array(
            "error" => true,
            "message" => "Matkul ID tersebut tidak ada"));
    }
});

//run App
$app->run();