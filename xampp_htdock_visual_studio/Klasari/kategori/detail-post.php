<?php 
    include "config/config.php";

    // Pastikan parameter 'id' valid dan aman
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id_tabel_post = $_GET['id'];
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $current_date = date("Y-m-d"); // Mendapatkan tanggal saat ini (tanpa waktu)

        // Cek apakah entri dengan ip_address, id_tabel_post, dan visit_date sudah ada
        $query = $con->prepare("SELECT * FROM tbl_views WHERE ip_address = ? AND id_tabel_post = ? AND visit_time = ?");
        $query->bind_param('sis', $ip_address, $id_tabel_post, $current_date);
        $query->execute();
        $result = $query->get_result();

        // Jika entri sudah ada, tampilkan pesan
        if ($result->num_rows > 0) {
        } else {
            // Jika belum ada, insert entri baru (hanya tanggal)
            $insertQuery = $con->prepare("INSERT INTO tbl_views (ip_address, visit_time, id_tabel_post, views) VALUES (?, ?, ?, 1)");
            $insertQuery->bind_param('ssi', $ip_address, $current_date, $id_tabel_post); // Pastikan menggunakan DATE format
            if ($insertQuery->execute()) {
                // Update jumlah views pada tabel utama untuk post yang relevan
                $updateQuery = $con->prepare("UPDATE tbl_posts SET views = views + 1 WHERE id_post = ?");
                $updateQuery->bind_param('i', $id_tabel_post);
                $updateQuery->execute();
                
            } else {
                echo "<p>Terjadi kesalahan saat menyimpan data kunjungan.</p>";
            }
        }

        // Ambil data postingan berdasarkan id_tabel_post
        $postQuery = $con->prepare("SELECT * FROM tbl_posts WHERE id_post = ?");
        $postQuery->bind_param('i', $id_tabel_post);
        $postQuery->execute();
        $postResult = $postQuery->get_result();

        // Cek apakah data postingan ditemukan
        if ($postResult->num_rows > 0) {
            $data = $postResult->fetch_assoc(); // Menyimpan hasil query ke dalam variabel $data
        } else {
            echo "<p>Post tidak ditemukan.</p>";
        }
    } else {
        echo "<p>ID pos tidak valid!</p>";
    }
?>

<div class="col-lg-10 col-xs-12">
    <h3><?= htmlspecialchars($data['judul']) ?></h3>
    <p class="mt-3 text-muted" style="font-size: 12px;">
        <i class="ion-calendar"></i>&nbsp;<?= htmlspecialchars($data['date']) ?>&nbsp;&nbsp;
        <a href="#" class="text-muted" style="text-transform: uppercase; text-decoration: none;">
            <?= htmlspecialchars($data['kategori']) ?>
        </a>
    </p>    
    <img src="assets/file/post/<?= htmlspecialchars($data['img']) ?>" class="img-fluid" alt="Image for <?= htmlspecialchars($data['judul']) ?>">        
    <p class="mt-4 text-justify"><?= nl2br(htmlspecialchars($data['artikel'])) ?></p>
</div>
<div class="col-lg-2"></div>
