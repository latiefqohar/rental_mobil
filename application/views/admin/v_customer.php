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
				<h3> Data Customer </h3>
			</div>
			<a href="<?php echo base_url(); ?>admin/add_customer" class="btn btn-primary btn-sm">
				<i class="fas fa-plus"></i> Customer Baru
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
									<th>Nama Customer</th>
									<th>Alamat</th>
									<th>jenis kelamin</th>
									<th>Nomor Hp</th>
									<th>NIK</th>
									<th>Action</th>

								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>No</th>
									<th>Nama Customer</th>
									<th>Alamat</th>
									<th>jenis kelamin</th>
									<th>Nomor Hp</th>
									<th>NIK</th>
									<th>Action</th>

								</tr>
							</tfoot>
							<tbody>
								<?php
                    $no=1;
                    foreach($customer as $c){
                    ?>
								<tr>
									<td><?php echo $no++; ?></td>
									<td><?php echo $c->kostumer_nama ?></td>
									<td><?php echo $c->kostumer_alamat ?></td>
									<td><?php echo $c->kostumer_jk ?></td>
									<td><?php echo $c->kostumer_hp ?></td>
									<td><?php echo $c->kostumer_ktp ?></td>
									<td>
									<a class="btn btn-primary btn-circle"
											href="<?php echo base_url().'admin/customer_edit/'.$c->kostumer_id; ?>">
											<i class="far fa-edit"></i>
										</a>
										<a class="btn btn-danger btn-circle"
											href="<?php echo base_url().'admin/customer_hapus/'.$c->kostumer_id ?>">
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



