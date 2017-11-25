<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="Hussaine Empire Admin Panel">
  <meta name="author" content="Jerry Shikanga">

  <title>Hussaine Empire Admin</title>

  <link href="<?php echo base_url(); ?>adminassets/assets/css/style.default.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>adminassets/assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/images/icons/icon.png'); ?>" />

  <script src="<?php echo base_url(); ?>adminassets/assets/js/jquery-1.11.1.min.js"></script>
  <script src="<?php echo base_url(); ?>adminassets/assets/js/jquery-migrate-1.2.1.min.js"></script>
  <script src="<?php echo base_url(); ?>adminassets/assets/js/jquery-ui-1.10.3.min.js"></script>
  <script src="<?php echo base_url(); ?>adminassets/assets/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>adminassets/assets/js/modernizr.min.js"></script>
  <script src="<?php echo base_url(); ?>adminassets/assets/js/jquery.sparkline.min.js"></script>
  <script src="<?php echo base_url(); ?>adminassets/assets/js/toggles.min.js"></script>
  <script src="<?php echo base_url(); ?>adminassets/assets/js/retina.min.js"></script>
  <script src="<?php echo base_url(); ?>adminassets/assets/js/jquery.cookies.js"></script>


  <script src="<?php echo base_url(); ?>adminassets/assets/js/custom.js"></script>

  <script src="<?php echo base_url(); ?>adminassets/assets/custom/js/bootbox.min.js"></script>
  <script src="<?php echo base_url(); ?>adminassets/assets/js/bootstrap-datetimepicker.min.js"></script>
  <script src="<?php echo base_url(); ?>adminassets/assets/custom/js/bootstrapValidator.min.js"></script>
  <script src="<?php echo base_url(); ?>adminassets/assets/js/malsup.jquery.form.js"></script>

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body>

<section>

  <div class="leftpanel">

    <div class="logopanel">
        <h1><span>[</span> H.E. <span>]</span></h1>
    </div><!-- logopanel -->

    <div class="leftpanelinner">

      <h5 class="sidebartitle">Navigation</h5>
      <ul class="nav nav-pills nav-stacked nav-bracket">
        <li><a href="<?php echo site_url('admin/index'); ?>"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <li><a href="<?php echo site_url('events/admin/'); ?>"><i class="fa fa-medkit"></i> <span>Events</span></a></li>
        <li><a href="<?php echo site_url('gallery/admin/'); ?>"><i class="fa fa-user-md"></i> <span>Gallery</span></a></li>
        <li><a href="<?php echo site_url('videos/admin/'); ?>"><i class="fa fa-users"></i> <span>Videos</span></a></li>
        <li><a href="<?php echo site_url('about/admin/'); ?>"><i class="fa fa-stethoscope"></i> <span>About</span></a></li>
        <li><a href="<?php echo site_url('contact/admin/'); ?>"><i class="fa fa-user"></i> <span>Contact</span></a></li>
        <li><a href="<?php echo site_url('users/admin/'); ?>"><i class="fa fa-user"></i> <span>Users</span></a></li>
      </ul>
      <div class="infosummary">
        <h5 class="sidebartitle">Users</h5>
        <ul>
            <li>
                <div class="datainfo">
                    <span class="text-muted">Daily Traffic</span>
                    <h4>630, 201</h4>
                </div>
                <div id="sidebar-chart" class="chart"></div>
            </li>
            <li>
                <div class="datainfo">
                    <span class="text-muted">Average Downloads</span>
                    <h4>1, 332, 801</h4>
                </div>
                <div id="sidebar-chart2" class="chart"></div>
            </li>
            <li>
                <div class="datainfo">
                    <span class="text-muted">Average Income</span>
                    <h4>140.05 - 32</h4>
                </div>
                <div id="sidebar-chart4" class="chart"></div>
            </li>
            <li>
                <div class="datainfo">
                    <span class="text-muted">Disk Usage</span>
                    <h4>82.2%</h4>
                </div>
                <div id="sidebar-chart3" class="chart"></div>
            </li>
            <li>
                <div class="datainfo">
                    <span class="text-muted">Memory Usage</span>
                    <h4>32.2%</h4>
                </div>
                <div id="sidebar-chart5" class="chart"></div>
            </li>
        </ul>
      </div><!-- infosummary -->

    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->

  <div class="mainpanel">
    <div class="headerbar">
      <a class="menutoggle"><i class="fa fa-bars"></i></a>
      <div class="header-right">
        <ul class="headermenu">
           <li>
            <div class="btn-group">
              <button class="btn btn-default dropdown-toggle tp-icon" data-toggle="dropdown">
                <i class="glyphicon glyphicon-globe"></i>
                  <span class="badge"><?php echo getUnrepliedQueries()->num_rows(); ?></span>
              </button>
              <div class="dropdown-menu dropdown-menu-head pull-right">
                <h5 class="title">You Have <?php echo getUnrepliedQueries()->num_rows(); ?> New Notifications</h5>
                <ul class="dropdown-list gen-list">
                    <?php foreach (getUnrepliedQueries()->result() as $query) : ?>
                    <li class="new">
                      <a href="#">
                        <span>
                          <span class="name"><span class="badge badge-success"><?=$query->visitor_name?></span></span>
                          <span class="msg"><?=$query->subject?></span>
                        </span>
                      </a>
                    </li>
                    <?php endforeach; ?>
                  <li class="new"><a href="#">See All Notifications</a></li>
                </ul>
              </div>
            </div>
          </li>
          <li>
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                Welcome, <?php echo ucwords($this->session->userdata('logged_in')['name']); ?>
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                <li><a href=""><i class="glyphicon glyphicon-user"></i> My Profile</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-cog"></i> Change Password</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-question-sign"></i> Help</a></li>
                <li><a href="<?php echo base_url();?>users/logout"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </div><!-- header-right -->

    </div><!-- headerbar -->
        
    
    
  
    


    <!-- Content goes here -->
