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
            <form method="post" action="<?php echo base_url();?>student/tampil" class="form">
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
                        <div class="panel-title">Mata Pelajaran Umum</div>
                        
                        <div class="panel-options">
                         
                        </div>
                    </div>
                    
                    <!-- panel body -->
                    <div class="panel-body">
                        <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Mata Pelajaran</th>
                            <th>UH 1</th>
                             <th>UH 2</th>
                              <th>UH 3</th>
                               <th>UH 4</th>
                                <th>Rata-rata</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                       <?php
                       foreach ($nilai as $row) {
                           # code...
                            $s = $this->db->get_where('subject',array(
                                'subject_id' => $row['subject_id'],
                                'kategori' => '0'
                            ))->result_array();
                            foreach ($s as $r ) {
                                # code...
                                if($row['subject_id'] == $r['subject_id']){
                                    ?>
                                    <tr>
                                     
                                        <td><?= $r['name'];?></td>
                                        <td><?= $row['nilai1'];?></td>
                                        <td><?= $row['nilai2'];?></td>
                                        <td><?= $row['nilai3'];?></td>
                                        <td><?= $row['nilai4'];?></td>
                                        <td>
                                            <?php
                                                $sum=$row['nilai1']+$row['nilai2']+$row['nilai3']+$row['nilai4'];

                                                if ($row['nilai1'] > 0 && $row['nilai2']>0 && $row['nilai3']>0 && $row['nilai4']>0){
                                                    $c = 4;
                                                }else if($row['nilai1'] > 0 && $row['nilai2']>0 && $row['nilai3']>0 && $row['nilai4']<=0){
                                                     $c = 3;
                                                }else if($row['nilai1'] > 0 && $row['nilai2']>0 && $row['nilai3']<=0 && $row['nilai4']<=0){
                                                     $c = 2;
                                                }else if($row['nilai1'] > 0 && $row['nilai2']<=0 && $row['nilai3']<=0 && $row['nilai4']<=0){
                                                     $c = 1;
                                                }else{
                                                    $c = 0;
                                                }

                                                $sum = $sum / $c;
                                                echo $sum<=$r['kkm']?'<font color="red">'.$sum.'</font>':$sum;
                                            ?>
                                        </td>
                                       
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
                        <div class="panel-title">Mata Pelajaran Keagamaan</div>
                        
                        <div class="panel-options">
                          
                        </div>
                    </div>
                    
                    <!-- panel body -->
                    <div class="panel-body">
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            
                            <th>Mata Pelajaran</th>
                            <th>UH 1</th>
                            <th>UH 2</th>
                            <th>UH 3</th>
                            <th>UH 4</th>
                            <th>Rata-rata</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                         <?php
                       foreach ($nilai as $row) {
                           # code...
                            $s = $this->db->get_where('subject',array(
                                'subject_id' => $row['subject_id'],
                                'kategori' => '1'
                            ))->result_array();
                            foreach ($s as $r ) {
                                # code...
                                if($row['subject_id'] == $r['subject_id']){
                                    ?>
                                  
                                     
                                         <tr>
                                     
                                        <td><?= $r['name'];?></td>
                                        <td><?= $row['nilai1'];?></td>
                                        <td><?= $row['nilai2'];?></td>
                                        <td><?= $row['nilai3'];?></td>
                                        <td><?= $row['nilai4'];?></td>
                                        <td>
                                            <?php
                                                $sum=$row['nilai1']+$row['nilai2']+$row['nilai3']+$row['nilai4'];

                                                if ($row['nilai1'] > 0 && $row['nilai2']>0 && $row['nilai3']>0 && $row['nilai4']>0){
                                                    $c = 4;
                                                }else if($row['nilai1'] > 0 && $row['nilai2']>0 && $row['nilai3']>0 && $row['nilai4']<=0){
                                                     $c = 3;
                                                }else if($row['nilai1'] > 0 && $row['nilai2']>0 && $row['nilai3']<=0 && $row['nilai4']<=0){
                                                     $c = 2;
                                                }else if($row['nilai1'] > 0 && $row['nilai2']<=0 && $row['nilai3']<=0 && $row['nilai4']<=0){
                                                     $c = 1;
                                                }else{
                                                    $c = 0;
                                                }

                                                $sum = $sum / $c;
                                                echo $sum<=$r['kkm']?'<font color="red">'.$sum.'</font>':$sum;
                                            ?>
                                        </td>
                                       
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
              


<?php endif;?>

