<?php $this->_title = 'INFORMATION'; ?>

<section>
	<label>Number of scans</label><input type="text" value=<?= $nbScans ?>><br>
	<label>Number of scanned files</label><input type="text" value=<?= $nbFiles ?>><br>
	<label>Number of detected viruses</label><input type="text" value=<?= $nbViruses ?>><br>
	<label>Number of detected viruses per month</label><input type="text" value=<?= $nbAverageVirus ?>><br>
	<label>Average time per scan</label><input type="text" value=<?= $nbAverageTimeScan ?>><br>
</section>
