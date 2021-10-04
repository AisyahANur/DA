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

    <div style=""></div>	
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->


        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/dashboard">
                <i class="entypo-gauge"></i>
                <span>Beranda</span>
            </a>
        </li>

        <!-- STUDENT -->
        <li class="<?php
        if ($page_name == 'student_add' ||
                $page_name == 'student_bulk_add' ||
                $page_name == 'student_information' ||
                $page_name == 'student_marksheet')
            echo 'opened active has-sub';
        ?> ">
            <a href="#">
                <i class="fa fa-group"></i>
                <span>Santri</span>
            </a>
            <ul>
                <!-- STUDENT ADMISSION -->
                <li class="<?php if ($page_name == 'student_add') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/student_add">
                        <span><i class="entypo-dot"></i> Tambah Data Santri</span>
                    </a>
                </li>

                <!-- STUDENT BULK ADMISSION -->
                <li class="<?php if ($page_name == 'student_bulk_add') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/student_bulk_add">
                        <span><i class="entypo-dot"></i>Import Data Santri</span>
                    </a>
                </li>

                <!-- STUDENT INFORMATION -->
                <li class="<?php if ($page_name == 'student_information') echo 'opened active'; ?> ">
                    <a href="#">
                        <span><i class="entypo-dot"></i> Data Santri</span>
                    </a>
                    <ul>
                        <?php
                        $classes = $this->db->get('class')->result_array();
                        foreach ($classes as $row):
                            ?>
                            <li class="<?php if ($page_name == 'student_information' && $class_id == $row['class_id']) echo 'active'; ?>">
                                <a href="<?php echo base_url(); ?>admin/student_information/<?php echo $row['class_id']; ?>">
                                    <span> <?php echo $row['name']; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>

               
            </ul>
        </li>

        <!-- TEACHER -->
        <li class="<?php if ($page_name == 'teacher') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/teacher">
                <i class="entypo-users"></i>
                <span>Guru</span>
            </a>
        </li>

            

        <!-- CLASS -->
        <li class="<?php
        if ($page_name == 'class' ||
                $page_name == 'section')
            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-flow-tree"></i>
                <span>Kelas</span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'class') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/classes">
                        <span><i class="entypo-dot"></i>Jenjang Pendidikan</span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'section') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/section">
                        <span><i class="entypo-dot"></i> Kelas</span>
                    </a>
                </li>
            </ul>
        </li>


                <!-- TEACHER -->
        <li class="<?php if ($page_name == 'akademik') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?><?php echo $account_type."/akademik";?>">
                <i class="entypo-book"></i>
                <span>Nilai Akademik</span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'pd') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?><?php echo $account_type."/pd";?>">
                <i class="entypo-trophy"></i>
                <span>Pengembangan Diri</span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'ujian') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?><?php echo $account_type."/ujian";?>">
                <i class="entypo-graduation-cap"></i>
                <span>Ujian</span>
            </a>
        </li>

          <!-- TEACHER -->
        <li class="<?php if ($page_name == 'tahfidz') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?><?php echo $account_type."/hafalan";?>">
                <i class="entypo-book-open"></i>
                <span>Nilai Hafalan & BTQ</span>
            </a>
        </li>
        
               <!-- TEACHER -->
        <li class="<?php if ($page_name == 'tahfidz') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?><?php echo $account_type."/manage_attendance";?>">
                <i class="entypo-check"></i>
                <span>Rekapitulasi Kehadiran</span>
            </a>
        </li>
  

            <!-- TEACHER -->
       <!--  <li class="<?php if ($page_name == 'kesantrian') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?><?php echo $account_type."/kesantrian";?>">
                <i class="entypo-chart-bar"></i>
                <span>Kesantrian</span>
            </a>
        </li> -->






        <!-- NOTICEBOARD -->
        <li class="<?php if ($page_name == 'noticeboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/noticeboard">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('noticeboard'); ?></span>
            </a>
        </li>


        <!-- SETTINGS -->
      <!--   <li class="<?php
        if ($page_name == 'system_settings' ||
                $page_name == 'manage_language' ||
                    $page_name == 'sms_settings')
                        echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-lifebuoy"></i>
                <span><?php echo get_phrase('settings'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'system_settings') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/system_settings">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('general_settings'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'sms_settings') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/sms_settings">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('sms_settings'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_language') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/manage_language">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('language_settings'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
 -->
        <!-- ACCOUNT -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/manage_profile">
                <i class="entypo-lock"></i>
                <span><?php echo get_phrase('account'); ?></span>
            </a>
        </li>

    </ul>

</div>