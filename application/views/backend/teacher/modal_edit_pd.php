

<?php 
$edit_data		=	$this->db->get_where('nilai_pd' , array('pdn_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					Ubah Data
            	</div>
            </div>
			<div class="panel-body">
                <?php echo form_open(base_url() . 'teacher/pd/do_update/'.$row['pdn_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nama</label>
                    <div class="col-sm-5 controls">
                        <input type="text" class="form-control" name="tema" value="<?= $this->crud_model->get_student_name($row['nis']);?>" disabled="true"/>
                    </div>
                </div>
               <div class="form-group">
                                <label class="col-sm-3 control-label">Bulan</label>
                                <div class="col-sm-5">
                                   <input type="text" class="form-control "  name="tgl" value="<?= $row['bulan'];?>" >
                                  
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-sm-3 control-label">Pengembangan Diri</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="kegiatan" disabled data-message-required="<?php echo get_phrase('value_required');?>" value="<?= $this->crud_model->get_pd_name($row['id']);?>"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Materi</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="materi" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?= $row['materi'];?>"/>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-sm-3 control-label">Capaian</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="capaian" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?= $row['capaian'];?>"/>
                                </div>
                            </div>
                                    <input type="hidden" class="form-control" name="section_id" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?= $row['section_id'];?>"/>
                            
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-info">Ubah Nilai</button>
                    </div>
                 </div>
        		</form>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>



