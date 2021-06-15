<?php $this->_title = 'INFORMATION'; ?>
<section>
	<div class="row text-center justify-content-lg-center justify-content-md-center mb-5">
		<table class="col-lg-11 col-md-11 table table-bordered table-striped">
			<tbody>
					<tr class="table-success" height="500px">
						<td colspan="2" class="description"><font face="Courier New" size="6"><center>Le nombre de scan</br> total est de <br> </font><strong><font face="Courier New" size="6" color="green"><?= $nbScans ?></strong></center></font></td>
						<td colspan="2" class="description"><font face="Courier New" size="6"><center>Le nombre de fichiers</br> scannés est de <br> </font><strong><font face="Courier New" size="6" color="green"><?= $nbFiles ?></strong></center></font></td>
						<td colspan="2" class="description"><font face="Courier New" size="6"><center>Le nombre de virus</br> detectés est de <br> </font><strong><font face="Courier New" size="6" color="green"><?= $nbViruses ?></strong></center></font></td>
					</tr>
					<tr height="500px">
						<td colspan="3" class="description"><font face="Courier New" size="6"><center>Le nombre moyen </br> de virus detectés <br> par mois est </br> de </font><strong><font face="Courier New" size="6" color="green"><?= $nbAverageVirus?></strong></center></font></td>
						<td colspan="3" class="description"><font face="Courier New" size="6"><center>Le temps moyen</br> d'un scan est<br> de </font><strong><font face="Courier New" size="6" color="green"><?= $nbAverageTimeScan ?></strong></center></font></td>
					</tr>
			</tbody>
		</table>
	</div>
</section>
