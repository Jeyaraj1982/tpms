<?php include_once("../config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Admin Login</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="../assets/img/icon.ico" type="image/x-icon" />
    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
    <script src="../assets/js/app.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: ['../assets/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/atlantis.min.css">
    <link rel="stylesheet" href="../assets/css/demo.css">
</head>
<style>
    .sub-header {
        padding: 5px;
        margin-bottom: 15px;
        background-color: transparent;
        border-bottom: 1px solid #ebecec !important;
    }
    .errorstring {
        color: red;
    }
</style>
<?php
 if (isset($_SESSION['User']) && $_SESSION['User']['AdminID']>0) {
    echo "<script>location.href='dashboard.php';</script>";
} 
if (isset($_POST['btnLogin'])) {
    $d=$mysql->select("select * from `_tbl_admin` where `UserName`='".$_POST['UserName']."' and `UserPassword`='".$_POST['Password']."'");
    if (sizeof($d)>0) {
          $_SESSION['User']=$d[0];
          echo "<script>location.href='dashboard.php';</script>";
    } else {
        $error = "invalid username or password";
    }
}
?>                         
<body>
    <div class="main-panel" style="width:100% !important">
        <div class="content" style="margin-top:0px;">
        <br><br><br><br><br><br><br>
            <div class="page-inner" style="width:600px;margin:0px auto">
                <script>
                    function submitLogin() {

                        $('#ErrUserName').html("");
                        $('#ErrPassword').html("");

                        ErrorCount = 0;

                        IsNonEmpty("UserName", "ErrUserName", "Please Enter Valid UserName");
                        IsNonEmpty("Password", "ErrPassword", "Please Enter Valid Password");

                        if (ErrorCount == 0) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                </script>
                <div class="row">
                    <div class="col-md-12" style="">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Admin Login</div>
                            </div>
                            <div class="card-body" style="padding-bottom:0px">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form method="post" action="index.php" onsubmit="return submitLogin()">
                                            <div class="form-group form-inline">
                                                <label for="CustomerCode" class="col-sm-4">User Name</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="UserName" name="UserName" value="<?php echo (isset($_POST['UserName'])) ? $_POST['UserName'] : '';?>" placeholder="Enter UserName" style="width:100%">
                                                    <span class="errorstring" id="ErrUserName"><?php echo isset($ErrUserName)? $ErrUserName : "";?></span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline" style="padding-top:0px">
                                                <label for="CustomerName" class="col-sm-4">Password</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" id="Password" name="Password"  value="<?php echo (isset($_POST['Password'])) ? $_POST['Password'] : '';?>" placeholder="Enter Password" style="width:100%">
                                                    <span class="errorstring" id="ErrPassword"><?php echo isset($ErrPassword)? $ErrPassword : "";?></span>
                                                </div>
                                            </div>
                                            <div class="card-action" style="text-align:right;margin-top: 20px;">
                                              <span class="errorstring"><?php echo $error;?></span>&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-success" type="submit" name="btnLogin">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     
    <script src="../assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../ssets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
    <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="../assets/js/atlantis.min.js"></script>
    <script src="../assets/js/setting-demo2.js"></script>
</body>

</html>