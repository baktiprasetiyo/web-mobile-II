<?php 
    include "config/config.php";

    // Query to fetch gallery data
    $sql = mysqli_query($con, "SELECT * FROM tbl_gallery");
?>

<div class="container mt-4">
    <div class="row text-center">
        <?php while ($data = mysqli_fetch_assoc($sql)): ?>
            <div class="col-md-4 col-sm-6 col-xs-12 mt-3">
                <div class="gallery-item">
                    <!-- Display Title -->
                    
                    <!-- Display Image -->
                    <img src="assets/img/<?= htmlspecialchars($data['nama']) ?>" alt="<?= htmlspecialchars($data['judul']) ?>" class="img-fluid img-thumbnail">
                    <h5 class="gallery-title"><?= htmlspecialchars($data['judul']) ?></h5>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
