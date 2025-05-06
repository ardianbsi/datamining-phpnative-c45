<?php 
include 'config.php';

// Fungsi prediksi yang sama seperti sebelumnya
function predictStatus($ipk, $sks, $semester, $nilai_d, $nilai_e) {
    if ($ipk >= 3.0 && $sks >= 144 && $semester <= 8 && $nilai_d <= 1 && $nilai_e == 0) {
        return 'Tepat Waktu';
    } else {
        return 'Terlambat';
    }
}

// Ambil data dari form
$nim = $_POST['nim'];
$nama = $_POST['nama'];
$ipk = floatval($_POST['ipk']);
$sks = intval($_POST['sks']);
$semester = intval($_POST['semester']);
$nilai_d = intval($_POST['nilai_d']);
$nilai_e = intval($_POST['nilai_e']);

// Lakukan prediksi
$prediction = predictStatus($ipk, $sks, $semester, $nilai_d, $nilai_e);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Prediksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
        }
        .card {
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .result-card {
            border-left: 5px solid <?= $prediction == 'Tepat Waktu' ? '#28a745' : '#dc3545' ?>;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card result-card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Hasil Prediksi</h5>
            </div>
            <div class="card-body">
                <h4>Data Mahasiswa:</h4>
                <table class="table table-bordered">
                    <tr>
                        <th>NIM</th>
                        <td><?= htmlspecialchars($nim) ?></td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td><?= htmlspecialchars($nama) ?></td>
                    </tr>
                    <tr>
                        <th>IPK</th>
                        <td><?= $ipk ?></td>
                    </tr>
                    <tr>
                        <th>SKS</th>
                        <td><?= $sks ?></td>
                    </tr>
                    <tr>
                        <th>Semester</th>
                        <td><?= $semester ?></td>
                    </tr>
                    <tr>
                        <th>Nilai D</th>
                        <td><?= $nilai_d ?></td>
                    </tr>
                    <tr>
                        <th>Nilai E</th>
                        <td><?= $nilai_e ?></td>
                    </tr>
                </table>
                
                <div class="alert alert-<?= $prediction == 'Tepat Waktu' ? 'success' : 'danger' ?> mt-4">
                    <h4 class="alert-heading">Hasil Prediksi:</h4>
                    <p class="mb-0"><strong><?= $prediction ?></strong></p>
                </div>
                
                <a href="test_input.php" class="btn btn-primary">Test Lagi</a>
                <a href="index.php" class="btn btn-secondary">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>