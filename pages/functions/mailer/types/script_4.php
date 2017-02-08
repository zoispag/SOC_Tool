<div id="script_4" style="visibility:hidden">
    
    <script src="../js/js-paste-image.js"></script>
    
    <script> 
        var encoded_agama;
        var encoded_attach;
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
        
        // Άνοιγμα modal για Agama
        $("#modal_force_open_agama").click(function(){
            $("#agama_canvas").load("./functions/iptvperdslam.php?&probeRequest="+$("#txt_dslam").val());
        });
        
        /*$("#add_agama").click(function(){
            var node = document.getElementById("agama_canvas");
            domtoimage.toPng(node)
                .then(function (dataUrl) {
                    var img = new Image();
                    img.src = dataUrl;
                    document.body.appendChild(img);
                })
                .catch(function (error) {
                    console.error('sth went wrong: ',error);
                });
        });*/
    
        $("#clear-editor-box-agama").click(function() {
            $("#editor-box-agama").attr('style','background-image:none;');
        });
        
        // Κλείσιμο modal για Agama
        $("#modal_force_close_agama").click(function(){
            var scrap_img = $("#editor-box-agama").css('background-image');
            encoded_agama = btoa(scrap_img);
            //alert(encoded_agama);
        });
        
        // Άνοιγμα modal για Attachment
        $("#modal_force_open_attach").click(function(){
            //
        });
    
        $("#clear-editor-box").click(function() {
            $("#editor-box").attr('style','background-image:none;');
        });
        
        // Κλείσιμο modal για Attachment
        $("#modal_force_close_attach").click(function(){
            var scrap_img = $("#editor-box").css('background-image');
            encoded_attach = btoa(scrap_img);
            //alert(encoded_attach);
        });
        
        // Άνοιγμα modal preview mail
        $("#modal_force_open_4").click(function(){
            var _comment = encodeURI($("#txt_comment").val());
            var _date = encodeURI($("#txt_created").val());
            
            $("#container_modal").load("./functions/mailer/is/type_4_preview.php?txt_comment="+_comment+"&txt_created="+_date, {txt_sr: $("#txt_sr").val(), txt_dslam: $("#txt_dslam").val(), txt_ems: $("#txt_ems").val(), type_fault: $("#type_fault").val(), type_receivers: $("#type_receivers").val(), img_agama: encoded_agama, img_str: encoded_attach});
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
           
            $("#container").load("./functions/mailer/is/type_4_send.php?txt_comment="+_comment+"&txt_created="+_date, {txt_sr: $("#txt_sr").val(), txt_dslam: $("#txt_dslam").val(), txt_ems: $("#txt_ems").val(), type_fault: $("#type_fault").val(), type_receivers: $("#type_receivers").val(), img_agama: encoded_agama, img_str: encoded_attach});
            $("#container-sql").load("./functions/mailer/is/type_4_db.php", {txt_sr: $("#txt_sr").val(), type_fault: $("#type_fault").val(), txt_element: $("#txt_ems").val()});
           
            //alert(encoded_agama);
            //alert(encoded_attach);
        }); 
        
		$('[data-toggle="tooltip"]').tooltip();
        
    </script>
</div>