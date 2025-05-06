<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prediksi Kelulusan Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 20px;
            background-color: #f8f9fa;
        }
        .card {
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .table-responsive {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Prediksi Kelulusan Mahasiswa</h1>
        <a href="test_input.php" class="btn btn-warning">Test Input Baru</a>    <a href="decision_tree_visualization.php" class="btn btn-success">Visualiasi Tree</a>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Data Training</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="trainingTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>IPK</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT nim, nama, ipk, status_kelulusan FROM mahasiswa_training";
                                    $result = $conn->query($sql);
                                    
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>".$row['nim']."</td>
                                                    <td>".$row['nama']."</td>
                                                    <td>".$row['ipk']."</td>
                                                    <td>".$row['status_kelulusan']."</td>
                                                  </tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0">Data Testing</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="testingTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>IPK</th>
                                        <th>Status</th>
                                        <th>Prediksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT nim, nama, ipk, status_kelulusan, prediksi FROM mahasiswa_testing";
                                    $result = $conn->query($sql);
                                    
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>".$row['nim']."</td>
                                                    <td>".$row['nama']."</td>
                                                    <td>".$row['ipk']."</td>
                                                    <td>".$row['status_kelulusan']."</td>
                                                    <td>".($row['prediksi'] ?? '-')."</td>
                                                  </tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            <a href="predict.php" class="btn btn-primary">Lakukan Prediksi</a>
                            <a href="evaluate.php" class="btn btn-info">Evaluasi Akurasi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#trainingTable').DataTable();
            $('#testingTable').DataTable();
        });
    </script>
</body>
</html>