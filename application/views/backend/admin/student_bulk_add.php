<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					Import Data Santri
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'admin/student_bulk_add/import_excel/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('select_excel_file');?></label>
                        
						<div class="col-sm-5">
                        	<input type="file" name="userfile" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                            <br>
                         <a href="<?php echo base_url();?>uploads/import_santri.xlsx" target="_blank" 
                         		class="btn btn-info btn-sm"><i class="entypo-download"></i> Download Format excel</a>
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Tingkat Pendidikan</label>
                        
						<div class="col-sm-5">
							<select name="class_id" class="form-control" data-validate="required" id="class_id" data-message-required="<?php echo get_phrase('value_required');?>" onchange="return get_class_sections(this.value)">
                              <option value="">Pilih</option>
                              <?php 
										$classes = $this->db->get('class')->result_array();
										foreach($classes as $row):
											?>
                                    		<option value="<?php echo $row['class_id'];?>">
													<?php echo $row['name'];?>
                                                    </option>
                                        <?php
										endforeach;
								  ?>
                          </select>
						</div> 
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Kelas</label>
                        
						<div class="col-sm-5">
							<select name="section_id" class="form-control" id="section_selector_holder" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                              <option value="">Pilih</option>
                              
                          </select>
						</div> 
					</div>
					
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('upload_and_import');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

	function get_class_sections(class_id) {

    	$.ajax({
            url: '<?php echo base_url();?>admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });

    }

</script>