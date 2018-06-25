<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Victory Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?=base_url()?>assets/node_modules/mdi/css/materialdesignicons.min.css" />
  <link rel="stylesheet" href="<?=base_url()?>assets/node_modules/simple-line-icons/css/simple-line-icons.css" />
  <link rel="stylesheet" href="<?=base_url()?>assets/node_modules/flag-icon-css/css/flag-icon.min.css" />
  <link rel="stylesheet" href="<?=base_url()?>assets/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css" />
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="<?=base_url()?>assets/node_modules/bootstrap-datatables/css/dataTables.bootstrap.css" />
  <link rel="stylesheet" href="<?=base_url()?>assets/node_modules/bootstrap/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="<?=base_url()?>assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css" />

  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css" />
  <!-- endinject -->
  <link rel="shortcut icon" href="<?=base_url()?>/assets/images/favicon.png" />

  <!-- End plugin js for this page-->


<script src="<?=base_url()?>assets/node_modules/jquery/dist/jquery.min.js"></script>
<script src="<?=base_url()?>assets/node_modules/popper.js/dist/umd/popper.min.js"></script>
<script src="<?=base_url()?>assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?=base_url()?>assets/node_modules/bootstrap-datatables/js/jquery.dataTables.min.js"></script>
  <script src="<?=base_url()?>assets/node_modules/bootstrap-datatables/js/dataTables.bootstrap.js"></script>
  <script src="http://malsup.github.com/jquery.form.js"></script>
  <script src="<?=base_url()?>assets/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
  <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  var OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "11b61d78-d544-403c-bbe9-3eedcdca28a0",
    });
  });
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

<body class="sidebar-dark">
  <div class="container-scroller">
    <!-- partial:<?=base_url()?>assets/partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="<?=base_url()?>assets/index.html"><img src="<?=base_url()?>assets/images/logo.svg" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="<?=base_url()?>assets/index.html"><img src="<?=base_url()?>assets/images/logo-mini.svg" alt="logo" /></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <!--<ul class="navbar-nav">-->
        <!--  <li class="nav-item dropdown d-none d-lg-flex">-->
        <!--    <a class="nav-link dropdown-toggle nav-btn" id="actionDropdown" href="#" data-toggle="dropdown">-->
        <!--      <span class="btn">+ Create new</span>-->
        <!--    </a>-->
        <!--    <div class="dropdown-menu navbar-dropdown dropdown-left" aria-labelledby="actionDropdown">-->
        <!--      <a class="dropdown-item" href="#">-->
        <!--        <i class="icon-user text-primary"></i>-->
        <!--        User Account-->
        <!--      </a>-->
        <!--      <div class="dropdown-divider"></div>-->
        <!--      <a class="dropdown-item" href="#">-->
        <!--        <i class="icon-user-following text-warning"></i>-->
        <!--        Admin User-->
        <!--      </a>-->
        <!--      <div class="dropdown-divider"></div>-->
        <!--      <a class="dropdown-item" href="#">-->
        <!--        <i class="icon-docs text-success"></i>-->
        <!--        Sales report-->
        <!--      </a>-->
        <!--    </div>-->
        <!--  </li>-->
        <!--</ul>-->
        <ul class="navbar-nav navbar-nav-right">
          <!-- <li class="nav-item dropdown d-none d-lg-flex">
            <a class="nav-link dropdown-toggle" id="languageDropdown" href="#" data-toggle="dropdown">
              <i class="flag-icon flag-icon-gb"></i>
              English
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="languageDropdown">
              <a class="dropdown-item font-weight-medium" href="#">
                <i class="flag-icon flag-icon-fr"></i>
                French
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item font-weight-medium" href="#">
                <i class="flag-icon flag-icon-es"></i>
                Espanol
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item font-weight-medium" href="#">
                <i class="flag-icon flag-icon-lt"></i>
                Latin
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item font-weight-medium" href="#">
                <i class="flag-icon flag-icon-ae"></i>
                Arabic
              </a>
            </div>
          </li> -->
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <a class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 4 new notifications
                </p>
                <span class="badge badge-pill badge-warning float-right">View all</span>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="icon-info mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium">Application Error</h6>
                  <p class="font-weight-light small-text">
                    Just now
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="icon-speech mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium">Settings</h6>
                  <p class="font-weight-light small-text">
                    Private message
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="icon-envelope mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium">New user registration</h6>
                  <p class="font-weight-light small-text">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <!-- <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="icon-envelope mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <div class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 7 unread mails
                </p>
                <span class="badge badge-info badge-pill float-right">View all</span>
              </div>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="./images/faces/face4.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium">David Grey
                    <span class="float-right font-weight-light small-text">1 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    The meeting is cancelled
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="./images/faces/face2.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium">Tim Cook
                    <span class="float-right font-weight-light small-text">15 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    New product launch
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="./images/faces/face3.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium"> Johnson
                    <span class="float-right font-weight-light small-text">18 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    Upcoming board meeting
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-settings d-none d-lg-block">
            <a class="nav-link" href="#">
              <i class="icon-grid"></i>
            </a>
          </li> -->
        </ul>
   
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="row row-offcanvas row-offcanvas-right">
        <!-- partial:<?=base_url()?>assets/partials/_settings-panel.html -->
        <div class="theme-setting-wrapper">
          <div id="settings-trigger"><i class="mdi mdi-settings"></i></div>
          <div id="theme-settings" class="settings-panel">
            <i class="settings-close mdi mdi-close"></i>
            <p class="settings-heading">SIDEBAR SKINS</p>
            <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
            <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
            <p class="settings-heading mt-2">HEADER SKINS</p>
            <div class="color-tiles mx-0 px-4">
              <div class="tiles primary"></div>
              <div class="tiles success"></div>
              <div class="tiles warning"></div>
              <div class="tiles danger"></div>
              <div class="tiles pink"></div>
              <div class="tiles info"></div>
              <div class="tiles dark"></div>
              <div class="tiles default"></div>
            </div>
          </div>
        </div>
        <div id="right-sidebar" class="settings-panel">
          <i class="settings-close mdi mdi-close"></i>
          <ul class="nav nav-tabs" id="setting-panel" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
            </li>
          </ul>
          <div class="tab-content" id="setting-content">
            <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
              <div class="add-items d-flex px-3 mb-0">
                <form class="form w-100" />
                  <div class="form-group d-flex">
                    <input type="text" class="form-control todo-list-input" placeholder="Add To-do" />
                    <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                  </div>
                </form>
              </div>
              <div class="list-wrapper px-3">
                <ul class="d-flex flex-column-reverse todo-list">
                  <li>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox" />
                        Team review meeting at 3.00 PM
                      </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                  <li>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox" />
                        Prepare for presentation
                      </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                  <li>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox" />
                        Resolve all the low priority tickets due today
                      </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                  <li class="completed">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox" checked="" />
                        Schedule meeting for next week
                      </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                  <li class="completed">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox" checked="" />
                        Project review
                      </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                </ul>
              </div>
              <div class="events py-4 border-bottom px-3">
                <div class="wrapper d-flex mb-2">
                  <i class="mdi mdi-circle-outline text-primary mr-2"></i>
                  <span>Feb 11 2018</span>
                </div>
                <p class="mb-0 font-weight-thin text-gray">Creating component page</p>
                <p class="text-gray mb-0">build a js based app</p>
              </div>
              <div class="events pt-4 px-3">
                <div class="wrapper d-flex mb-2">
                  <i class="mdi mdi-circle-outline text-primary mr-2"></i>
                  <span>Feb 7 2018</span>
                </div>
                <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
                <p class="text-gray mb-0 ">Call Sarah Graves</p>
              </div>
            </div>
            <!-- To do section tab ends -->
            <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
              <div class="d-flex align-items-center justify-content-between border-bottom">
                <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
                <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
              </div>
              <ul class="chat-list">
                <li class="list active">
                  <div class="profile"><img src="<?=base_url()?>assets/images/faces/face1.jpg" alt="image" /><span class="online"></span></div>
                  <div class="info">
                    <p>Thomas Douglas</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">19 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="<?=base_url()?>assets/images/faces/face2.jpg" alt="image" /><span class="offline"></span></div>
                  <div class="info">
                    <div class="wrapper d-flex">
                      <p>Catherine</p>
                    </div>
                    <p>Away</p>
                  </div>
                  <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                  <small class="text-muted my-auto">23 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="<?=base_url()?>assets/images/faces/face3.jpg" alt="image" /><span class="online"></span></div>
                  <div class="info">
                    <p>Daniel Russell</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">14 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="<?=base_url()?>assets/images/faces/face4.jpg" alt="image" /><span class="offline"></span></div>
                  <div class="info">
                    <p>James Richardson</p>
                    <p>Away</p>
                  </div>
                  <small class="text-muted my-auto">2 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="<?=base_url()?>assets/images/faces/face5.jpg" alt="image" /><span class="online"></span></div>
                  <div class="info">
                    <p>Madeline Kennedy</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">5 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="<?=base_url()?>assets/images/faces/face6.jpg" alt="image" /><span class="online"></span></div>
                  <div class="info">
                    <p>Sarah Graves</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">47 min</small>
                </li>
              </ul>
            </div>
            <!-- chat tab ends -->
          </div>
        </div>
        <!-- partial -->
        <!-- partial:<?=base_url()?>assets/partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <div class="nav-link">
                <div class="profile-image">
                  <img src="<?=base_url()?>assets/images/faces/face10.jpg" alt="image" />
                  <span class="online-status online"></span> <!--change class online to offline or busy as needed-->
                </div>
                <div class="profile-name">
                  <p class="name">
                    Michel Fayad
                  </p>
                  <p class="designation">
                    Super Admin
                  </p>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=base_url()?>dashboard/">
                <i class="icon-rocket menu-icon"></i>
                <span class="menu-title">Dashboard</span>
                <span class="badge badge-success">New</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=base_url()?>user/">
                <i class="icon-user menu-icon"></i>
                <span class="menu-title">User Management</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=base_url()?>company/">
                <i class="icon-people menu-icon"></i>
                <span class="menu-title">Company Management</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=base_url()?>driver/">
                <i class="icon-user-following menu-icon"></i>
                <span class="menu-title">Driver Management</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=base_url()?>productgroup/">
                <i class="icon-folder menu-icon"></i>
                <span class="menu-title">Product Group Management</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=base_url()?>product/">
                <i class="icon-layers menu-icon"></i>
                <span class="menu-title">Product Management</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?=base_url()?>messenger/">
                <i class=" icon-direction menu-icon"></i>
                <span class="menu-title">Messenger Management</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?=base_url()?>order/">
                <i class="icon-basket menu-icon"></i>
                <span class="menu-title">Order Management</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=base_url()?>drivermap/">
                <i class="icon-location-pin menu-icon"></i>
                <span class="menu-title">Driver map</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=base_url()?>admin/">
                <i class=" icon-user-follow menu-icon"></i>
                <span class="menu-title">Admin Management</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=base_url()?>support/">
                <i class=" icon-support menu-icon"></i>
                <span class="menu-title">Support Management</span>
              </a>
            </li>

            <!--<li class="nav-item">-->
            <!--  <a class="nav-link" href="../widgets.html">-->
            <!--    <i class="icon-shield menu-icon"></i>-->
            <!--    <span class="menu-title">Permission</span>-->
            <!--  </a>-->
            <!--</li>-->
            
            <!--<li class="nav-item nav-doc">-->
            <!--  <a class="nav-link bg-primary" href="../documentation.html">-->
            <!--    <i class="icon-logout menu-icon"></i>-->
            <!--    <span class="menu-title">Sign Out</span>-->
            <!--  </a>-->
            <!--</li>-->
            <li class="mt-4 nav-item nav-progress">
              <h6 class="nav-progress-heading mt-4 font-weight-normal">
                Today's Sales
                <span class="nav-progress-sub-heading">
                  50 sold
                </span>
              </h6>
              <div class="progress progress-sm">
                <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <h6 class="nav-progress-heading mt-4 font-weight-normal">
                Customer target
                <span class="nav-progress-sub-heading">
                  500
                </span>
              </h6>
              <div class="progress progress-sm">
                <div class="progress-bar bg-danger" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="content-wrapper">
          <?php
            $this->load->view($view, $data);
          ?>

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:<?=base_url()?>assets/partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018 <a href="#">Marko Dreher</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- row-offcanvas ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->



  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="<?=base_url()?>assets/node_modules/bootstrap-datatables/js/jquery.dataTables.min.js"></script>
  <script src="<?=base_url()?>assets/node_modules/bootstrap-datatables/js/dataTables.bootstrap.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?=base_url()?>assets/js/off-canvas.js"></script>
  <script src="<?=base_url()?>assets/js/hoverable-collapse.js"></script>
  <script src="<?=base_url()?>assets/js/misc.js"></script>
  <script src="<?=base_url()?>assets/js/settings.js"></script>
  <script src="<?=base_url()?>assets/js/todolist.js"></script>
  <script>
    $(".navbar").addClass("navbar-dark");
  </script>
</body>

</html>
