<?php 
include 'config.php';

// Algoritma prediksi sederhana berbasis aturan
function predictStatus($ipk, $sks, $semester, $nilai_d, $nilai_e) {
    // Aturan prediksi sederhana
    if ($ipk >= 3.0 && $sks >= 144 && $semester <= 8 && $nilai_d <= 1 && $nilai_e == 0) {
        return 'Tepat Waktu';
    } else {
        return 'Terlambat';
    }
}

// Ambil data testing yang belum diprediksi
$sql = "SELECT * FROM mahasiswa_testing WHERE prediksi IS NULL";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $prediction = predictStatus(
            $row['ipk'], 
            $row['sks'], 
            $row['semester'], 
            $row['jumlah_nilai_d'], 
            $row['jumlah_nilai_e']
        );
        
        // Update prediksi ke database
        $update_sql = "UPDATE mahasiswa_testing SET prediksi = ? WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("si", $prediction, $row['id']);
        $stmt->execute();
    }
}

header("Location: index.php?message=Prediksi+berhasil+dilakukan");
exit();
?>