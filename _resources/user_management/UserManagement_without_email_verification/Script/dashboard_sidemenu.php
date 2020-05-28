<?php $url=$_SERVER['PHP_SELF']; ?>
<div class="col-sm-3 col-md-3">
            <div class="panel-group" id="accordion" style="margin-bottom: 10px;">
                <div class="panel panel-default">
                    <div class="panel-heading">
					 <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        <h4 class="panel-title">
                           <span class="glyphicon ">
						   <i class="fa fa-bars"></i>
                            </span>Menu
                        </h4>
						</a>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <table class="table">
                                <tr >
                                    <td <?php if((strpos($url,'dashboard')!=false)) echo "class='active'";?>>
                                    <i class="fa fa-dashboard"></i>    <a href="dashboard.php">DASHBOARD</a>
                                    </td>
                                </tr>
                                 <tr >
                                    <td  <?php if((strpos($url,'profile')!=false)) echo "class='active'";?>">
                                      <i class="fa fa-pencil-square-o"></i>    <a href="profile.php">PROFILE</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td  <?php if((strpos($url,'password')!=false)) echo "class='active'";?>">
                                     <i class="fa fa-key"></i>   <a href="changepassword.php">CHANGE PASSWORD</a>
                                    </td>
                                </tr>
                                
                                 
                                
                                <tr>
                                    <td>
                                      <a href="logout.php" id="login-btn" class="btn btn-danger"> <i class="fa fa-power-off"></i>  Logout</a>

                                    </td>
                                </tr>
                              
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        