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

           <li class="<?php if ($page_name == 'rapor') echo ' active'; ?> ">
            <a href="<?php echo base_url(); ?><?php echo $account_type."/laporan/".date('m/Y');?>">
                <i class="entypo-info"></i>
                <span>Laporan Penilaian Bulanan</span>
            </a>
        </li>
         <!-- Ujian -->
        <li class="<?php if ($page_name == 'ujian') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?><?php echo $account_type."/nilai_ujian";?>">
                <i class="entypo-graduation-cap"></i>
                <span>Nilai Ujian (UTS & UAS)</span>
            </a>
        </li>


        <!-- TEACHER -->
        <li class="<?php if ($page_name == 'akademik') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?><?php echo $account_type."/nilai_akademik";?>">
                <i class="entypo-book"></i>
                <span>Nilai Akademik</span>
            </a>
        </li>

          <!-- TEACHER -->
        <li class="<?php if ($page_name == 'tahfidz') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?><?php echo $account_type."/tahfidz";?>">
                <i class="entypo-book-open"></i>
                <span>Nilai Hafalan & BTQ</span>
            </a>
        </li>
        
               <!-- TEACHER -->
        <li class="<?php if ($page_name == 'tahfidz') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?><?php echo $account_type."/absensi";?>">
                <i class="entypo-check"></i>
                <span>Rekapitulasi Kehadiran</span>
            </a>
        </li>
  

            <!-- TEACHER -->
        <li class="<?php if ($page_name == 'kesantrian') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?><?php echo $account_type."/kesantrian";?>">
                <i class="entypo-chart-bar"></i>
                <span>Kesantrian</span>
            </a>
        </li>


        <!-- SUBJECT -->
     

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