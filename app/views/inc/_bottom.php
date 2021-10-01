<!-- BOTTOM -->

</div></main>
<!-- Footer -->
<!-- Footer -->
</div></div></div>

<script src="<?php echo URL_ROOT; ?>/vendors/js/vendor.bundle.base.js"></script>
<script src="<?php echo URL_ROOT; ?>/assets/js/material.js"></script>
<script src="<?php echo URL_ROOT; ?>/assets/js/misc.js"></script>
<!-- <script src="<?php echo URL_ROOT; ?>/assets/js/dashboard.js"></script> -->

<script src="<?php echo URL_ROOT; ?>/vendors/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>

<script>
    
    $(document).ready(function(){
        //Snackbar
        var snackbar = document.getElementById("snackbar");
        if (snackbar) {
        	snackbar.className = "show";
            setTimeout(function(){ snackbar.className = snackbar.className.replace("show", ""); }, 3000);
        }
    });

    function logout(){
        window.location = '<?php echo URL_ROOT; ?>/auth/logout';
    }

    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    function toggleSwitch(e, falseText, trueText){
    	let label = $("#labelSwitch");
        if($(e).is(':checked')){
            label.text(trueText);
        }else{
            label.text(falseText);
        }
    }
        
</script>
</body>
</html>
<!-- BOTTOM