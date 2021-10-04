<div class="row">
            <div class="col-md-12">
            
                <div class="panel panel-primary" data-collapsed="0">
                    
                    <!-- panel head -->
                  
                    
                    <!-- panel body -->
                    <div class="panel-body">
                       <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered">
        <thead>
            <tr>
              
                <th>Pilih Ujian</th>
                <th>Pilih Tahun</th>
                <th>Aksi</th>
           </tr>
       </thead>
        <tbody>
            <form method="post" action="<?php echo base_url();?>student/tampilun" class="form">
                <tr class="gradeA">
                  
                    <td>
                       <select name="idu" class="form-control" data-validate="required"  >
                              <option value="">Pilih</option>
                              <?php 
                                        $classes = $this->db->get('ujian')->result_array();
                                        foreach($classes as $row):
                                            ?>
                                            <option value="<?php echo $row['id'];?>">
                                                    <?php echo $row['name'];?>
                                                    </option>
                                        <?php
                                        endforeach;
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

<?php if($idu !='' && $tahun != ''&& $nilai != ''):?>

<div class="row">
            <div class="col-md-12">
            
                <div class="panel panel-primary" data-collapsed="0">
                    
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">Nilai</div>
                        
                        <div class="panel-options">
                         
                        </div>
                    </div>
                    
                    <!-- panel body -->
                    <div class="panel-body">
                        <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Mata Pelajaran</th>
                            <th>Nilai</th>
                           
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
                                        <td><?= $row['nilai']<=$r['kkm']?'<font color="red">'.$row['nilai'].'</font>':$row['nilai'];?></td>
                                       
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

