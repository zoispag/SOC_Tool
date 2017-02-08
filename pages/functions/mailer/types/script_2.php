<div id="script_2" style="visibility:hidden">
    <script>        
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
        
        $("#bras_or_asr").on('change', function() {
           var checkvalue = $("input[name=bras_or_asr]:checked", "#bras_or_asr").val();
            //alert(checkvalue);
            if (checkvalue=='bras'){
                $(".bras").attr("style", "visibility:visible");
                $(".asr").attr("style", "visibility:hidden");
                $(".bras").attr("id", "type_fault");
                $(".asr").removeAttr("id");
            }
            if (checkvalue=='asr'){
                $(".asr").attr("style", "visibility:visible");
                $(".bras").attr("style", "visibility:hidden");
                $(".asr").attr("id", "type_fault");
                $(".bras").removeAttr("id");
            }
            $(".type_selected").attr("style", "visibility:visible");
        });
        
        // Άνοιγμα modal preview mail
        $("#modal_force_open_2").click(function(){
            var _comment = encodeURI($("#txt_comment").val());
            var _date = encodeURI($("#txt_created").val());
            var checkvalue = $("input[name=bras_or_asr]:checked", "#bras_or_asr").val();
            
            $("#container_modal").load("./functions/mailer/is/type_2_preview.php?txt_comment="+_comment+"&txt_created="+_date, {txt_sr: $("#txt_sr").val(), txt_bras: $("#txt_bras").val(), type_fault: $("#type_fault").val(), type_receivers: $("#type_receivers").val(), txt_type: checkvalue ,txt_more_than_one: $("#txt_more_than_one").is(':checked') ?1 : 0 });
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
            var checkvalue = $("input[name=bras_or_asr]:checked", "#bras_or_asr").val();
           
            $("#container").load("./functions/mailer/is/type_2_send.php?txt_comment="+_comment+"&txt_created="+_date, {txt_sr: $("#txt_sr").val(), txt_bras: $("#txt_bras").val(), type_fault: $("#type_fault").val(), type_receivers: $("#type_receivers").val(), txt_type: checkvalue ,txt_more_than_one: $("#txt_more_than_one").is(':checked') ?1 : 0 });
            $("#container-sql").load("./functions/mailer/is/type_2_db.php", {txt_type: checkvalue ,txt_sr: $("#txt_sr").val(), txt_element: $("#txt_bras").val()});
        }); 
    </script>
</div>