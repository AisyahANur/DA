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
                <th>Aksi</th>
           </tr>
       </thead>
        <tbody>
            <form method="post" action="<?php echo base_url();?>student/tampila" class="form">
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
                   
                   
                   
                    <td align="center"><input type="submit" value="Tampilkan" class="btn btn-info"></td>
                </tr>
            </form>
        </tbody>
    </table> 
                       
                        
                    </div>
                    
                </div>
                
            </div>

</div>

<?php if($bulan !='' && $nilai != ''):?>
    <?php
$bln = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','November','Desember'];
?>

<div class="row">
            <div class="col-md-12">
            
                <div class="panel panel-primary" data-collapsed="0">
                    
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">Kehadiran Bulan : <?= $bln[intval($bulan)];?></div>
                        
                        <div class="panel-options">
                         
                        </div>
                    </div>
                    
                    <!-- panel body -->
                    <div class="panel-body">
                        <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Hadir</th>
                            <th>Tugas Pondok</th>
                            <th>Sakit</th>
                            <th>Izin</th>
                            <th>Alfa</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                       <?php
                       foreach ($nilai as $row) {
                           # code...
                          
                           ?>
                                    <tr>
                                     
                                        <td><?= $row['hadir'];?></td>
                                         <td><?= $row['t_pondok'];?></td>
                                          <td><?= $row['sakit'];?></td>
                                           <td><?= $row['izin'];?></td>
                                            <td><?= $row['alfa'];?></td>
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

