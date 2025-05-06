<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualisasi Pohon Keputusan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/mermaid@10/dist/mermaid.min.js"></script>
    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
        }
        .card {
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        #treeDiagram {
            background-color: white;
            border-radius: 5px;
            padding: 20px;
            margin: 20px 0;
            overflow: auto;
        }
        .decision-node {
            background-color: #4e73df;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            display: inline-block;
            margin: 5px;
            font-weight: bold;
        }
        .leaf-node {
            background-color: #1cc88a;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            display: inline-block;
            margin: 5px;
            font-weight: bold;
        }
        .rule-box {
            background-color: #f8f9fc;
            border-left: 3px solid #4e73df;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 0 5px 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Visualisasi Pohon Keputusan Prediksi Kelulusan</h1>
        
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Diagram Pohon Keputusan</h5>
            </div>
            <div class="card-body">
                <div id="treeDiagram" class="mermaid">
                    graph TD
                    A[IPK ≥ 3.0?] -->|Ya| B[SKS ≥ 144?]
                    A -->|Tidak| E["Terlambat"]
                    B -->|Ya| C[Semester ≤ 8?]
                    B -->|Tidak| E
                    C -->|Ya| D[Jumlah Nilai D ≤ 1?]
                    C -->|Tidak| E
                    D -->|Ya| F[Jumlah Nilai E = 0?]
                    D -->|Tidak| E
                    F -->|Ya| G["Tepat Waktu"]
                    F -->|Tidak| E
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="card-title mb-0">Penjelasan Pohon Keputusan</h5>
            </div>
            <div class="card-body">
                <h4>Struktur Pohon:</h4>
                <ul>
                    <li><span class="decision-node">Node Keputusan</span>: Merepresentasikan kondisi/pertanyaan</li>
                    <li><span class="leaf-node">Daun</span>: Merepresentasikan hasil prediksi akhir</li>
                </ul>
                
                <h4 class="mt-4">Alur Pengambilan Keputusan:</h4>
                <div class="rule-box">
                    <strong>Aturan 1:</strong> IF IPK ≥ 3.0 AND SKS ≥ 144 AND Semester ≤ 8 AND Nilai D ≤ 1 AND Nilai E = 0 THEN "Tepat Waktu"
                </div>
                <div class="rule-box">
                    <strong>Aturan 2:</strong> IF IPK < 3.0 THEN "Terlambat"
                </div>
                <div class="rule-box">
                    <strong>Aturan 3:</strong> IF IPK ≥ 3.0 AND SKS < 144 THEN "Terlambat"
                </div>
                <div class="rule-box">
                    <strong>Aturan 4:</strong> IF IPK ≥ 3.0 AND SKS ≥ 144 AND Semester > 8 THEN "Terlambat"
                </div>
                <div class="rule-box">
                    <strong>Aturan 5:</strong> IF IPK ≥ 3.0 AND SKS ≥ 144 AND Semester ≤ 8 AND Nilai D > 1 THEN "Terlambat"
                </div>
                <div class="rule-box">
                    <strong>Aturan 6:</strong> IF IPK ≥ 3.0 AND SKS ≥ 144 AND Semester ≤ 8 AND Nilai D ≤ 1 AND Nilai E > 0 THEN "Terlambat"
                </div>
                
                <h4 class="mt-4">Distribusi Data Training:</h4>
                <canvas id="trainingChart" height="100"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Inisialisasi Mermaid
        mermaid.initialize({
            startOnLoad: true,
            theme: 'default',
            flowchart: {
                useMaxWidth: true,
                htmlLabels: true,
                curve: 'basis'
            }
        });

        // Chart distribusi data training
        const ctx = document.getElementById('trainingChart').getContext('2d');
        const trainingChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Tepat Waktu', 'Terlambat'],
                datasets: [{
                    label: 'Jumlah Mahasiswa',
                    data: [
                        <?php 
                        $sql = "SELECT COUNT(*) as count FROM mahasiswa_training WHERE status_kelulusan = 'Tepat Waktu'";
                        $result = $conn->query($sql);
                        echo $result->fetch_assoc()['count'];
                        ?>, 
                        <?php 
                        $sql = "SELECT COUNT(*) as count FROM mahasiswa_training WHERE status_kelulusan = 'Terlambat'";
                        $result = $conn->query($sql);
                        echo $result->fetch_assoc()['count'];
                        ?>
                    ],
                    backgroundColor: [
                        'rgba(40, 167, 69, 0.7)',
                        'rgba(220, 53, 69, 0.7)'
                    ],
                    borderColor: [
                        'rgba(40, 167, 69, 1)',
                        'rgba(220, 53, 69, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + ' mahasiswa';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>