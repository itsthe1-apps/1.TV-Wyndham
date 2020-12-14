<script type="application/javascript">
$(document).ready(function(){
    var d = "<?=base_url()?>index.php/api/orderreq/type/wakeup/user/42/time/0/date/0/guest/1";
	$.ajax({
            url: d,
            type: "POST",
            success: function(e){
                x=e;
            },
            error :  function(xhr, stat,err){
                x=err;
            }
       });
});
</script>