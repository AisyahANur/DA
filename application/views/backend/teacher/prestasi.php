<div class="row">
    <div class="col-md-12">
    
        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    Data Prestasi Santri
                        </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    Tambah Data
                        </a></li>
        </ul>
        <!------CONTROL TABS END------>
        <div class="tab-content">            
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                
                <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th><div>Kelas</div></th>
                            <th><div>Nama</div></th>
                            <th><div>Tanggal</div></th>
                            <th><div>Prestasi</div></th>
                            <th><div>tingkat</div></th>
                            <th><div>Opsi</div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1;foreach($subjects as $row):?>
                        <tr>
                            <td><?php echo $this->crud_model->get_type_name_by_id('section',$row['section_id']);?></td>
                            <td><?php echo $this->crud_model->get_student_name($row['nis']);?></td>
                            <td><?= $row['tgl'];?></td>
                            <td><?php echo $row['isi'];?></td>
                            <td><?php echo $row['tingkat'];?></td>
                            <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_edit_prestasi/<?php echo $row['prestasi_id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>teacher/prestasi/delete/<?php echo $row['prestasi_id'];?>/<?php echo $row['section_id'];?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('delete');?>
                                            </a>
                                                    </li>
                                </ul>
                            </div>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <!----TABLE LISTING ENDS--->
            
            
            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open(base_url() . 'teacher/prestasi/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nama Santri</label>
                                <div class="col-sm-5">
                                    <select name="nis" required class="form-control">
                                        <?php
                                        $s = $this->crud_model->get_students($section_id);
                                        foreach ($s as $se) {
                                            ?>
                                            <option value="<?= $se['nis'];?>"><?= $se['name'];?></option>
                                            # code...
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-sm-3 control-label">Tanggal</label>
                                <div class="col-sm-5">
                                   <input type="text" class="form-control" placeholder="dd/mm/yyyy" name="tgl" value="" data-start-view="2">
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-sm-3 control-label">Prestasi</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="kegiatan" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tingkat</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="lokasi" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                           
                        
                                    <input type="hidden" class="form-control" name="section_id" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?= $section_id;?>"/>
                            

                             
                            
                        </div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info">Tambah</button>
                              </div>
                           </div>
                    </form>                
                </div>                
            </div>
            <!----CREATION FORM ENDS-->
            
        </div>
    </div>
</div>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

    jQuery(document).ready(function($)
    {
        

        var datatable = $("#table_export").dataTable();
        
        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });
        
</script>