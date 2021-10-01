<script src="<?php echo URL_ROOT; ?>/vendors/jQuery-3.3.1/jquery-3.3.1.min.js"></script>
<script src="<?php echo URL_ROOT; ?>/vendors/bootstrap4/bootstrap.min.js"></script>

<script>
	$(document).ready(function(){
		$('#birth-date').mask('00/00/0000');
		$('#phone-number').mask('0000-0000');
	});

	function togglePassword(e){
		if($(e).is(':checked')){
			$(".password").attr("type","text");
			$("#toggleText").text("hide password");
	  	}else{
			$(".password").attr("type","password");
			$("#toggleText").text("show password");
		}
	}

	function isNumberKey(evt){
	    var charCode = (evt.which) ? evt.which : evt.keyCode
	    if (charCode > 31 && (charCode < 48 || charCode > 57))
	        return false;
	    return true;
	}
</script>
</body>
</html>