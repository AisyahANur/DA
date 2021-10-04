<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					Data Ujian
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					Tambah Ujian
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>
        
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
				
                <table class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div>Nama</div></th>
                            <th><div>Bulan</div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;
                            foreach($classe as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['name'];?></td>
                            <td><?php 

                            
                                            if($row['bulan']==1)$mo='Januari';
                                            else if($row['bulan']==2)$mo='Februari';
                                            else if($row['bulan']==3)$mo='Maret';
                                            else if($row['bulan']==4)$mo='April';
                                            else if($row['bulan']==5)$mo='Mei';
                                            else if($row['bulan']==6)$mo='Juni';
                                            else if($row['bulan']==7)$mo='Juli';
                                            else if($row['bulan']==8)$mo='Agustus';
                                            else if($row['bulan']==9)$mo='September';
                                            else if($row['bulan']==10)$mo='Oktober';
                                            else if($row['bulan']==11)$mo='November';
                                            else if($row['bulan']==12)$mo='Desember';
                                      


                            echo $mo;?></td>
                            <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_edit_ujian/<?php echo $row['id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/ujian/delete/<?php echo $row['id'];?>');">
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
                	<?php echo form_open(base_url() . 'admin/ujian/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nama </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>

                             <div class="form-group">
                                <label class="col-sm-3 control-label">Bulan</label>
                                <div class="col-sm-5">
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
                                            <option value="<?php echo $i;?>"><?php echo $m;?>
                                                        </option>
                                        <?php 
                                        endfor;
                                        ?>
                                    </select>
                                </div>
                            </div>
                           
                        </div>
                             <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info">Tambah Ujian</button>
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