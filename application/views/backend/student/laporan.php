<script>
    function printContent(el){
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
    </script>
  <div class="row">
    <div class="col-sm-10"></div>

    <div class="col-sm-2"><button onclick="printContent('print')" class="btn btn-primary btn-block" ><i class="entypo-print"></i>Print</button> </div>
                          
    </div>                        
                    
<div id="print">
<div class="row">
    <div class="col-md-12">
            
                    
                    <!-- panel head -->
                  
                    
     <!-- ///////////////// -->
<?php
$bln = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','November','Desember'];
foreach ($santri as $s) {
    # code...

?>


        <div class="profile-env">
            
            <header class="row">
                
                <div class="col-sm-3">
                    
                    <a href="#" class="profile-picture" >
                        <img src="<?php echo $this->crud_model->get_image_url('student',$s['student_id']);?>" class="img-responsive img-circle" style="height:80px;width:80px;"/>
                    </a>
                    
                </div>

                
                <div class="col-sm-3" style="margin-top: -5px;">
                    
                    <ul class="profile-info-sections">
                        <li>
                            <div class="profile-name">
                                <strong>
                                    <a href="#"><?= $s['name'];?></a>
                                    <a href="#" class="user-status is-online tooltip-primary" data-toggle="tooltip" data-placement="top" data-original-title="Aktif"></a>
                                    <!-- User statuses available classes "is-online", "is-offline", "is-idle", "is-busy" -->                        </strong>
                                <span><a href="#">NIS : <?= $s['nis'];?>
                                </a></span>
                            </div>
                        </li>
                       
                    </ul>
                    
                </div>
                <div class="col-sm-3"></div>
                <div class="col-sm-3">
                    
                    <div class="profile-buttons">
                            <i class="entypo-calendar"></i>
                          Laporan Periode : <?= $bln[intval($bulan)]."-".date('Y');?>
                        
                    </div>
                </div>
              
                
        </header>
            
            <section class="profile-info-tabs" >
                
                <div class="row" style="height: 70px;">
                    
                    <div class="col-sm-offset-2 col-sm-10">
                        
                        <ul class="user-details" style="margin-top:0px;margin-left:80px;">
                            <li>
                                <a href="#">
                                    <i class="entypo-folder"></i>
                                    <?php
                                echo $this->crud_model->get_section_name($s['section_id']);
                                ?>
                                </a>
                            </li>
                            
                            <li>
                                <a href="#">
                                    <i class="entypo-home"></i>
                                   <?= $s['address'];?>
                                </a>
                            </li>
                            
                            <li>
                                <a href="#">
                                    <i class="entypo-calendar"></i>
                                    <?= $s['tl'].", ".$s['birthday'];?>
                                </a>
                            </li>
                        </ul>
                        
                        
                      
                   
                        
                        
                    </div>
                    
                </div>

                
            </section>
            
            
        </div>




<div class="row">
            <div class="col-md-6">
            
                <div class="panel panel-primary" data-collapsed="0">
                    
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title"><h3>Mata Pelajaran Umum</h3></div>
                        
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
                        <div class="panel-title"><h3>Mata Pelajaran Kepesantrenan</h3></div>
                        
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


<!-- Hafalan -->
<div class="row">
            <div class="col-md-6">
            
                <div class="panel panel-primary" data-collapsed="0">
                    
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title"><h3>Hafalan Al-Qur'an</h3></div>
                        
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
                       foreach ($nilai1 as $row) {
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
                        <div class="panel-title"><h3>Hafalan Hadits</h3></div>
                        
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
                       foreach ($nilai1 as $row) {
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
                        <div class="panel-title"><h3>Hafalan Kosakata Bahasa Inggris</h3></div>
                        
                        <div class="panel-options">
                         
                        </div>
                    </div>
                    
                    <!-- panel body -->
                    <div class="panel-body">
                        <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tema</th>
                            <th>Jumlah Kosa Kata</th>
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
                        <div class="panel-title"><h3>Hafalan Kosakata Bahasa Arab</h3></div>
                        
                        <div class="panel-options">
                          
                        </div>
                    </div>
                    
                    <!-- panel body -->
                    <div class="panel-body">
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            
                            <th>Tema</th>
                            <th>Jumlah Kosa Kata</th>
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



<div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary" data-collapsed="0">
                    
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title"><h3>Kehadiran</h3></div>
                        
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
                       foreach ($absen as $h) {
                           # code...
                          
                           ?>
                                    <tr>
                                     
                                        <td><?= $h['hadir'];?></td>
                                         <td><?= $h['t_pondok'];?></td>
                                          <td><?= $h['sakit'];?></td>
                                           <td><?= $h['izin'];?></td>
                                            <td><?= $h['alfa'];?></td>
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
            <!-- BTQ -->
             <div class="col-md-6">
                <div class="panel panel-primary" data-collapsed="0">
                    
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title"><h3>Nilai Baca Tulis Al-Qur'an</h3></div>
                        
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
</div>




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


           

<!-- vocab -->

            <div class="col-md-6">
            
                <div class="panel panel-primary" data-collapsed="0">
                    
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title"><h3>Pengembangan Diri</h3></div>
                        
                        <div class="panel-options">
                         
                        </div>
                    </div>
                    
                    <!-- panel body -->
                    <div class="panel-body">
                        <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Pengembangan Diri</th>
                            <th>Materi</th>
                            <th>Capaian</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                       <?php
                       foreach ($pd as $pdd) {
                            ?>
                                    <tr>
                                        <td><?= $pdd['bulan'];?></td>
                                        <td><?= $this->crud_model->get_pd_name($pdd['id']);?></td>
                                        <td><?= $pdd['materi'];?></td>
                                        <td><?= $pdd['capaian'];?></td>
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
<?php
}
?>
</div>
</div>  
</div>
