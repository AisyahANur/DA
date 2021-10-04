<div class="row">
            <div class="col-md-12">
            
                <div class="panel panel-primary" data-collapsed="0">
                    
                    <!-- panel head -->
                  
                    
                    <!-- panel body -->
                    <div class="panel-body">
                       <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered">
        <thead>
            <tr>
              
                <th>Pilih Bulan</th>
                <th>Pilih Tahun</th>
                <th>Aksi</th>
           </tr>
       </thead>
        <tbody>
            <form method="post" action="<?php echo base_url();?>student/tampils" class="form">
                <tr class="gradeA">
                  
                    <td>
                        <select name="bulan" class="form-control">
                            <?php 
                            for($i=1;$i<=12;$i++):
                                if($i==1)$m='Januari';
                                else if($i==2)$m='Februari';
                                else if($i==3)$m='Maret';
                                else if($i==4)$m='April';
                                else if($i==5)$m='Mei';
                                else if($i==6)$m='Juni';
                                else if($i==7)$m='Juli';
                                else if($i==8)$m='Agustus';
                                else if($i==9)$m='September';
                                else if($i==10)$m='Oktober';
                                else if($i==11)$m='November';
                                else if($i==12)$m='Desember';
                            ?>
                                <option value="<?php echo $i;?>"
                                    <?php if(date('m')==$i)echo 'selected="selected"';?>>
                                        <?php echo $m;?>
                                            </option>
                            <?php 
                            endfor;
                            ?>
                        </select>
                    </td>
                    <td>
                        <select name="tahun" class="form-control">
                            <?php for($i=date('Y');$i>=2018;$i--):?>
                                <option value="<?php echo $i;?>"
                                    <?php if(isset($year) && $year==$i)echo 'selected="selected"';?>>
                                        <?php echo $i;?>
                                            </option>
                            <?php endfor;?>
                        </select>
                    </td>
                   
                   
                    <td align="center"><input type="submit" value="Tampilkan" class="btn btn-info"></td>
                </tr>
            </form>
        </tbody>
    </table> 
                       
                        
                    </div>
                    
                </div>
                
            </div>

</div>

<?php if($bulan !='' && $tahun != ''&& $pres!=''):?>

<div class="row">
            <div class="col-md-6">
            
                <div class="panel panel-primary" data-collapsed="0">
                    
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title"><h3>Kegiatan</h3></div>
                        
                        <div class="panel-options">
                         
                        </div>
                    </div>
                    
                    <!-- panel body -->
                    <div class="panel-body">
                        <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kegiatan</th>
                            <th>Lokasi</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                       <?php
                       foreach ($keg as $k) {
                            ?>
                                    <tr>
                                     
                                        <td><?= $k['tgl'];?></td>
                                        <td><?= $k['isi'];?></td>
                                        <td><?= $k['lokasi'];?></td>
                                    </tr>
                          <?php     
                       }
                       ?>
                    </tbody>
                </table>
                       
                    </div>
                    
                </div>
                
            </div>


            <!-- ///////////////// -->
             <div class="col-md-6">
            
                <div class="panel panel-primary" data-collapsed="0">
                    
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title"><h3>Prestasi</h3></div>
                        
                        <div class="panel-options">
                          
                        </div>
                    </div>
                    
                    <!-- panel body -->
                    <div class="panel-body">
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            
                            <th>Tanggal</th>
                            <th>Prestasi</th>
                            <th>Tingkat</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                       foreach ($pres as $p) {
                            ?>
                                    <tr>
                                     
                                        <td><?= $p['tgl'];?></td>
                                        <td><?= $p['isi'];?></td>
                                        <td><?= $p['tingkat'];?></td>
                                    </tr>
                          <?php     
                       }
                       ?>
                    </tbody>
                </table>
                        
                    </div>
                    
                </div>
                
            </div>
</div>
              
<!-- vocab -->
<div class="row">
            <div class="col-md-6">
            
                <div class="panel panel-primary" data-collapsed="0">
                    
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title"><h3>Perizinan</h3></div>
                        
                        <div class="panel-options">
                         
                        </div>
                    </div>
                    
                    <!-- panel body -->
                    <div class="panel-body">
                        <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Alasan/Maksud</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                       <?php
                       foreach ($izin as $per) {
                            ?>
                                    <tr>
                                     
                                        <td><?= $per['tgl'];?></td>
                                        <td><?= $per['maksud'];?></td>
                                       
                                    </tr>
                          <?php     
                       }
                       ?>
                    </tbody>
                </table>
                       
                    </div>
                    
                </div>
                
            </div>


            <!-- ///////////////// -->
             <div class="col-md-6">
            
                <div class="panel panel-primary" data-collapsed="0">
                    
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title"><h3>Sakit</h3></div>
                        
                        <div class="panel-options">
                          
                        </div>
                    </div>
                    
                    <!-- panel body -->
                    <div class="panel-body">
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            
                            <th>Tanggal</th>
                            <th>Indikasi</th>
                            <th>Penanganan</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                       <?php
                       foreach ($sakit as $ss) {
                            ?>
                                    <tr>
                                     
                                        <td><?= $ss['tgl'];?></td>
                                        <td><?= $ss['indikasi'];?></td>
                                        <td><?= $ss['ket'];?></td>
                                    </tr>
                          <?php     
                       }
                       ?>
                    </tbody>
                </table>
                        
                    </div>
                    
                </div>
                
            </div>
</div>
<!-- vocab -->
<div class="row">
            <div class="col-md-6">
            
                <div class="panel panel-primary" data-collapsed="0">
                    
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title"><h3>Pelanggaran</h3></div>
                        
                        <div class="panel-options">
                         
                        </div>
                    </div>
                    
                    <!-- panel body -->
                    <div class="panel-body">
                        <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Jenis Pelanggaran</th>
                            <th>Sanksi</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                       <?php
                       foreach ($pelanggaran as $pel) {
                            ?>
                                    <tr>
                                     
                                        <td><?= $pel['tgl'];?></td>
                                        <td><?= $pel['isi'];?></td>
                                       <td><?= $pel['sanksi'];?></td>
                                    </tr>
                          <?php     
                       }
                       ?>
                    </tbody>
                </table>
                       
                    </div>
                    
                </div>
                
            </div>

           
</div>


            
            
            
            
            
            

<?php endif;?>

