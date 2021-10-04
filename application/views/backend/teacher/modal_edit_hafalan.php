<?php 
$edit_data		=	$this->db->get_where('hafalan' , array('hafalan_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					Ubah Tema
            	</div>
            </div>
			<div class="panel-body">
                <?php echo form_open(base_url() . 'teacher/hafalan/do_update/'.$row['hafalan_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                    <div class="col-sm-5 controls">
                        <input type="text" class="form-control" name="tema" value="<?php echo $row['tema'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                                <label class="col-sm-3 control-label">Bulan</label>
                                <div class="col-sm-5">
                                    <select name="bulan" class="form-control" disabled>
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
                                <option value="<?php echo $i;?>" <?php echo $row['bulan']==$i?'selected':''?>>
                                        <?php echo $m;?>
                                            </option>
                            <?php 
                            endfor;
                            ?>
                        </select>
                                </div>
                            </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Kategori</label>
                    <div class="col-sm-5 controls">
                        <select name="kategori" class="form-control">
                            <option value="1" <?= $row['kategori']==1?'selected':'';?>>Al-Qur'an</option>
                            <option value="0" <?= $row['kategori']!=1?'selected':'';?>>Hadits</option>
                        </select>
                    </div>
                </div>
               <input type="hidden" name="section_id" value="<?= $row['section_id'];?>">
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_subject');?></button>
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



