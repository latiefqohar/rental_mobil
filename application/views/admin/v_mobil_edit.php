<div class="col-xl-12 col-md-6 mb-4">
	<div class="card border-left-success shadow h-100 py-2">
		<div class="card-body">
        <?php
         foreach($mobil as $data){?>
         
         <form action="<?php echo base_url().'admin/mobil_update' ?>" method="POST" >
             <legend>Edit Mobil</legend>
         
             <div class="form-group">
                 <label for="">Merk Mobil</label>
                 <input type="hidden" name="id" value="<?php echo $data->mobil_id; ?>">
                 <input type="text" class="form-control" name="merk" value="<?php echo $data->mobil_merk; ?>">
                 <?php echo form_error('merk'); ?>
             </div>
             <div class="form-group"> 
                <label>No. Plat Kendaraan</label> 
                <input class="form-control" type="text" name="plat" value="<?php echo $data->mobil_plat; ?>"> 
             </div>
             <div class="form-group"> 
                <label>Warna</label> 
                <input class="form-control" type="text" name="warna" value="<?php echo $data->mobil_warna; ?>"> 
            </div>
            <div class="form-group"> 
                <label>Tahun Kendaraan</label> 
                <input class="form-control" type="text" name="tahun" value="<?php echo $data->mobil_tahun; ?>"> 
            </div>
            <div class="form-group"> 
                <label>Status Mobil</label> 
                <select name="status" class="form-control"> 
                    <option 
                        <?php if($data->mobil_status == "1")
                        {
                            echo "selected='selected'";
                        } echo $data->mobil_tahun; ?> value="1">Tersedia</option> 
                    <option <?php if($data->mobil_status == "2")
                        {
                            echo "selected='selected'";
                        } echo $data->mobil_tahun; ?> value="2">Sedang Di Rental</option> 
                </select> 
                <?php echo form_error('status'); ?> 
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