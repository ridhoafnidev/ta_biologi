<?php
 
class DB_Functions {
 
    private $conn;
 
    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // koneksi ke database
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }
 
    // destructor
    function __destruct() {
         
    }
 
    public function simpanGuru($nama_lengkap, $username, $password, $alamat) {
        $uuid = uniqid('', true);
        $hash = $this->hashSSHA($password);
        $password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt
 
        $stmt = $this->conn->prepare("INSERT INTO tbl_guru(unique_id, username, password, nama_lengkap, alamat, salt) VALUES(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $uuid, $username, $password, $nama_lengkap, $alamat, $salt);
        $result = $stmt->execute();
        $stmt->close();
 
        // cek jika sudah sukses
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM tbl_guru WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $guru = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            return $guru;
        } else {
            return false;
        }
    }
 
    /**
     * Get user berdasarkan email dan password
     */
    public function getGurudByUsernameAndPassword($username, $pwd) {
 
        $stmt = $this->conn->prepare("SELECT * FROM tbl_guru WHERE username = ?");
 
        $stmt->bind_param("s", $username);
 
        if ($stmt->execute()) {
            $guru = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            // verifikasi password user
            $salt = $guru['salt'];
            $encrypted_password = $guru['password'];
            $hash = $this->checkhashSSHA($salt, $pwd);
            // cek password jika sesuai
            if ($encrypted_password == $hash) {
                // autentikasi user berhasil
                return $guru;
            }
        } else {
            return NULL;
        }
    }
 
    /**
     * Cek User ada atau tidak
     */
    public function isGuruExisted($username) {
        $stmt = $this->conn->prepare("SELECT username from tbl_guru WHERE username = ?");
 
        $stmt->bind_param("s", $username);
 
        $stmt->execute();
 
        $stmt->store_result();
 
        if ($stmt->num_rows > 0) {
            // user telah ada 
            $stmt->close();
            return true;
        } else {
            // user belum ada 
            $stmt->close();
            return false;
        }
    }
 
    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
    public function hashSSHA($password) {
 
        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }
 
    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($salt, $password) {
 
        $hash = base64_encode(sha1($password.$salt, true) . $salt);
 
        return $hash;
    }
 
}
 
?>