<div class="col-xl-12 col-md-6 mb-4">
	<div class="card border-left-success shadow h-100 py-2">
		<div class="card-body">
        <?php
         foreach($customer as $data){?>
         
         <form action="<?php echo base_url().'admin/customer_update' ?>" method="POST" >
             <legend>Edit Data Customer</legend>
         
             <div class="form-group">
                 <label for="">Nama</label>
                 <input type="hidden" name="id" value="<?php echo $data->kostumer_id; ?>">
                 <input type="text" class="form-control" name="nama" value="<?php echo $data->kostumer_nama; ?>">
                 <?php echo form_error('nama'); ?>
             </div>
             <div class="form-group"> 
                <label>alamat</label> 
                <input class="form-control" type="text" name="alamat" value="<?php echo $data->kostumer_alamat; ?>"> 
             </div>
             <div class="form-group">
                <label>jenis Kelamin</label> 
                <select name="jk" class="form-control"> 
                    <option 
                        <?php if($data->kostumer_jk == "L")
                        {
                            echo "selected='selected'";
                        } echo $data->kostumer_jk; ?> value="L">Pria</option> 
                    <option <?php if($data->kostumer_jk == "P")
                        {
                            echo "selected='selected'";
                        } echo $data->kostumer_jk; ?> value="P">Wanita</option> 
                </select> 
            </div>
            <div class="form-group"> 
                <label>Nomor HP</label> 
                <input class="form-control" type="number" name="hp" value="<?php echo $data->kostumer_hp; ?>"> 
            </div>
            <div class="form-group"> 
                <label>No KTP</label> 
                <input class="form-control" type="number" name="nik" value="<?php echo $data->kostumer_ktp; ?>">
            </div>
         
             
            <div class="form-group">
             <input type="submit" class="btn btn-primary">
             </div>
         </form>
         <?php
         } 
         ?>
        </div>
    </div>
</div>