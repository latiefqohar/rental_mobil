<div class="col-xl-12 col-md-6 mb-4">
	<div class="card border-left-success shadow h-100 py-2">
		<div class="card-body">
			<div class="page-header">
      <?php 
        if(isset($_GET['pesan']))
        { 
          if($_GET['pesan'] == "berhasil")
            { 
              echo "<div class='alert alert-success'>Data Berhasil ditambah.</div>"; 
            }else if($_GET['pesan'] == "sukses")
            { 
								echo "<div class='alert alert-success'>Data Berhasil Diubah.</div>";
            }else if($_GET['pesan'] == "hapus")
            { 
                echo "<div class='alert alert-danger'>Data Berhasil dihapus.</div>";
            } else { 
							echo "<div class='alert alert-danger'>Data Gagal Disimpan.</div>";
						}
        } 
                ?>
				<h3> Data Mobil </h3>
			</div>
			<a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#inputMobil">
				<i class="fas fa-plus"></i> Mobil Baru
			</a>
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Data Mobil</h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>No</th>
									<th>Merk Mobil</th>
									<th>Plat</th>
									<th>Warna</th>
									<th>Tahun Pembuatan</th>
									<th>Status</th>
									<th>Action</th>

								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>No</th>
									<th>Merk Mobil</th>
									<th>Plat</th>
									<th>Warna</th>
									<th>Tahun Pembuatan</th>
									<th>Status</th>
									<th>Action</th>

								</tr>
							</tfoot>
							<tbody>
								<?php
                    $no=1;
                    foreach($mobil as $m){
                    ?>
								<tr>
									<td><?php echo $no ?></td>
									<td><?php echo $m->mobil_merk ?></td>
									<td><?php echo $m->mobil_plat ?></td>
									<td><?php echo $m->mobil_warna ?></td>
									<td><?php echo $m->mobil_tahun ?></td>
									<td>
										<?php
                     if($m->mobil_status=="1"){
                         echo "Tersedia";
                     }elseif ($m->mobil_status=="2") {
                         echo "Sedang di Rental";
                     }
                    ?>
									</td>
									<td>
										<a class="btn btn-primary btn-circle"
											href="<?php echo base_url().'admin/mobil_edit/'.$m->mobil_id; ?>">
											<i class="far fa-edit"></i>
										</a>
										<a class="btn btn-danger btn-circle"
											href="<?php echo base_url().'admin/mobil_hapus/'.$m->mobil_id ?>">
											<i class="fas fa-trash"></i>
										</a>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>


		</div>
	</div>
</div>

<!-- modal input mobil -->
<div class="modal fade" id="inputMobil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Input Data Mobil</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">

				<div class="page-header">
					<h3>Mobil Baru</h3>
				</div>
				<form action="<?php echo base_url().'admin/mobil_add' ?>" method="post">
					<div class="form-group">
						<label>Merk Mobil</label>
						<input type="text" name="merk" class="form-control" required>
						<?php echo form_error('merk'); ?>
					</div>
					<div class="form-group">
						<label>No. Plat Kendaraan</label>
						<input type="text" name="plat" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Warna</label>
						<input type="text" name="warna" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Tahun Kendaraan</label>
						<input type="text" name="tahun" class="form-control" required>
          </div>
          <div class="form-group"> 
            <label>Status Mobil</label> 
            <select name="status" class="form-control"> 
              <option value="1">Tersedia</option> 
              <option value="2">Sedang Di Rental</option> 
            </select> <?php echo form_error('status'); ?> 
          </div>
				
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<input type="submit" value="Simpan" class="btn btn-primary">
      </div>
      </form>
		</div>
	</div>
</div>


