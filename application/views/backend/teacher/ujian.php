<hr />

    <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered">
        <thead>
            <tr>
              
                <th>Pilih Ujian</th>
                <th>Pilih Tahun</th>
                <th>Mata Pelajaran</th>
                <th>Aksi</th>
           </tr>
       </thead>
        <tbody>
            <form method="post" action="<?php echo base_url();?>teacher/ujian_selector" class="form">
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
                        <select name="subject_id" class="form-control" data-validate="required"  >
                              <option value="">Pilih</option>
                              <?php 
                                        $this->db->where('section_id',$section_id);
                                        $classes = $this->db->get('subject')->result_array();
                                        foreach($classes as $row):
                                            ?>
                                            <option value="<?php echo $row['subject_id'];?>">
                                                    <?php echo $row['name'];?>
                                                    </option>
                                        <?php
                                        endforeach;
                                  ?>
                        </select>

                    </td>
                   <input type="hidden" name="section_id" value="<?= $section_id;?>">
                    <td align="center"><input type="submit" value="Tampil Nilai" class="btn btn-info"></td>
                </tr>
            </form>
        </tbody>
    </table>
<hr />



<?php if( $idu!='' && $year!='' && $section_id!='' && $subject_id !=0):
?>

<center>
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
        
            <div class="tile-stats tile-red">
                <div class="icon"><i class="entypo-graduation-cap"></i></div>
                <?php
                    $bulan  =   $month;
                    $day        = date('M', $month);
                 ?>
                <h2><?php echo ucwords($this->crud_model->get_subject_name($subject_id));?></h2>
                
                <h3>Nilai <?php echo $this->crud_model->get_section_name($section_id)?$this->crud_model->get_section_name($section_id):'';?></h3>
                <p><?php echo $month."-".$year;?></p>
            </div>
            <a href="#" id="update_attendance_button" onclick="return update_attendance()" 
                class="btn btn-info">
                    Update Nilai
            </a>
             
        </div>

    </div>
</center>
<hr />




<div class="row" id="attendance_list">
    <div class="col-sm-offset-3 col-md-6">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama</td>
                    <td>Nilai</td>
                
                    
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
                                                            'idu' => $idu,
                                                            'tahun' => $year,
                                                            'subject_id' => $subject_id);
                                $query = $this->db->get_where('nujian' , $verify_data);
                                if($query->num_rows() < 1)
                                $this->db->insert('nujian' , $verify_data);
                                
                                //showing the attendance status editing option
                                $nilai = $this->db->get_where('nujian' , $verify_data)->row();

                                $kkm = $this->db->get_where('subject',array('subject_id' => $subject_id))->row();
                               
                            ?>
                            <td><?= $nilai->nilai;?></td>
                   
                        </tr>
                    <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>




<div class="row" id="update_attendance">

<!-- STUDENT's attendance submission form here -->
<form method="post" 
    action="<?php echo base_url();?>teacher/manage_ujian/<?php echo $idu.'/'.$year.'/'.$section_id.'/'.$subject_id;?>">
        <div class="col-sm-offset-3 col-md-6">
            <table  class="table table-bordered">
                <thead>
                    <tr class="gradeA">
                        <td>No</td>
                        <td>Nama</td>
                        <td>Nilai</td>
                     
                       
                    </tr>
                </thead>
                <tbody>
                        
                    <?php 
                    //STUDENTS ATTENDANCE
                    $students   =   $this->db->get_where('student' , array('section_id'=>$section_id))->result_array();
                      $n=0;  
                    foreach($students as $row)
                    {
                        ?>
                        <tr class="gradeA">
                            <td><?= $n+=1;?></td>
                            <td><?php echo $row['name'];?></td>
                            <?php 
                                //inserting blank data for students attendance if unavailable
                                $verify_data    =  array(  'nis' => $row['nis'],
                                                            'idu' => $idu,
                                                            'tahun' => $year,
                                                            'subject_id' => $subject_id);
                                $query = $this->db->get_where('nujian' , $verify_data);
                                if($query->num_rows() < 1)
                                $this->db->insert('nujian' , $verify_data);
                                
                                //showing the attendance status editing option
                                $nilai = $this->db->get_where('nujian' , $verify_data)->row();
                                $isi1     = $nilai->nilai?$nilai->nilai:'';
                               
                                ?>
                            <td align="center">
                                <input type="text" class="form-control" name="nilai1_<?php echo $row['student_id'];?>"
                                value="<?= $isi1;?>"
                                >
                            </td>
                          
                           
                        </tr>
                        <?php 
                    }
                    ?>
                </tbody>
            </table>
            <input type="hidden" name="date" value="<?php echo $month;?>" />
            <center>
                <input type="submit" class="btn btn-info" value="Simpan Perubahan">
            </center>
        </div>
    
    
</form>
</div>
<?php endif;?>

<script >

    $("#update_attendance").hide();

    function update_attendance() {

        $("#attendance_list").hide();
        $("#update_attendance_button").hide();
        $("#update_attendance").show();

    }

   
</script>

