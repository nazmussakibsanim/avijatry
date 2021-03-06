<!DOCTYPE html>
<!--[if lt IE 7]>

<html class="lt-ie9 lt-ie8 lt-ie7" lang="en">

  <![endif]-->
  <!--[if IE 7]>

  <html class="lt-ie9 lt-ie8" lang="en">

    <![endif]-->
    <!--[if IE 8]>

    <html class="lt-ie9" lang="en">

      <![endif]-->
      <!--[if gt IE 8]>
      <!-->

      <html lang="en">

        <!--
<![endif]-->

<head>
        <meta charset="utf-8">
        <title>জুতার ধরন | অভিযাত্রী সুজ</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
       
        <link href="icomoon/style.css" rel="stylesheet">
        <link rel="icon" type="image/ico" href="img/ico/favicon.ico"></link>
      <!--[if lte IE 7]>
      <script src="css/icomoon-font/lte-ie7.js"></script>
      <![endif]-->
      <link href="css/main.css" rel="stylesheet">
      <!-- Important. For Theming change primary-color variable in main.css  -->

</head>
<body>
      <header>
        <a href="#" class="logo">
          <img src="img/Regainers_final.jpg" alt="Logo" />
        </a>
        <div class="btn-group">
          <button class="btn btn-primary">ইউজার</button>
          <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu pull-right">
            <li>
              <a href="#">Edit Profile</a>
            </li>
            <li>
              <a href="#">Account Settings</a>
            </li>
            <li>
              <a href="#">Logout</a>
            </li>
          </ul>
        </div>

      </header>
      <div class="container-fluid">
        <div class="dashboard-container">
          <?php 
          include 'top_nav.php';
          selected('reports');
         ?></div>
        <div class="sub-nav">
          <ul>
            <li>
                <a href="inventory_view.php" class="heading">ইনভেন্টরি</a>
            </li>
            <li>
              <a href="new_staff.php">
                স্টাফ তালিকাভুক্তি
              </a>
            </li>
            <li>
              <a href="new_bank.php">
                ব্যাংক তালিকাভুক্তি
              </a>
            </li>
            <li>
              <a href="new_expenses.php">
                অন্যান্য খরচ তালিকাভুক্তি
              </a>
            </li>
             <li>
              <a href="reports.php">
               মাসিক রিপোর্ট
              </a>
            </li>
            <li>
              <a href="annual_report.php">
                বাৎসরিক রিপোর্ট
              </a>
            </li>
            <li>
              <a href="custom_report.php">
                কাস্টম রিপোর্ট
              </a>
            </li>
          </ul>
        </div> 
        <div class="dashboard-wrapper">

          <div class="left-sidebar">
            <div class="row-fluid">
              <div class="span12">
                <div class="widget">
                  <div class="widget-header">
                    <div class="title">
                      নতুন ব্যাংক এর প্রোফাইল তৈরি করুন 
                      <span class="mini-title">
                        নতুন প্রোফাইলের সাধারণ ফরম
                      </span>
                    </div>
                    <a class="pull-right label" href="inventory_table/banks.php">এডিট</a>
                    
                  </div>
                  <div class="widget-body">
                     <?php 
      $success = 'success';
      if(isset($_GET['msg'])){
        if ($_GET['msg']== $success){
          echo '<p class="msg"><h3>ব্যাংক এর নাম যুক্ত হয়েছে</h3></p>';
        } else{
          echo '<p class="msg"><h3>নামের ঘরটি পূরণ করুন</h3></p>';
        }}else{}
     ?>

                    <form class="form-horizontal no-margin" action="add_new_bank.php" method="post">
                      <div class="control-group">
                        <label class="control-label" for="bank_name">
                          ব্যাংকের নাম
                        </label>
                        <div class="controls controls-row">
                          <input name="bank_name" class="span6" type="text" id="bank_name" onchange="javascript:ifDuplic('bank_name','bank_name','banks');" placeholder="ব্যাংকের নাম দিন">
                          
                        </div>
                      </div>
                      
                      <div class="control-group">
                      <label class="control-label" >
                          অ্যাকাউন্ট নং
                        </label>
                        <div class="controls">
                          <input type="text" name="acc" class="span6"   />
                          <span class="help-inline ">
                            অ্যাকাউন্ট নং দিন
                          </span>
                        </div>
                      </div>
                      
                      

                      
                      
                      
                      <div class="form-actions no-margin">
                        <button type="submit" id="submit" class="btn btn-info pull-right">
                          প্রোফাইল অনুমোদন
                        </button>
                        <div class="clearfix">
                        </div>
                      </div>
                      
                    </form>
                    
                  </div>
                </div>
              </div>

              </div>

            </div>

          </div>
        </div>
        <!--/.fluid-container--> </div>
      <footer>
        <p>&copy; CodeCharley</p>
      </footer>
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.js"></script>
      <script src="js/jquery.scrollUp.js"></script>
      <script src="js/load-image.min.js"></script>
      <script src="js/bootstrap-image-gallery.js"></script>
      <script src="js/bootstrap-image-gallery-main.js"></script>

      <script type="text/javascript">
      //ScrollUp
      $(function () {
        $.scrollUp({
          scrollName: 'scrollUp', // Element ID
          topDistance: '300', // Distance from top before showing element (px)
          topSpeed: 300, // Speed back to top (ms)
          animation: 'fade', // Fade, slide, none
          animationInSpeed: 400, // Animation in speed (ms)
          animationOutSpeed: 400, // Animation out speed (ms)
          scrollText: 'উপরে যান', // Text for element
          activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
        });
      });

      //Tooltip
      $('a').tooltip('hide');
    </script>
     <script type="text/javascript" src="validate_duplicate_ajax.js"></script>
</body>
    </html>