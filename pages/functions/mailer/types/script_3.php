<div id="script_3" style="visibility:hidden">
    <script>
        $("#validate_dslam").click(function(){
            $.get("./functions/mailer/vpu/escalate-ems.php?val="+$("#txt_dslam").val(), function(result) {
                $("#txt_ems").val(result);
                $("#txt_ems").prop('disabled',false);
            });
        });

        $("#txt_dslam").keypress(function(e){
            if(e.keyCode==13)
                $("#validate_dslam").click();
        });
        
        $("#txt_sr").keydown(function (e) {
            // Επιτρέπει: backspace, delete, tab & -, -
            if ($.inArray(e.which, [46, 8, 9, 27, 109, 189]) !== -1 ||
                // Επιτρέπει Ctrl+A, Ctrl+C, Ctrl+X & Ctrl+V
                (e.ctrlKey === true && (e.which == 65 || e.which == 67 || e.which == 88 || e.which == 86)) || 
                // Επιτρέπει: home, end, left, right
                (e.which >= 35 && e.which <= 39))
            { return; }
            // Κόβει όλα τα υπόλοιπα
            if ((e.shiftKey || (e.which < 48 || e.which > 57)) && (e.which < 96 || e.which > 105) || e.which == 109 || e.which == 189) {
                e.preventDefault();
            }
        });

        $("#txt_dslam").keydown(function (e) {
            // Επιτρέπει: backspace, delete, tab & Enter
            if ($.inArray(e.which, [46, 8, 9, 27, 13]) !== -1 ||
                // Επιτρέπει Ctrl+A, Ctrl+C, Ctrl+X & Ctrl+V
                (e.ctrlKey === true && (e.which == 65 || e.which == 67 || e.which == 88 || e.which == 86)) || 
                // Επιτρέπει: home, end, left, right
                (e.which >= 35 && e.which <= 39))
            { return; }
            // Κόβει όλα τα υπόλοιπα
            if ((e.shiftKey || (e.which < 48 || e.which > 57)) && (e.which < 96 || e.which > 105) || e.which == 13) {
                e.preventDefault();
            }
        });
        
        // Άνοιγμα modal preview mail
        $("#modal_force_open_3").click(function(){
            var _comment = encodeURI($("#txt_comment").val());
            var _date = encodeURI($("#txt_created").val());
            
            $("#container_modal").load("./functions/mailer/is/type_3_preview.php?txt_comment="+_comment+"&txt_created="+_date, {txt_sr: $("#txt_sr").val(), txt_dslam: $("#txt_dslam").val(), txt_ems: $("#txt_ems").val(), txt_slot: $("#txt_slot").val(), type_fault: $("#type_fault").val(), type_receivers: $("#type_receivers").val(), txt_more_than_one: $("#txt_more_than_one").is(':checked') ?1 : 0 });
            $('#send_mail').prop('disabled', false);
        });

        // Κλείσιμο modal
        $("#modal_force_close").click(function(){
            $("#container_modal").clear();
        });
        
        
        // Mail
       $("#send_mail").click(function(){
            var _comment = encodeURI($("#txt_comment").val());
            var _date = encodeURI($("#txt_created").val());
           
            $("#container").load("./functions/mailer/is/type_3_send.php?txt_comment="+_comment+"&txt_created="+_date, {txt_sr: $("#txt_sr").val(), txt_dslam: $("#txt_dslam").val(), txt_ems: $("#txt_ems").val(), txt_slot: $("#txt_slot").val(), type_fault: $("#type_fault").val(), type_receivers: $("#type_receivers").val(), txt_more_than_one: $("#txt_more_than_one").is(':checked') ?1 : 0 });
            $("#container-sql").load("./functions/mailer/is/type_3_db.php", {txt_sr: $("#txt_sr").val(), txt_slot: $("#txt_slot").val(), txt_element: $("#txt_ems").val()});
        }); 
    </script>
</div>