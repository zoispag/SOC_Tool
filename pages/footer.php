<!-- NiceScroll Custom Script -->
<script src="../js/js-nicescroll.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
        
        $("html").niceScroll({cursorcolor:"grey",cursorwidth:"7px",scrollspeed:"100"});
        
        $("#solvatio_cli").keypress(function(e){
            if(e.keyCode==13)
                $("#solvatio").click();
        });
        
        $("#solvatio").click(function(){
            //alert($("#solvatio_cli").val());
            var url = "https://solvrs1.central-domain.root.ote.gr/helpdesk/advisor?PARAM=&CLI="+$("#solvatio_cli").val();
            window.open(url,'_blank');
        });
	});
</script>