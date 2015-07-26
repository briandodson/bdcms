<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="css/main.css" media="screen, projection" />
<script type="text/javascript" language="javascript" src="js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.bgiframe.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.dimensions.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.tooltip.min.js"></script>
<script type="text/javascript" language="javascript">
	$(function() {
		// category jump controls
		$('#catJump').attr('href','javascript: void(0);').click(function() {
			$('#catJumpOpts').toggle('fast');
		});
		$('#catJumpOptsTop').click(function() {
			$('#catJumpOpts').toggle('fast');
		});
		// tooltips
		$('.tooltip').tooltip();
	});

</script>