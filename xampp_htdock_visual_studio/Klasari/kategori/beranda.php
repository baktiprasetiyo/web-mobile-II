<?php
include "config/config.php";

// Query to fetch the articles, ordered by date
$ip_address = $_SERVER['REMOTE_ADDR'];

// Menangkap User Agent (informasi browser dan perangkat)
$user_agent = $_SERVER['HTTP_USER_AGENT'];

// Menangkap halaman yang sedang dikunjungi
$page_visited = $_SERVER['REQUEST_URI']; // Menyimpan URL halaman yang sedang diakses

// Menyimpan data pengunjung ke database
$query = "INSERT INTO tbl_pengunjung (ip_address, user_agent, page_visited) 
          VALUES ('$ip_address', '$user_agent', '$page_visited')";

// Menjalankan query untuk menyimpan data
mysqli_query($con, $query);
$query = mysqli_query($con, "SELECT * FROM tbl_posts ORDER BY date DESC");
?>

<div class="container mt-4">
    <div class="row">
        <?php while ($data = mysqli_fetch_assoc($query)): ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card h-100 d-flex flex-column">
                    <!-- Image with fixed dimensions -->
                    <img src="assets/file/post/<?= htmlspecialchars($data['img']) ?>" alt="<?= htmlspecialchars($data['judul']) ?>" class="card-img-top img-fluid custom-card-img">

                    <div class="card-body d-flex flex-column">
                        <!-- Title -->
                        <h5 class="card-title text-primary" style="height: auto; overflow: hidden;"><?= htmlspecialchars($data['judul']) ?></h5>

                        <!-- Meta Info -->
                        <div class="meta-info mb-3 text-muted" style="font-size: 14px;">
                            <i class="ion-calendar"></i>&nbsp; <?= htmlspecialchars($data['date']) ?> &nbsp;/&nbsp; 
                            <i class="ion-person"></i>&nbsp; <?= htmlspecialchars($data['author']) ?> &nbsp;/&nbsp;
                            <i class="ion-eye"></i>&nbsp; <?= $data['views'] ?> Views
                        </div>

                        <!-- Article Preview -->
                        <p class="article-text text-justify" style="height: 80px; overflow: hidden;">
                            <?= htmlspecialchars(substr($data['artikel'], 0, 100)) ?>...
                        </p>
                        
                        <!-- Spacer to push button to the bottom -->
                        <div class="mt-auto">
                            <!-- Read More Button -->
                            <a href="index.php?page=detail&id=<?= $data['id_post'] ?>" class="btn btn-primary btn-block">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
