<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Prediksi Kelulusan</title>
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
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Test Prediksi Kelulusan</h5>
            </div>
            <div class="card-body">
                <form method="post" action="predict_single.php">
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="ipk" class="form-label">IPK</label>
                        <input type="number" step="0.01" min="0" max="4" class="form-control" id="ipk" name="ipk" required>
                    </div>
                    <div class="mb-3">
                        <label for="sks" class="form-label">Total SKS</label>
                        <input type="number" class="form-control" id="sks" name="sks" required>
                    </div>
                    <div class="mb-3">
                        <label for="semester" class="form-label">Semester</label>
                        <input type="number" class="form-control" id="semester" name="semester" required>
                    </div>
                    <div class="mb-3">
                        <label for="nilai_d" class="form-label">Jumlah Nilai D</label>
                        <input type="number" class="form-control" id="nilai_d" name="nilai_d" required>
                    </div>
                    <div class="mb-3">
                        <label for="nilai_e" class="form-label">Jumlah Nilai E</label>
                        <input type="number" class="form-control" id="nilai_e" name="nilai_e" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Prediksi</button>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>