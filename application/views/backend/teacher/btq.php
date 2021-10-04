<hr />

    <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered">
        <thead>
            <tr>
              
                <th>Pilih Bulan</th>
                <th>Pilih Tahun</th>
                <th>Aksi</th>
           </tr>
       </thead>
        <tbody>
            <form method="post" action="<?php echo base_url();?>teacher/btq_selector" class="form">
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
                        <select name="year" class="form-control">
                            <?php for($i=date('Y');$i>=2018;$i--):?>
                                <option value="<?php echo $i;?>"
                                    <?php if(isset($year) && $year==$i)echo 'selected="selected"';?>>
                                        <?php echo $i;?>
                                            </option>
                            <?php endfor;?>
                        </select>
                    </td>
                   

                 
                   <input type="hidden" name="section_id" value="<?= $section_id;?>">
                    <td align="center"><input type="submit" value="Tampil Nilai" class="btn btn-info"></td>
                </tr>
            </form>
        </tbody>
    </table>
<hr />



<?php if( $month!='' && $year!='' && $section_id!='' ):
?>

<center>
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
        
            <div class="tile-stats tile-orange">
                <div class="icon"><i class="entypo-book"></i></div>
                <?php
                    $bulan  =   $month;
                    $day        = date('M', $month);
                 ?>
                <h2>Baca Tulis Al-Qur'an</h2>
                
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
                    <td>Mampu melafalkan huruf hijaiyah dengan benar</td>
                    <td>Mampu membaca Al-Qur'an dengan baik dan benar</td>
                    <td>Mampu memahami ilmu tajwid</td>
                    
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
                                                            'tahun' => $year,
                                                            'section_id' => $section_id,
                                                            );
                                $query = $this->db->get_where('btq' , $verify_data);
                                if($query->num_rows() < 1)
                                $this->db->insert('btq' , $verify_data);
                                
                                //showing the attendance status editing option
                                $nilai = $this->db->get_where('btq' , $verify_data)->row();
                               
                            ?>
                            <td><?= $nilai->huruf<=55?'<font color="red">'.$nilai->huruf.'</font>':$nilai->huruf;?></td>
                            <td><?= $nilai->baca<=55?'<font color="red">'.$nilai->baca.'</font>':$nilai->baca;?></td>
                            <td><?= $nilai->tajwid<=55?'<font color="red">'.$nilai->tajwid.'</font>':$nilai->tajwid;?></td>
                            
                        </tr>
                    <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>




<div class="row" id="update_attendance">

<!-- STUDENT's attendance submission form here -->
<form method="post" 
    action="<?php echo base_url();?>teacher/btq/<?php echo $section_id.'/'.$month.'/'.$year;?>">
        <div class="col-sm-offset-3 col-md-6">
            <table  class="table table-bordered">
                <thead>
                    <tr class="gradeA">
                        <td>No</td>
                        <td>Nama</td>
                        <td>Mampu melafalkan huruf hijaiyah dengan benar</td>
                             <td>Mampu membaca Al-Qur'an dengan baik dan benar</td>
                    <td>Mampu memahami ilmu tajwid</td>
                       
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
                                                            'bulan' => $month,
                                                            'tahun' => $year,
                                                            'section_id' => $section_id);
                                $query = $this->db->get_where('btq' , $verify_data);
                                if($query->num_rows() < 1)
                                $this->db->insert('btq' , $verify_data);
                                
                                //showing the attendance status editing option
                                $nilai = $this->db->get_where('btq' , $verify_data)->row();
                                $isi1     = $nilai->huruf?$nilai->huruf:'';
                                 $isi2     = $nilai->baca?$nilai->baca:'';
                                  $isi3     = $nilai->tajwid?$nilai->tajwid:'';
                               
                               
                                ?>
                            <td align="center">
                                <input type="text" class="form-control" name="nilai1_<?php echo $row['student_id'];?>"
                                value="<?= $isi1;?>"
                                >
                            </td>
                            <td align="center">
                                <input type="text" class="form-control" name="nilai2_<?php echo $row['student_id'];?>"
                                value="<?= $isi2;?>"
                                >
                            </td>
                            <td align="center">
                                <input type="text" class="form-control" name="nilai3_<?php echo $row['student_id'];?>"
                                value="<?= $isi3;?>"
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



