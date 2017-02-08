<!DOCTYPE html>
<html lang="en">
    
<?php $loc='Calendar'; ?>
    
<?php include 'header.php'?>

<body>

    <div id="wrapper">

		<?php include 'nav.php'?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">

                        <div class="pull-right form-inline">
                            <div class="btn-group">
                                <button class="btn btn-primary" data-calendar-nav="prev"><< Prev</button>
                                <button class="btn btn-default" data-calendar-nav="today">Today</button>
                                <button class="btn btn-primary" data-calendar-nav="next">Next >></button>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-warning" data-calendar-view="year">Year</button>
                                <button class="btn btn-warning active" data-calendar-view="month">Month</button>
                                <button class="btn btn-warning" data-calendar-view="week">Week</button>
                                <button class="btn btn-warning" data-calendar-view="day">Day</button>
                            </div>
                        </div>

                        <h3></h3>
                        <small>To see example with events navigate to march 2013</small>
                    </div>

                    <div class="row">
                        <div class="col-md-9">
                            <div id="calendar"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <select id="first_day" class="form-control">
                                    <option value="" selected="selected">First day of week language-dependant</option>
                                    <option value="2">First day of week is Sunday</option>
                                    <option value="1">First day of week is Monday</option>
                                </select>
                                
                                <label class="checkbox">
                                    <input type="checkbox" value="#events-modal" id="events-in-modal"> Open events in modal window
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" id="format-12-hours"> 12 Hour format
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" id="show_wb" checked> Show week box
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" id="show_wbn" checked> Show week box number
                                </label>
                            </div>

                            <h4>Events</h4>
                            <small>This list is populated with events dynamically</small>
                            <ul id="eventlist" class="nav nav-list"></ul>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <br><br>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            

            <div class="modal fade" id="events-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="modal-title">Event</h3>
                        </div>
                        <div class="modal-body" style="height: 400px">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    
    <!-- Calendar Dependent JavaScript Plugins -->
	<script type="text/javascript" src="../bower_components/jquery/dist/underscore/underscore-min.js"></script>
	<script type="text/javascript" src="../bower_components/jquery/dist/jstimezonedetect/jstz.min.js"></script>
    <script type="text/javascript" src="../bower_components/jquery/dist/cal/calendar.js"></script>
	<script type="text/javascript" src="../bower_components/jquery/dist/cal/app.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>