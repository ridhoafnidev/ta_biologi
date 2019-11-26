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

$app ->get('/semua-guru', function() use($app, $db){
	$murid["error"] = false;
	$murid["message"] = "Berhasil mendapatkan data murid";
    foreach($db->tbl_guru() as $data){
        $murid['semua-guru'][] = array(
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

$app ->get('/guru/{id}', function($request, $response, $args) use($app, $db){
    $guru = $db->tbl_murid()->where('id_guru',$args['id']);
    $gurudetail = $guru->fetch();

    if ($guru->count() == 0) {
        $responseJson["error"] = true;
        $responseJson["message"] = "Nama murid belum tersedia di database";
        $responseJson["id_guru"] = null;
        $responseJson["unique_id"] = null;
        $responseJson["nama_lengkap"] = null;
        $responseJson["username"] = null;
        $responseJson["alamat"] = null;
        $responseJson["password"] = null;
    } else {
        $responseJson["error"] = false;
        $responseJson["message"] = "Berhasil mengambil data";
        $responseJson["id"] = $gurudetail['id'];
        $responseJson["unique_id"] = $gurudetail['unique_id'];
        $responseJson["nama_lengkap"] = $gurudetail['nama_lengkap'];
        $responseJson["username"] = $gurudetail['username'];
        $responseJson["password"] = $gurudetail['password'];
        $responseJson["alamat"] = $gurudetail['alamat'];
    }

    echo json_encode($responseJson); 
});

$app ->get('/semua-soal', function() use($app, $db){
    if ($db->tbl_soal()->count() == 0) {
        $responseJson["error"] = true;
        $responseJson["message"] = "Belum mengambil soal";
    } else {
        $responseJson["error"] = false;
        $responseJson["message"] = "Berhasil mendapatkan data soal";
        foreach($db->tbl_soal() as $data){
        $responseJson['semua-soal'][] = array(
            'id_soal' => $data['id_soal'],
            'guru_id' => $data['guru_id'],
            'pertanyaan1' => $data['pertanyaan1'],
            'pertanyaan2' => $data['pertanyaan2'],
            'pertanyaan3' => $data['pertanyaan3'],
            'pertanyaan4' => $data['pertanyaan4'],
            'pertanyaan5' => $data['pertanyaan5']
            );
        }
    }
    echo json_encode($responseJson);
});

$app->post('/simpan-soal', function($request, $response, $args) use($app, $db){
    $soal = $request->getParams();
    $result = $db->tbl_soal->insert($soal);

    $responseJson["error"] = false;
    $responseJson["message"] = "Berhasil menambahkan ke database";
    echo json_encode($responseJson);
});

$app->delete('/delete/{id}', function($request, $response, $args) use($app, $db){
    $soal = $db->tbl_soal()->where('id_soal', $args);
    if($matkul->fetch()){
        $result = $soal->delete();
        echo json_encode(array(
            "error" => false,
            "message" => "Soal berhasil dihapus"));
    }
    else{
        echo json_encode(array(
            "error" => true,
            "message" => "Matkul ID tersebut tidak ada"));
    }
});

//run App
$app->run();