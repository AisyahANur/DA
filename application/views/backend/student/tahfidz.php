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
            <form method="post" action="<?php echo base_url();?>student/tampilh" class="form">
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

<?php if($bulan !='' && $tahun != ''&& $nilai != ''):?>

<div class="row">
            <div class="col-md-6">
            
                <div class="panel panel-primary" data-collapsed="0">
                    
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">Hafalan Al-Qur'an</div>
                        
                        <div class="panel-options">
                         
                        </div>
                    </div>
                    
                    <!-- panel body -->
                    <div class="panel-body">
                        <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Surah</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                       <?php
                       foreach ($nilai as $row) {
                           # code...
                            $s = $this->db->get_where('hafalan',array(
                                'hafalan_id' => $row['hafalan_id'],
                                'kategori' => '1'
                            ))->result_array();
                            foreach ($s as $r ) {
                                # code...
                                if($row['hafalan_id'] == $r['hafalan_id']){
                                    ?>
                                    <tr>
                                     
                                        <td><?= $r['tema'];?></td>
                                        <td><?= $row['nilai']<=59?'<font color="red">'.$row['nilai'].'</font>':$row['nilai'];?></td>
                                    </tr>
                                    <?php
                                }
                            }
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
                        <div class="panel-title">Hafalan Hadits</div>
                        
                        <div class="panel-options">
                          
                        </div>
                    </div>
                    
                    <!-- panel body -->
                    <div class="panel-body">
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            
                            <th>Tema</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                       foreach ($nilai as $row) {
                           # code...
                            $s = $this->db->get_where('hafalan',array(
                                'hafalan_id' => $row['hafalan_id'],
                                'kategori' => '0'
                            ))->result_array();
                            foreach ($s as $r ) {
                                # code...
                                if($row['hafalan_id'] == $r['hafalan_id']){
                                    ?>
                                    <tr>
                                     
                                        <td><?= $r['tema'];?></td>
                                        <td><?= $row['nilai']<=59?'<font color="red">'.$row['nilai'].'</font>':$row['nilai'];?></td>
                                    </tr>
                                    <?php
                                }
                            }
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
                        <div class="panel-title">Hafalan Kosakata Bahasa Inggris</div>
                        
                        <div class="panel-options">
                         
                        </div>
                    </div>
                    
                    <!-- panel body -->
                    <div class="panel-body">
                        <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tema</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                       <?php
                       foreach ($nilai2 as $row2) {
                           # code...
                            $s2 = $this->db->get_where('vocab',array(
                                'vocab_id' => $row2['vocab_id'],
                                'kategori' => '1'
                            ))->result_array();
                            foreach ($s2 as $r2 ) {
                                # code...
                                if($row2['vocab_id'] == $r2['vocab_id']){
                                    ?>
                                    <tr>
                                     
                                        <td><?= $r2['tema'];?></td>
                                        <td><?= $row2['nilai']<=59?'<font color="red">'.$row2['nilai'].'</font>':$row2['nilai'];?></td>
                                    </tr>
                                    <?php
                                }
                            }
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
                        <div class="panel-title">Hafalan Kosakata Bahasa Arab</div>
                        
                        <div class="panel-options">
                          
                        </div>
                    </div>
                    
                    <!-- panel body -->
                    <div class="panel-body">
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            
                            <th>Tema</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                       foreach ($nilai2 as $row2) {
                           # code...
                            $s2 = $this->db->get_where('vocab',array(
                                'vocab_id' => $row2['vocab_id'],
                                'kategori' => '0'
                            ))->result_array();
                            foreach ($s2 as $r2 ) {
                                # code...
                                if($row2['vocab_id'] == $r2['vocab_id']){
                                    ?>
                                    <tr>
                                     
                                        <td><?= $r2['tema'];?></td>
                                        <td><?= $row2['nilai']<=59?'<font color="red">'.$row2['nilai'].'</font>':$row2['nilai'];?></td>
                                    </tr>
                                    <?php
                                }
                            }
                       }
                       ?>
                    </tbody>
                </table>
                        
                    </div>
                    
                </div>
                
            </div>
</div>


<!-- BTQ -->

<div class="row">
            <div class="col-md-12">
            
                <div class="panel panel-primary" data-collapsed="0">
                    
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">Nilai Baca Tulis Al-Qur'an</div>
                        
                        <div class="panel-options">
                         
                        </div>
                    </div>
                    
                    <!-- panel body -->
                    <div class="panel-body">
                        <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Mampu melafalkan huruf hijaiyah dengan benar
</th>
                            <th>Mampu membaca Al-Qur'an dengan baik dan benar
</th>
<th>Mampu memahami ilmu tajwid</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                       <?php
                       foreach ($nilai3 as $row3) {
                          
                                ?>   <tr>
                                     
                                        <td><?= $row3['huruf'];?></td>
                                         <td><?= $row3['baca'];?></td>
                                          <td><?= $row3['tajwid'];?></td>
                                        
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
           
</div>


<?php endif;?>

