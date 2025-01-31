<?php
$sql = mysqli_query($con, "SELECT * FROM tbl_kebijakan");
$data = mysqli_fetch_array($sql);
?>
<div class="row">
    <!-- Card untuk Menampilkan PDF -->
    

    <!-- Form untuk Upload PDF -->
    <div class="col-lg-4 col-xs-12">
        <div class="card card-primary">
            <div class="card-header">
                <h5>Form <?= htmlspecialchars($_GET['page']) ?></h5>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-12 mt-3">
                            <label for="file">Masukkan File PDF</label>
                            <input type="file" name="file" class="form-control" value="<?= htmlspecialchars($data['pdf']) ?>" accept="application/pdf">
                            <p class="text-danger mt-2" style="font-size: 12px;">File harus format : PDF. Ukuran max 5MB.</p>
                        </div>

                        <div class="col-lg-12 mt-1">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Edit Data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
	<div class="col-lg-8 col-xs-12">
        <div class="card card-primary">
            <div class="card-header">
                <h5>Data Kebijakan</h5>
            </div>
            <div class="card-body">
                <embed type="application/pdf" src="../assets/file/pdf/kebijakan/<?= $data['pdf'] ?>" style="width: 100%; height: 30vh;"></embed>
            </div>
        </div>
    </div>
</div>