<?php $this->_title = 'info'; ?>

<section>
	<fieldset>
		<legend>Number of scanned files</legend>
		<fieldset>
			<label>Total scanned files</label><input type="scans" name="scansfiles"value=<?= $files ?>><br>
		</fieldset>
	</fieldset>
</section>

<section>
	<fieldset>
		<legend>Number of detected viruses</legend>
		<fieldset>
			<label>detected viruses</label><input type="viruses" name="detectedviruses" value=<?= $viruses ?>><br>
		</fieldset>
	</fieldset>
</section>

<section>
	<fieldset>
		<legend>Viruses detected per month</legend>
		<fieldset>
			<label>Viruses/month</label><input type="viruses" name="virusesmonth" value=<?= $virusesM["RES"] ?>><br>
		</fieldset>
	</fieldset>
</section>

<section>
	<fieldset>
		<legend>Average time of scans</legend>
		<fieldset>
			<label>Average time</label><input type="scans" name="averagetimescans" value=<?= $AverageViruses ?>><br>
		</fieldset>
	</fieldset>
</section>