<hr />

    <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered">
        <thead>
            <tr>
              
                <th>Pilih Bulan</th>
                <th>Pilih Tahun</th>
                <th>Pilih Kelas</th>
                <th>Aksi</th>
           </tr>
       </thead>
        <tbody>
            <form method="post" action="<?php echo base_url();?>teacher/attendance_selector" class="form">
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
                        <select name="section_id" class="form-control" data-validate="required" id="class_id" data-message-required="<?php echo get_phrase('value_required');?>" >
                              <option value="">Pilih</option>
                              <?php 
                                        $this->db->where('teacher_id',$this->session->userdata('teacher_id'));
                                        $classes = $this->db->get('section')->result_array();
                                        foreach($classes as $row):
                                            ?>
                                            <option value="<?php echo $row['section_id'];?>">
                                                    <?php echo $row['name'];?>
                                                    </option>
                                        <?php
                                        endforeach;
                                  ?>
                        </select>

                    </td>
                   
                    <td align="center"><input type="submit" value="Absensi" class="btn btn-info"></td>
                </tr>
            </form>
        </tbody>
    </table>
<hr />



<?php if( $month!='' && $year!=''  && $section_id!=''):?>

<center>
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
        
            <div class="tile-stats tile-green">
                <div class="icon"><i class="entypo-calendar"></i></div>
                <?php
                    $bulan  =   $month;
                    $day        = date('M', $bulan);
                 ?>
               
                
                <h3>Data Kehadiran <?php echo $this->crud_model->get_section_name($section_id);?></h3>
                <p><?php echo $month."-".$year;?></p>
            </div>
            <a href="#" id="update_attendance_button" onclick="return update_attendance()" 
                class="btn btn-info">
                    Update Absensi
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
                    <td>Hadir</td>
                    <td>Tugas Pondok</td>
                    <td>Sakit</td>
                    <td>Izin</td>
                    <td>Alfa</td>
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
                                                            'bulan' => $month);
                                $query = $this->db->get_where('attendance' , $verify_data);
                                if($query->num_rows() < 1)
                                $this->db->insert('attendance' , $verify_data);
                                
                                //showing the attendance status editing option
                                $attendance = $this->db->get_where('attendance' , $verify_data)->row();
                               
                            ?>
                            <td><?= $attendance->hadir;?></td>
                            <td><?= $attendance->t_pondok;?></td>
                            <td><?= $attendance->sakit;?></td>
                            <td><?= $attendance->izin;?></td>
                            <td><?= $attendance->alfa;?></td>
                        </tr>
                    <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>




<div class="row" id="update_attendance">

<!-- STUDENT's attendance submission form here -->
<form method="post" 
    action="<?php echo base_url();?>teacher/manage_attendance/<?php echo $month.'/'.$year.'/'.$section_id;?>">
        <div class="col-sm-offset-3 col-md-6">
            <table  class="table table-bordered">
                <thead>
                    <tr class="gradeA">
                        <td>No</td>
                        <td>Nama</td>
                        <td>Hadir</td>
                        <td>Tugas Pondok</td>
                        <td>Sakit</td>
                        <td>Izin</td>
                        <td>Alfa</td>
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
                                $verify_data    =   array(  'nis' => $row['nis'],
                                                            'bulan' => $month);
                                $query = $this->db->get_where('attendance' , $verify_data);
                                if($query->num_rows() < 1)
                                $this->db->insert('attendance' , $verify_data);
                                
                                //showing the attendance status editing option
                                $attendance = $this->db->get_where('attendance' , $verify_data)->row();
                                $hadir     = $attendance->hadir?$attendance->hadir:'';
                                $t_pondok     = $attendance->t_pondok? $attendance->t_pondok:'';
                                $sakit     = $attendance->sakit ? $attendance->sakit : '';
                                $izin    = $attendance->izin ? $attendance->izin : '';
                                $alfa     = $attendance->alfa ? $attendance->alfa: '';
                               
                                ?>
                            <td align="center">
                                <input type="text" class="form-control" name="hadir_<?php echo $row['student_id'];?>"
                                value="<?= $hadir;?>"
                                >
                            </td>
                             <td align="center">
                                <input type="text" class="form-control" name="t_pondok_<?php echo $row['student_id'];?>"
                                value="<?= $t_pondok;?>"
                                >
                            </td>
                             <td align="center">
                                <input type="text" value="<?= $sakit ;?>" class="form-control" name="sakit_<?php echo $row['student_id'];?>">
                            </td>
                             <td align="center">
                                <input type="text" value="<?= $izin ;?>" class="form-control" name="izin_<?php echo $row['student_id'];?>">
                            </td>
                             <td align="center">
                                <input type="text" value="<?= $alfa;?>" class="form-control" name="alfa_<?php echo $row['student_id'];?>">
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

