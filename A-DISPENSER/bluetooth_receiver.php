<?php
// Koneksi ke database MySQL
$servername = "localhost"; // Ganti dengan host server Anda
$username = "root";        // Ganti dengan username MySQL Anda
$password = "";            // Ganti dengan password MySQL Anda
$dbname = "automatic_dispenser"; // Nama database Anda

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Cek jika data dikirimkan melalui POST
if (isset($_POST['status']) && isset($_POST['distance']) && isset($_POST['time'])) {
    // Ambil data yang diterima dari POST
    $status = $_POST['status'];
    $distance = $_POST['distance'];
    $time = $_POST['time'];

    // Menyimpan data ke dalam database
    $sql = "INSERT INTO dispenser_data (status, distance, time) 
            VALUES ('$status', '$distance', '$time')";

    if ($conn->query($sql) === TRUE) {
        // Jika data berhasil disimpan, kirimkan respons JSON
        echo json_encode([
            'status' => $status,
            'distance' => $distance,
            'time' => $time,
            'message' => 'Data berhasil disimpan'
        ]);
    } else {
        // Jika terjadi error saat menyimpan data, kirimkan respons error JSON
        echo json_encode([
            'error' => 'Gagal menyimpan data: ' . $conn->error
        ]);
    }
} else {
    // Jika data tidak lengkap, kirimkan error JSON
    echo json_encode([
        'error' => 'Data tidak lengkap'
    ]);
}

// Menutup koneksi
$conn->close();
?>
