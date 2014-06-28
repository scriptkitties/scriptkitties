<script>
	$("#img-update").change(function() {
		if(this.checked) {
			$("#file").prop('disabled', false);
		} else {
			$("#file").prop('disabled', true);
		}
	});
</script>
