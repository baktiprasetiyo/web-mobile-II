<?php 

	include "../config/config.php";

	$sql = mysqli_query($con, "SELECT * FROM tbl_users");

 ?>
<div class="row">
	<div class="col-lg-12 col-xs-12">
		<div class="card card-primary">
			<div class="card-header">
				<h5>Data Akun</h5>
			</div>
			<div class="card-body">
				<table class="table table-bordered">
					<tr>
						<th width="30">#</th>
						<th class="text-center">Nama</th>
						<th class="text-center">Username</th>
						<th class="text-center">Gambar</th>
						<th class="text-center">Aksi</th>
					</tr>
				<?php 
					$no = 1;
					foreach($sql as $data):
				 ?>
					<tr>
						<th><?= $no++; ?></th>
						<th class="text-center"><?= $data['nama_pengguna'] ?></th>
						<th class="text-center"><?= $data['username'] ?></th>
						<th class="text-center"><img src="../assets/img/<?= $data['img'] ?>" width="50" height="50"></th>
						<th class="text-center">
							<a href="index.php?page=hapus-akun&id=<?= $data['id_user'] ?>" class="btn btn-danger">
								<i class="fas fa-trash"></i>
							</a>
						</th>
					</tr>
				<?php endforeach; ?>
				</table>
			</div>
		</div>
	</div>
	
</div>


