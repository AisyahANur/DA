<?php 
$edit_data		=	$this->db->get_where('subject' , array('subject_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					Ubah Mata Pelajaran
            	</div>
            </div>
			<div class="panel-body">
                <?php echo form_open(base_url() . 'admin/subject/do_update/'.$row['subject_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nama</label>
                    <div class="col-sm-5 controls">
                        <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Kelas</label>
                    <div class="col-sm-5 controls">
                        <select name="section_id" class="form-control">
                            <?php 
                            $classes = $this->db->get('section')->result_array();
                            foreach($classes as $row2):
                            ?>
                                <option value="<?php echo $row2['section_id'];?>"
                                    <?php if($row['section_id'] == $row2['section_id'])echo 'selected';?>>
                                        <?php echo $row2['name'];?>
                                            </option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                                <label class="col-sm-3 control-label">Kategori</label>
                                <div class="col-sm-5">
                                    <select name="kategori" class="form-control" style="width:100%;">
                                      
                                       
                                            <option value="1" <?php echo $row['kategori']==1?'selected':'';?>>Keagamaan</option>
                                            <option value="0" <?php echo $row['kategori']==0?'selected':'';?>>Umum</option>
                                        
                                    </select>
                                </div>
                 </div>
               
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-info">Ubah</button>
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



