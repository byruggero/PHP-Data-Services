<div class="raw">
	<h4>Data Collections &rarr; Data App: <?php $dataApp =  $this->Session->read('DataApp'); echo $dataApp['DataApp']['name']; ?></h4>
</div>


<div class="raw container top-bar">
	<div class="col-md-12">
		<div class="col-md-1 pull-right">			
			<?php echo $this -> Html -> link('<i class="fa fa-plus"></i> Add', array('action' => 'form'), array('class' => 'btn btn-default', 'escape' => false)); ?>
		</div>
	</div>
</div>



<div class="raw">
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
		<thead>
			<tr>				
				<th>Name</th>
				<th>Alias</th>
				<th>Description</th>
				<th>Data Provider</th>
				<th>Database</th>
				<th>Published</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>			
			 <?php foreach ($items as $item): ?>
			         <tr >						
						<td><?php echo $item['DataCollection']['name']; ?></td>
						<td><?php echo $item['DataCollection']['alias']; ?></td>
						<td><?php echo $item['DataCollection']['description']; ?></td>
						<td><?php echo $item['DataProvider']['name']; ?></td>
						<td><?php echo $item['DataCollection']['dbname']; ?></td>
						<td class="text-center"><?php echo $item['DataCollection']['is_published']? "<i class='fa fa-check'></i>":"<i class='fa fa-times'></i>"; ?></td>
						<td class="center">
							<?php echo $this -> Html -> link('<i class="fa fa-eye"></i> Go Into &nbsp;', array('controller' => 'methods', $item['DataCollection']['id']), array('escape' => false)); ?>							
							<?php echo $this -> Html -> link('<i class="fa fa-edit"></i> Edit &nbsp;', array('action' => 'form', $item['DataCollection']['id']), array('escape' => false)); ?>
							<?php echo $this -> Html -> link('<i class="fa fa-times"></i> Delete &nbsp;', array('action' => '#'), array('class' => 'item-delete', 'data-id' => $item['DataCollection']['id'], 'escape' => false)); ?>
						</td>					
					</tr>
	         <?php endforeach; ?>	
			
		</tbody>	
	</table>
</div>

<div class="raw">
	<ol class="breadcrumb">	
	  <li><?php echo $this->Html->link('Data Apps',  array( 'controller' => 'data_apps')); ?></li>
	  <li class="active">Data Collections</li>
	</ol>
</div>


<?php $this -> startIfEmpty('script'); ?>
<script>
	$(".item-delete").click(function() {
		var id = $(this).data("id");
		noty({
			text : 'Are you sure you want to delete this item?',
			buttons : [{
				addClass : 'btn btn-primary',
				text : 'Ok',
				onClick : function($noty) {
					$.ajax({
						url : "form/" + id,
						type : "delete",
						context : document.body
					}).done(function() {
						window.location.replace("");
					});
				}
			}, {
				addClass : 'btn btn-danger',
				text : 'Cancel',
				onClick : function($noty) {
					$noty.close();
				}
			}]
		});
	});

	/* Default class modification */
	$.extend($.fn.dataTableExt.oStdClasses, {
		"sSortAsc" : "header headerSortDown",
		"sSortDesc" : "header headerSortUp",
		"sSortable" : "header"
	});

	/* Table initialisation */
	$(document).ready(function() {
		$('#example').dataTable({
			"sDom" : "<'row'<'col-md-6'l><'ol-md-6'f>r>t<'row'<'span8'i><'span8'p>>"
		});
	});

</script>
<?php $this -> end(); ?>
