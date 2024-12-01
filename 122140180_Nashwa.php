<?php
// Konfigurasi database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'mahasiswa_db';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Pagination
$limit = 10; // Jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1);
$offset = ($page - 1) * $limit;

// Ambil data dari database
$sql = "SELECT * FROM mahasiswa LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

// Hitung total data
$total_sql = "SELECT COUNT(*) as total FROM mahasiswa";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_data = $total_row['total'];
$total_pages = ceil($total_data / $limit);

// Styling sederhana
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">';
?>

<div class="container mt-5">
    <h2 class="text-center">Data Mahasiswa</h2>
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Angkatan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nama']}</td>
                        <td>{$row['jurusan']}</td>
                        <td>{$row['angkatan']}</td>
                    </tr>";
                }
            }

            // Jika data kurang dari 10, tambahkan baris kosong
            if ($result->num_rows < $limit) {
                for ($i = 0; $i < $limit - $result->num_rows; $i++) {
                    echo "<tr><td colspan='4'>&nbsp;</td></tr>";
                }
            }
            ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php if ($page > 1): ?>
                <li class="page-item"><a class="page-link" href="?page=<?= $page - 1 ?>">Previous</a></li>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
            <?php endfor; ?>
            <?php if ($page < $total_pages): ?>
                <li class="page-item"><a class="page-link" href="?page=<?= $page + 1 ?>">Next</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<?php $conn->close(); ?>