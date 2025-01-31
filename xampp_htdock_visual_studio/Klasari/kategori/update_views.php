<?php
include "config/config.php";

// Periksa apakah id_post dikirim melalui URL
if (isset($_GET['id_post'])) {
    $id_post = $_GET['id_post'];

    // Cek apakah id_post valid (menghindari SQL injection dengan validasi)
    $id_post = mysqli_real_escape_string($con, $id_post);

    // Ambil jumlah views saat ini dari database
    $result = mysqli_query($con, "SELECT views FROM tbl_posts WHERE id_post = '$id_post'");

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        // Tambahkan 1 ke jumlah views
        $newViews = $data['views'] + 1;

        // Update views di database
        $updateQuery = "UPDATE tbl_posts SET views = $newViews WHERE id_post = '$id_post'";

        if (mysqli_query($con, $updateQuery)) {
            // Jika update berhasil, kirimkan status 200 (OK)
            echo "Views updated successfully.";
        } else {
            // Jika ada kesalahan saat update
            echo "Error updating views: " . mysqli_error($con);
        }
    } else {
        // Jika id_post tidak ditemukan
        echo "Post not found.";
    }
} else {
    echo "No post ID provided.";
}
?>
