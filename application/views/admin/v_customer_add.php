<div class="col-xl-12 col-md-6 mb-4">
	<div class="card border-left-success shadow h-100 py-2">
		<div class="card-body">
            <div class="page-header">
                <h3>Customer Baru</h3>
            </div>
            <form action="<?php echo base_url().'admin/add_customer' ?>" method="post">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" >
                    <?php echo form_error('nama'); ?>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" class="form-control" >
                    <?php echo form_error('alamat'); ?>
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label> 
                    <select name="jk" class="form-control"> 
                    <option value="L">Pria</option> 
                    <option value="P">Wanita</option> 
                    </select>
                </div>
                <div class="form-group">
                    <label>Nomor Handphone</label>
                    <input type="number" name="no_hp" class="form-control" >
                    <?php echo form_error('no_hp'); ?>
                </div>
                <div class="form-group"> 
                    <label>Nomor induk kependudukan</label>
                    <input type="text" name="nik" class="form-control" >
                    <?php echo form_error('nik'); ?>
                </div>
                <div class="form-group"> 
                    <input type="submit" name="add" class="btn btn-primary" >

                </div>
            </form>
        </div>
    </div>
</div>    