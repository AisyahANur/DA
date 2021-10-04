
<br><br>
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th width="80"><div>No</div></th>
            <th width="80"><div>Foto</div></th>
            <th><div>Nama</div></th>
            <th><div>NIS</div></th>
             <th><div>Tempat & Tanggal Lahir</div></th>
              <th><div>Jenis Kelamin</div></th>
            <th class="span3">Alamat</div></th>
        </tr>
    </thead>
    <tbody>
        <?php 
                $students	=	$this->db->get_where('student' , array('section_id'=>$section_id))->result_array();
                $no = 0 ;
                foreach($students as $row):?>
        <tr>
            <td><?= $no += 1;?></td>
            <td><img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" class="img-circle" width="30" /></td>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['nis'];?></td>
            <td><?php echo $row['tl'].", ".$row['birthday'];?></td>
            <td><?php echo $row['sex'];?></td>
            <td><?php echo $row['address'];?></td>
         
           
        </tr>
        <?php endforeach;?>
    </tbody>
</table>



<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable({
			"sPaginationType": "bootstrap",
			"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
			"oTableTools": {
				"aButtons": [
					
				
					{
						"sExtends": "print",
						"fnSetText"	   : "Press 'esc' to return",
						"fnClick": function (nButton, oConfig) {
							datatable.fnSetColumnVis(1, false);
							datatable.fnSetColumnVis(5, false);
							
							this.fnPrint( true, oConfig );
							
							window.print();
							
							$(window).keyup(function(e) {
								  if (e.which == 27) {
									  datatable.fnSetColumnVis(1, true);
									  datatable.fnSetColumnVis(5, true);
								  }
							});
						},
						
					},
				]
			},
			
		});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>