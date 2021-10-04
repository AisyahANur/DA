<hr />

    <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered">
        <thead>
            <tr>
              
                <th>Pilih Bulan</th>
                <th>Pilih Tahun</th>
                <th>Kategori</th>
                <th>Tema</th>
                <th>Aksi</th>
           </tr>
       </thead>
        <tbody>
            <form method="post" action="<?php echo base_url();?>teacher/nvocab_selector" class="form">
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
                        <select name="kategori" class="form-control" data-validate="required" id="class_id" data-message-required="<?php echo get_phrase('value_required');?>" onchange="return get_class_sections(this.value)">
                              <option value="">Pilih</option>
                              <option value="1">Bahasa Arab</option>
                              <option value="0">Bahasa Inggris</option>
                        </select>

                    </td>

                    <td>
                        <select name="vocab_id" class="form-control" data-validate="required" id="section_selector_holder" >
                              <option value="">Pilih</option>
                             
                        </select>

                    </td>
                   <input type="hidden" name="section_id" value="<?= $section_id;?>">
                    <td align="center"><input type="submit" value="Tampil Nilai" class="btn btn-info"></td>
                </tr>
            </form>
        </tbody>
    </table>
<hr />



<?php if( $month!='' && $year!='' && $section_id!='' && $vocab_id !=0):
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
                <h2><?php echo ucwords($this->crud_model->get_tema('vocab','vocab_id',$vocab_id));?></h2>
                
                <h3>Nilai <?php echo $this->crud_model->get_section_name($section_id)?$this->crud_model->get_section_name($section_id):'';?></h3>
                <p><?php echo $month."-".$year;?></p>
            </div>
            <a href="#" id="update_attendance_button" onclick="return update_attendance()" 
                class="btn btn-info">
                    Update Jumlah Kata
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
                    <td>Jumlah Kosa Kata</td>
                    
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
                                                            'vocab_id' => $vocab_id);
                                $query = $this->db->get_where('nilai_vocab' , $verify_data);
                                if($query->num_rows() < 1)
                                $this->db->insert('nilai_vocab' , $verify_data);
                                
                                //showing the attendance status editing option
                                $nilai = $this->db->get_where('nilai_vocab' , $verify_data)->row();
                               
                            ?>
                            <td><?= $nilai->nilai<=60?'<font color="red">'.$nilai->nilai.'</font>':$nilai->nilai;?></td>
                            
                        </tr>
                    <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>




<div class="row" id="update_attendance">

<!-- STUDENT's attendance submission form here -->
<form method="post" 
    action="<?php echo base_url();?>teacher/manage_nilaiv/<?php echo $month.'/'.$year.'/'.$section_id.'/'.$vocab_id;?>">
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
                                                            'bulan' => $month,
                                                            'tahun' => $year,
                                                            'section_id' => $section_id,
                                                            'vocab_id' => $vocab_id);
                                $query = $this->db->get_where('nilai_vocab' , $verify_data);
                                if($query->num_rows() < 1)
                                $this->db->insert('nilai_vocab' , $verify_data);
                                
                                //showing the attendance status editing option
                                $nilai = $this->db->get_where('nilai_vocab' , $verify_data)->row();
                                $isi     = $nilai->nilai?$nilai->nilai:'';
                               
                               
                                ?>
                            <td align="center">
                                <input type="text" class="form-control" name="nilai_<?php echo $row['student_id'];?>"
                                value="<?= $isi;?>"
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

<script >

    function get_class_sections(class_id) {
        var bulan = $('select[name=bulan] option').filter(':selected').val();
        $.ajax({
            url: '<?php echo base_url();?>teacher/get_tema_vocab/' + class_id + '/<?= $section_id;?>/'+bulan,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });

    }

</script>

