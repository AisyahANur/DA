<hr />

    <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered">
        <thead>
            <tr>
              
                <th>Pilih Bulan</th>
                <th>Pilih Tahun</th>
                <th>Pilih Jenjang</th>
                <th>Pilih Kelas</th>
                <th>Aksi</th>
           </tr>
       </thead>
        <tbody>
            <form method="post" action="<?php echo base_url();?>admin/kesantrian_selector" class="form">
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
                                    <?php if($month==$i)echo 'selected="selected"';?>>
                                        <?php echo $m;?>
                                            </option>
                            <?php 
                            endfor;
                            ?>
                        </select>
                    </td>
                    <td>
                        <select name="year" class="form-control">
                            <?php for($i=date('Y');$i>=2018;$i--):?>
                                <option value="<?php echo $i;?>"
                                    <?php if(isset($year) && $year==$i)echo 'selected="selected"';?>>
                                        <?php echo $i;?>
                                            </option>
                            <?php endfor;?>
                        </select>
                    </td>
                    <td>
                        <select name="class_id" class="form-control" data-validate="required" id="class_id" data-message-required="<?php echo get_phrase('value_required');?>" onchange="return get_class_sections(this.value)">
                              <option value="">Pilih</option>
                              <?php 
                                        $classes = $this->db->get('class')->result_array();
                                        foreach($classes as $row):
                                            ?>
                                            <option value="<?php echo $row['class_id'];?>">
                                                    <?php echo $row['name'];?>
                                                    </option>
                                        <?php
                                        endforeach;
                                  ?>
                        </select>

                    </td>
                    <td>
                        <select name="section_id" class="form-control" id="section_selector_holder" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                              <option value="">Pilih</option>
                              
                          </select>
                    </td>
                    <td align="center"><input type="submit" value="Absensi" class="btn btn-info"></td>
                </tr>
            </form>
        </tbody>
    </table>
<hr />



<?php if( $month!='' && $year!='' && $class_id!='' && $section_id!=''):?>

<center>
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
        
            <div class="tile-stats tile-green">
                <div class="icon"><i class="entypo-calendar"></i></div>
                <?php
                    $bulan  =   $month;
                    $day        = date('M', $bulan);
                 ?>
               
                
                <h3>Laporan Kesantrian <?php echo $this->crud_model->get_section_name($section_id);?></h3>
                <p><?php echo $month."-".$year;?></p>
            </div>
            
             
        </div>

    </div>
</center>
<hr />




<div class="row">
    <div class="col-md-6 ">
            <div class="panel panel-primary" data-collapsed="0">
                    
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">Kegiatan </div>
                     </div>
           
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama</td>
                    <td>Tanggal</td>
                    <td>Kegiatan</td>
                    <td>Lokasi</td>
                </tr>
            </thead>
            <tbody>

                <?php 
                    $students   =   $this->db->get_where('student' , array('section_id'=>$section_id))->result_array();
                       $no = 0;
                        foreach($students as $row):?>
                        <tr class="gradeA">
                            <td><?php echo $no+=1;?></td>
                            <td><?php echo $row['name'];?></td>
                            <?php 
                                 $verify_data    =   array(  'nis' => $row['nis'],
                                                            'bulan' => $month,
                                                           );
                               
                                  $attendance = $this->db->get_where('kegiatan' , $verify_data)->result_array();
                                foreach ($attendance as $a) {
                                    # code...
                                    ?>
                                    <td><?= $a['tgl'];?></td>
                                     <td><?= $a['isi'];?></td>
                                      <td><?= $a['lokasi'];?></td>
                                    <?php
                              


                            }
                               
                               
                            ?>
                           
                        </tr>
                    <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>

 <div class=" col-md-6">
            
            <div class="panel panel-primary" data-collapsed="0">
                    
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">Prestasi </div>   
                        
                    </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama</td>
                    <td>Tanggal</td>
                    <td>Prestasi</td>
                    <td>Tingkat</td>
                </tr>
            </thead>
            <tbody>

                <?php 
                    $students   =   $this->db->get_where('student' , array('section_id'=>$section_id))->result_array();
                       $no = 0;
                        foreach($students as $row):?>
                        <tr class="gradeA">
                            <td><?php echo $no+=1;?></td>
                            <td><?php echo $row['name'];?></td>
                            <?php 
                                //inserting blank data for students attendance if unavailable
                          
                                 $verify_data    =   array(  'nis' => $row['nis'],
                                                            'bulan' => $month,
                                                            );
                                

                                  $attendance = $this->db->get_where('prestasi' , $verify_data)->result_array();
                                foreach ($attendance as $a) {
                                    # code...
                                    ?>
                                    <td><?= $a['tgl'];?></td>
                                     <td><?= $a['isi'];?></td>
                                      <td><?= $a['tingkat'];?></td>
                                    <?php
                             

                            }
                            ?>
                           
                        </tr>
                    <?php endforeach;?>
            </tbody>
        </table>
    </div>    
</div>


</div>


<!-- //////////////////////////////// -->
<div class="row">
    <div class="col-md-6 ">
            <div class="panel panel-primary" data-collapsed="0">
                    
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">Kegiatan </div>
                     </div>
           
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama</td>
                    <td>Tanggal</td>
                    <td>Alasan/Maksud</td>
                  
                </tr>
            </thead>
            <tbody>

                <?php 
                    $students   =   $this->db->get_where('student' , array('section_id'=>$section_id))->result_array();
                       $no = 0;
                        foreach($students as $row):?>
                        <tr class="gradeA">
                            <td><?php echo $no+=1;?></td>
                            <td><?php echo $row['name'];?></td>
                            <?php 
                                 $verify_data    =   array(  'nis' => $row['nis'],
                                                            'bulan' => $month,
                                                           );
                               
                                  $attendance = $this->db->get_where('izin' , $verify_data)->result_array();
                                foreach ($attendance as $a) {
                                    # code...
                                    ?>
                                    <td><?= $a['tgl'];?></td>
                                     <td><?= $a['maksud'];?></td>
                                     <?php
                              


                            }
                               
                               
                            ?>
                           
                        </tr>
                    <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>

 <div class=" col-md-6">
            
            <div class="panel panel-primary" data-collapsed="0">
                    
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">Sakit </div>   
                        
                    </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama</td>
                    <td>Tanggal</td>
                    <td>Indikasi</td>
                    <td>Keterangan</td>
                </tr>
            </thead>
            <tbody>

                <?php 
                    $students   =   $this->db->get_where('student' , array('section_id'=>$section_id))->result_array();
                       $no = 0;
                        foreach($students as $row):?>
                        <tr class="gradeA">
                            <td><?php echo $no+=1;?></td>
                            <td><?php echo $row['name'];?></td>
                            <?php 
                                //inserting blank data for students attendance if unavailable
                          
                                 $verify_data    =   array(  'nis' => $row['nis'],
                                                            'bulan' => $month,
                                                            );
                                

                                  $attendance = $this->db->get_where('sakit' , $verify_data)->result_array();
                                foreach ($attendance as $a) {
                                    # code...
                                    ?>
                                    <td><?= $a['tgl'];?></td>
                                     <td><?= $a['indikasi'];?></td>
                                      <td><?= $a['ket'];?></td>
                                    <?php
                             

                            }
                            ?>
                           
                        </tr>
                    <?php endforeach;?>
            </tbody>
        </table>
    </div>    
</div>


</div>

<!-- //////////////////////////////// -->
<div class="row">
    <div class="col-md-12 ">
            <div class="panel panel-primary" data-collapsed="0">
                    
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">Pelanggaran </div>
                     </div>
           
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama</td>
                    <td>Jenis Pelanggaran</td>
                    <td>Sanksi</td>
                  
                </tr>
            </thead>
            <tbody>

                <?php 
                    $students   =   $this->db->get_where('student' , array('section_id'=>$section_id))->result_array();
                       $no = 0;
                        foreach($students as $row):?>
                        <tr class="gradeA">
                            <td><?php echo $no+=1;?></td>
                            <td><?php echo $row['name'];?></td>
                            <?php 
                                 $verify_data    =   array(  'nis' => $row['nis'],
                                                            'bulan' => $month,
                                                           );
                               
                                  $attendance = $this->db->get_where('pelanggaran' , $verify_data)->result_array();
                                foreach ($attendance as $a) {
                                    # code...
                                    ?>
                                    <td><?= $a['tgl'];?></td>
                                     <td><?= $a['isi'];?></td>
                                     <td><?= $a['sanksi'];?></td>
                                     <?php
                              


                            }
                               
                               
                            ?>
                           
                        </tr>
                    <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>

 


</div>

<?php endif;?>


<script >

    function get_class_sections(class_id) {

        $.ajax({
            url: '<?php echo base_url();?>admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });

    }

</script>