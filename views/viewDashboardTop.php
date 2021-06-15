
<?php $this->_title = 'TOP 10 VIRUSES'; ?>


<section>
	<legend>TOP 10 viruses</legend>
	<div class="row text-center justify-content-lg-center justify-content-md-center mb-5">
		<table class="col-lg-11 col-md-11 table table-bordered table-striped">
			<thead class="bg-success">
				<tr >
					<th scope="col"><center><font face="Courier New" size="6">#</font></center></th>
			      <th scope="col"><center><font face="Courier New" size="6">Name</font></center></th>
			    </tr>
				</tr>
			</thead>
			<tbody>
	<?php $i = 1; ?>
	<?php foreach ($viruses as $virus): ?>
		  	<tr class="table-success" >
		    	<th scope="row"><center><font face="Courier New" size="6"><?= $i ?></font></center></th>
		    	<td><center><font face="Courier New" size="6"><?= $virus['name'] ?></font></center></td>
		    </tr>
	    <?php $i++; ?>
	<?php endforeach; ?> 
			</tbody>
		</table>
	</div>
</section>
