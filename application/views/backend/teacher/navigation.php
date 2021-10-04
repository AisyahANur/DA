<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <?php echo img(['src' => 'uploads/logo.png', 'style' => 'max-height:60px']); ?>
            </a>
        </div>

        <!-- logo collapse icon -->
        <div class="sidebar-collapse" style="">
            <a href="#" class="sidebar-collapse-icon with-animation">

                <i class="entypo-menu"></i>
            </a>
        </div>

        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>
    </header>

    <div style="border-top:1px solid rgba(69, 74, 84, 0.7);"></div>	
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->


        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?><?php echo $account_type; ?>/dashboard">
                <i class="entypo-gauge"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- STUDENT -->
        <li class="<?php
        if ($page_name == 'student_add' ||
                $page_name == 'student_information' ||
                $page_name == 'student_marksheet')
            echo 'opened active has-sub';
        ?> ">
            <a href="#">
                <i class="fa fa-group"></i>
                <span>Santri</span>
            </a>
            <ul>
               

                <!-- STUDENT INFORMATION -->
                <li class="<?php if ($page_name == 'student_information') echo 'opened active'; ?> ">
                    <a href="#">
                        <span><i class="entypo-dot"></i> Data Santri</span>
                    </a>
                    <ul>

<?php 
$this->db->where('teacher_id',$this->session->userdata('teacher_id'));
$classes = $this->db->get('section')->result_array();
foreach ($classes as $row):
    ?>
                            <li class="<?php if ($page_name == 'student_information' && $section_id == $row['section_id']) echo 'active'; ?>">
                                <a href="<?php echo base_url(); ?><?php echo $account_type; ?>/student_information/<?php echo $row['section_id']; ?>">
                                    <span><?php echo $row['name']; ?></span>
                                </a>
                            </li>
<?php endforeach; ?>
                    </ul>
                </li>

              
            </ul>
        </li>

    <li class="<?php
        if ($page_name == 'subject' ||
                $page_name == 'subject' ||
                $page_name == 'nilai')
            echo 'opened active has-sub';
        ?> ">
            <a href="#">
                <i class="entypo-book"></i>
                <span>Mata Pelajaran</span>
            </a>
            <ul>
               

                <!-- STUDENT INFORMATION -->
                <li class="<?php if ($page_name == 'subject') echo 'opened active'; ?> ">
                    <a href="#">
                        <span><i class="entypo-dot"></i> Tambah Mata Pelajaran</span>
                    </a>
                    <ul>
                <?php
                $this->db->where('teacher_id',$this->session->userdata('teacher_id'));
                $classes = $this->db->get('section')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'subject' && $section_id == $row['section_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>teacher/subject/<?php echo $row['section_id']; ?>">
                            <span> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
                </li>

                <li class="<?php if ($page_name == 'nilai') echo 'opened active'; ?> ">
                    <a href="#">
                        <span><i class="entypo-dot"></i> Nilai Mata Pelajaran</span>
                    </a>
                    <ul>
                <?php
                $this->db->where('teacher_id',$this->session->userdata('teacher_id'));
                $classes = $this->db->get('section')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'subject' && $section_id == $row['section_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>teacher/manage_nilai/<?php echo date('m/Y/').$row['section_id']; ?>">
                            <span> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
                </li>

              
            </ul>
        </li>




        <!-- DAILY ATTENDANCE -->
        <li class="<?php if ($page_name == 'manage_attendance') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?><?php echo $account_type; ?>/manage_attendance/<?php echo date("m/Y"); ?>">
                <i class="entypo-chart-area"></i>
                <span>Rekapitulasi Kehadiran</span>
            </a>

        </li>

        <!-- //////////////// -->
        <li class="<?php
        if ($page_name == 'hafalan' ||
                $page_name == 'hafalan' ||
                $page_name == 'nilaih')
            echo 'opened active has-sub';
        ?> ">
            <a href="#">
                <i class="entypo-docs"></i>
                <span>Hafalan Al-Qur'an & Hadits</span>
            </a>
            <ul>
               

                <!-- STUDENT INFORMATION -->
                <li class="<?php if ($page_name == 'hafalan') echo 'opened active'; ?> ">
                    <a href="#">
                        <span><i class="entypo-dot"></i> Tambah Tema Hafalan</span>
                    </a>
                   <ul>
                <?php
                $this->db->where('teacher_id',$this->session->userdata('teacher_id'));
                $classes = $this->db->get('section')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'hafalan' && $section_id == $row['section_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>teacher/hafalan/<?php echo $row['section_id']; ?>">
                            <span> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
                </li>

                <li class="<?php if ($page_name == 'nilaih') echo 'opened active'; ?> ">
                    <a href="#">
                        <span><i class="entypo-dot"></i> Nilai Hafalan</span>
                    </a>
                    <ul>
                <?php
                $this->db->where('teacher_id',$this->session->userdata('teacher_id'));
                $classes = $this->db->get('section')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'manage_nilaih' && $section_id == $row['section_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>teacher/manage_nilaih/<?php echo date('m/Y/').$row['section_id']; ?>">
                            <span> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
                </li>

              
            </ul>
        </li>
<!-- //////////////// -->
        <li class="<?php
        if ($page_name == 'vocab' ||
                $page_name == 'vocab' ||
                $page_name == 'nilaiv')
            echo 'opened active has-sub';
        ?> ">
            <a href="#">
                <i class="entypo-doc"></i>
                <span>Hafalan Mufrodat/Vocabulary</span>
            </a>
            <ul>
               

                <!-- STUDENT INFORMATION -->
                <li class="<?php if ($page_name == 'vocab') echo 'opened active'; ?> ">
                    <a href="#">
                        <span><i class="entypo-dot"></i> Tambah Tema Hafalan</span>
                    </a>
                   <ul>
                <?php
                $this->db->where('teacher_id',$this->session->userdata('teacher_id'));
                $classes = $this->db->get('section')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'vocab' && $section_id == $row['section_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>teacher/vocab/<?php echo $row['section_id']; ?>">
                            <span> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
                </li>

                <li class="<?php if ($page_name == 'nilaiv') echo 'opened active'; ?> ">
                    <a href="#">
                        <span><i class="entypo-dot"></i> Nilai Hafalan</span>
                    </a>
                     <ul>
                <?php
                $this->db->where('teacher_id',$this->session->userdata('teacher_id'));
                $classes = $this->db->get('section')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'nilaiv' && $section_id == $row['section_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>teacher/manage_nilaiv/<?php echo date('m/Y/').$row['section_id']; ?>">
                            <span> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
                </li>

              
            </ul>
        </li>


<!-- BTQ -->
        <li class="<?php
        if ($page_name == 'btq')
            echo 'opened active has-sub';
        ?>  ">
            <a href="#">
                <i class="entypo-book-open"></i>
                <span>Baca Tulis Al-Qur'an</span>
            </a>
            <ul>
                <?php
                $this->db->where('teacher_id',$this->session->userdata('teacher_id'));
                $classes = $this->db->get('section')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'btq' && $section_id == $row['section_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>teacher/btq/<?= $row['section_id']; ?>">
                            <span> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>

<!-- Ujian -->
        <li class="<?php
        if ($page_name == 'ujian')
            echo 'opened active has-sub';
        ?>  ">
            <a href="#">
                <i class="entypo-graduation-cap"></i>
                <span>Ujian</span>
            </a>
            <ul>
                <?php
                $this->db->where('teacher_id',$this->session->userdata('teacher_id'));
                $classes = $this->db->get('section')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'ujian' && $section_id == $row['section_id']) echo 'active'; ?>">
                       <a href="<?php echo base_url(); ?>teacher/manage_ujian/<?php echo date('m/Y/').$row['section_id']; ?>">
                            <span> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>


<!-- Kegiatan -->
        <li class="<?php
        if ($page_name == 'kegiatan')
            echo 'opened active has-sub';
        ?>  ">
            <a href="#">
                <i class="entypo-check"></i>
                <span>Kegiatan</span>
            </a>
            <ul>
                <?php
                $this->db->where('teacher_id',$this->session->userdata('teacher_id'));
                $classes = $this->db->get('section')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'kesantrian' && $section_id == $row['section_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>teacher/kegiatan/<?= $row['section_id']; ?>">
                            <span> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>

        <!-- Prestasi -->
        <li class="<?php
        if ($page_name == 'prestasi')
            echo 'opened active has-sub';
        ?>  ">
            <a href="#">
                <i class="entypo-trophy"></i>
                <span>Prestasi</span>
            </a>
            <ul>
                <?php
                $this->db->where('teacher_id',$this->session->userdata('teacher_id'));
                $classes = $this->db->get('section')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'kesantrian' && $section_id == $row['section_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>teacher/prestasi/<?= $row['section_id']; ?>">
                            <span> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>
        <!-- perizinan -->
        <li class="<?php
        if ($page_name == 'perizinan')
            echo 'opened active has-sub';
        ?>  ">
            <a href="#">
                <i class="entypo-flight"></i>
                <span>Perizinan</span>
            </a>
            <ul>
                <?php
                $this->db->where('teacher_id',$this->session->userdata('teacher_id'));
                $classes = $this->db->get('section')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'kesantrian' && $section_id == $row['section_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>teacher/perizinan/<?= $row['section_id']; ?>">
                            <span> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>

        <!-- Sakit -->
        <li class="<?php
        if ($page_name == 'sakit')
            echo 'opened active has-sub';
        ?>  ">
            <a href="#">
                <i class="entypo-plus"></i>
                <span>Sakit</span>
            </a>
            <ul>
                <?php
                $this->db->where('teacher_id',$this->session->userdata('teacher_id'));
                $classes = $this->db->get('section')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'kesantrian' && $section_id == $row['section_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>teacher/sakit/<?= $row['section_id']; ?>">
                            <span> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>

           <!-- Pelanggaran -->
        <li class="<?php
        if ($page_name == 'pelanggaran')
            echo 'opened active has-sub';
        ?>  ">
            <a href="#">
                <i class="entypo-thumbs-down"></i>
                <span>Pelanggaran</span>
            </a>
            <ul>
                <?php
                $this->db->where('teacher_id',$this->session->userdata('teacher_id'));
                $classes = $this->db->get('section')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'kesantrian' && $section_id == $row['section_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>teacher/pelanggaran/<?= $row['section_id']; ?>">
                            <span> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>

          <!-- PD -->
        <li class="<?php
        if ($page_name == 'pd')
            echo 'opened active has-sub';
        ?>  ">
            <a href="#">
                <i class="entypo-lamp"></i>
                <span>Pengembangan Diri</span>
            </a>
            <ul>
                <?php
                $this->db->where('teacher_id',$this->session->userdata('teacher_id'));
                $classes = $this->db->get('section')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'pd' && $section_id == $row['section_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>teacher/pd/<?= $row['section_id']; ?>">
                            <span> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>

<!--  -->

        <!-- NOTICEBOARD -->
        <li class="<?php if ($page_name == 'noticeboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?><?php echo $account_type; ?>/noticeboard">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('noticeboard'); ?></span>
            </a>
        </li>



        <!-- ACCOUNT -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?><?php echo $account_type; ?>/manage_profile">
                <i class="entypo-lock"></i>
                <span><?php echo get_phrase('account'); ?></span>
            </a>
        </li>

    </ul>

</div>