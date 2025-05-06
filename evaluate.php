<?php 
include 'config.php';

// Ambil data testing yang sudah memiliki prediksi dan status sebenarnya
$sql = "SELECT status_kelulusan, prediksi FROM mahasiswa_testing 
        WHERE status_kelulusan IS NOT NULL AND prediksi IS NOT NULL";
$result = $conn->query($sql);

$total = 0;
$correct = 0;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $total++;
        if ($row['status_kelulusan'] == $row['prediksi']) {
            $correct++;
        }
    }
}

$accuracy = ($total > 0) ? ($correct / $total) * 100 : 0;

header("Location: index.php?message=Akurasi+prediksi:+" . round($accuracy, 2) . "%25");
exit();
?>