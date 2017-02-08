<div class="row">
                        
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-bell fa-fw"></i> Notifications
        </div>
        <div class="panel-body">
            <div class="list-group">
                <a href="#" class="list-group-item">
                    <i class="fa fa-comment fa-fw"></i> New Comment
                    <span class="pull-right text-muted small"><em>4 minutes ago</em>
                    </span>
                </a>
                <a href="#" class="list-group-item">
                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                    <span class="pull-right text-muted small"><em>12 minutes ago</em>
                    </span>
                </a>
                <a href="#" class="list-group-item">
                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                    <span class="pull-right text-muted small"><em>27 minutes ago</em>
                    </span>
                </a>
                <a href="#" class="list-group-item">
                    <i class="fa fa-tasks fa-fw"></i> New Task
                    <span class="pull-right text-muted small"><em>43 minutes ago</em>
                    </span>
                </a>
                <a href="#" class="list-group-item">
                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                    <?php $data = shell_exec('net stats srv');
                    $data = substr($data,0,strpos($data,"Sessions"));
                    $data = substr($data,strpos($data,"since")+6,strlen($data));?>
                    <span class="pull-right text-muted small"><em><?= $data ?></em>
                    </span>
                </a>
                <a href="#" class="list-group-item">
                    <i class="fa fa-bolt fa-fw"></i> Server Crashed!
                    <span class="pull-right text-muted small"><em>11:13 AM</em>
                    </span>
                </a>
                <a href="#" class="list-group-item">
                    <i class="fa fa-warning fa-fw"></i> Server Not Responding
                    <span class="pull-right text-muted small"><em>10:57 AM</em>
                    </span>
                </a>
                <a href="#" class="list-group-item">
                    <i class="fa fa-shopping-cart fa-fw"></i> New Order Placed
                    <span class="pull-right text-muted small"><em>9:49 AM</em>
                    </span>
                </a>
                <a href="#" class="list-group-item">
                    <i class="fa fa-money fa-fw"></i> Payment Received
                    <span class="pull-right text-muted small"><em>Yesterday</em>
                    </span>
                </a>
            </div>
            <a href="#" class="btn btn-default btn-block">View All Alerts</a>
        </div>
    </div>
</div>