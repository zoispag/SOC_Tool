<div id="type_4" style="visibility:hidden">
    
    <style>
        @media (min-width:768px){
            .modal-xl {
                width:99%;
                max-width: 930px;
            }
        }
        
        div#editor-box-agama {
          border: 2px dashed #7f7f7f;
          text-align: center;
          vertical-align: middle;
          padding: 100px 10px 10px 10px;
          line-height: 10px;
          max-height: 100px;
          max-width: 100%;
        }

        div#editor-box-agama > img {
          max-width: 100%;
          max-height: 100%;
        }
    </style>
    
    <table class="table">
        <tr>
            <td>
                <label for="type_receivers">Παραλήπτες</label>
            </td>
            <td>
                <select class="type_4_mail" require="true" name="type_receivers" id="type_receivers">
                    <option disabled selected>--------------------</option>
                    <option class="faults_rec" value="athina">&bull; Αθήνα [to: NMC-Data/IP]</option>
                    <option class="faults_rec" value="thess">&bull; Θεσσαλονίκη [to: NCC-thess-Data/IP cc: NMC-Data/IP;]</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <label for="type_fault">Σύμπτωμα βλαβών</label>
            </td>
            <td>
                <select class="type_4_mail" style="width:250px" require="true" name="type_fault" id="type_fault">
                    <option disabled selected>--------------------</option>
                    <option value="1">&bull; Σπασίματα εικόνας/ήχου</option>
                    <option value="2">&bull; No DHCP answer</option>
                    <option value="3">&bull; Μαύρη εικόνα</option>
                    <option value="4">&bull; Αδυναμία προβολής καναλιού</option>
                    <option value="5">&bull; Πρόβλημα Replay TV</option>
                    <option value="6">&bull; Άλλο</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <label for="txt_dslam">DSLAM Code</label>
            </td>
            <td>
                <input class="type_4_mail req_field" style="width:250px" type="text" name="txt_dslam" id="txt_dslam" maxlength="5"> <img src="./images/validate.png" alt="validate" width="18" id="validate_dslam">
            </td>
        </tr>
        <tr>
            <td>
                <label for="txt_ems">EMS Name</label>
            </td>
            <td>
                <input disabled class="type_4_mail" style="width:250px; font-size:10px;" type="text" name="txt_ems" id="txt_ems" maxlength="100">
            </td>
        </tr>
        <tr>
            <td>
                <label for="txt_sr">Siebel SR για Remote Support</label>
            </td>
            <td>
                <input style="width:250px" class="type_4_mail" placeholder="1-1xxxxxxxxxx" type="text" name="txt_sr" id="txt_sr" >
            </td>
        </tr>
        <tr>
            <td>
                <label for="txt_created">Created Date/Time</label>
            </td>
            <td>
                <input class="type_4_mail" style="width:250px;" type="text" name="txt_created" id="txt_created" maxlength="100">
            </td>
        </tr>
        <tr>
            <td>
                <label for="txt_comment">Σχόλια<br /><small><small style="font-style:italic">(Free-text)</small></small></label>
            </td>
            <td>
                <textarea style="width:250px; height:130px" type="text" name="txt_comment" id="txt_comment" size="500"></textarea>
            </td>
        </tr>
        <tr>
            <td>
                <label>Image Attachments</label>
            </td>
            <td>
                <button type="button" id="modal_force_open_agama" class="btn btn-md btn-success" data-toggle="modal" data-target="#myModal_agama">
                    Agama Graphs &nbsp;&nbsp;<i class="fa fa-desktop fa-fw"></i>
                </button>
                <button type="button" id="modal_force_open_attach" class="btn btn-md btn-success" data-toggle="modal" data-target="#myModal_attach">
                    <i class="fa fa-image fa-fw"></i> &nbsp;&nbsp;Custom Attachment
                </button>
            </td>
        </tr>
        <tr>
            <td>
                <button type="button" id="modal_force_open_4" class="btn btn-s btn-outline btn-danger" data-toggle="modal" data-target="#myModal_4">
                    <i class="fa fa-envelope fa-fw"></i> Mail Preview
                </button>
                <button type="button" id="send_mail" class="btn btn-s btn-outline btn-primary">
                    Αποστολή Mail <i class="fa fa-envelope fa-fw"></i>
                </button>
            </td>
            <td>
                <div id="container"</div>
            </td>
        </tr>
    </table>
    <div id="container-sql"></div>

    <!-- Modal -->
    <div class="modal fade" id="myModal_4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Mail Preview</h4>
                </div>
                <div class="modal-body">
                    <div id="container_modal"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="modal_force_close" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    
    <!-- Modal -->
    <div class="modal fade" id="myModal_agama" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Agama Preview</h4>
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="left" title="Απαιτείται login στο Agama για την προβολή των γραφημάτων «on hover»">
                            <a href="http://172.28.128.106:8800/" target="_blank">
                                Agama Login <i class="glyphicon glyphicon-log-in"></i>
                            </a>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div id="agama_canvas"></div><br />
                    <div class="alert alert-info">
                        Copy image and Paste bellow using <strong>Control+V</strong>.<br><i>Hint: You can use Windows Snipping Tool or Paint.</i>
                    </div>
                    <div id="editor-box-agama" class="target" contenteditable="false"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="clear-editor-box-agama" class="btn btn-danger">Clear</button>
                    <button type="button" id="modal_force_close_agama" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    
    <!-- Modal -->
    <div class="modal fade" id="myModal_attach" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Agama Preview</h4>
                </div>
                <div class="modal-body">
                    <center><small></small>Control+v to paste.</small></center>
					<div id="editor-box" class="target" contenteditable="false"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="clear-editor-box" class="btn btn-danger">Clear</button>
                    <button type="button" id="modal_force_close_attach" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

</div>