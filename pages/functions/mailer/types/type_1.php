<div id="type_1" style="visibility:hidden">
    <table class="table">
        <tr>
            <td>
                <label for="type_receivers">Παραλήπτες</label>
            </td>
            <td>
                <select class="type_1_mail" require="true" name="type_receivers" id="type_receivers">
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
                <select class="type_1_mail" style="width:250px" require="true" name="type_fault" id="type_fault">
                    <option disabled selected>--------------------</option>
                    <option value="1">&bull; Modem δε συγχρονίζει</option>
                    <option value="2">&bull; Συγχρονίζει αλλά δεν παίρνει IP</option>
                    <option value="3">&bull; Συχνές αποσυνδέσεις</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <label for="txt_more_than_one">Πλήθος βλαβών που εκκρεμούν</label>
            </td>
            <td>
                <input class="type_1_mail" id="txt_more_than_one" type="checkbox" value="1" checked> Περισσότερες από 1
            </td>
        </tr>
        <tr>
            <td>
                <label for="txt_dslam">DSLAM Code</label>
            </td>
            <td>
                <input class="type_1_mail req_field" style="width:250px" type="text" name="txt_dslam" id="txt_dslam" maxlength="5"> <img src="./images/validate.png" alt="validate" width="18" id="validate_dslam">
            </td>
        </tr>
        <tr>
            <td>
                <label for="txt_ems">EMS Name</label>
            </td>
            <td>
                <input disabled class="type_1_mail" style="width:250px; font-size:10px;" type="text" name="txt_ems" id="txt_ems" maxlength="100">
            </td>
        </tr>
        <tr>
            <td>
                <label for="txt_sr">Siebel SR για Remote Support</label>
            </td>
            <td>
                <input style="width:250px" class="type_1_mail" placeholder="1-1xxxxxxxxxx" type="text" name="txt_sr" id="txt_sr" >
            </td>
        </tr>
        <tr>
            <td>
                <label for="txt_created">Created Date/Time</label>
            </td>
            <td>
                <input class="type_1_mail" style="width:250px;" type="text" name="txt_created" id="txt_created" maxlength="100">
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
                <button type="button" id="modal_force_open_1" class="btn btn-s btn-outline btn-danger" data-toggle="modal" data-target="#myModal_1">
                    <i class="fa fa-envelope fa-fw"></i> Mail Preview
                </button>
                <button disabled type="button" id="send_mail" class="btn btn-s btn-outline btn-primary">
                    Αποστολή Mail <i class="fa fa-envelope fa-fw"></i>
                </button>
            </td>
            <td>
                <div id="container"></div>
            </td>
        </tr>
    </table>
    <div id="container-sql"></div>

    <!-- Modal -->
    <div class="modal fade" id="myModal_1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog model-lg">
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

</div>