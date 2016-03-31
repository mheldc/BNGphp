<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
    
        <nav class="navbar navbar-default navbar-inverse" style="border-radius: 0px !important;">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>">IPI Bill-Gen</a>
                </div>
                <center>
                    <div class="navbar-collapse collapse" id="navbar-main">
                        <ul class="nav navbar-nav">
                            <li id="lihome"><a href="<?php echo base_url().'billgenerator'; ?>">Home</a></li>
                            <li id="libillnotice" style="display:<?php echo $setlogoutdisplay;?>;"><a href="<?php echo base_url().'billgenerator/billnotice'; ?>">Billing Notice</a></li>
                            <li id="lisettings" style="display:<?php echo $setlogoutdisplay;?>;" class="dropdown">
                                <a id="dsetting" class="dropdown-toggle" data-toggle="dropdown" data-target="#" role="button" aria-haspopup="true" aria-expanded="true">
                                    Setup <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dsetting">
                                    <li id="liusers"><a href="<?php echo base_url().'billgenerator/users';?>">Users</a></li>
                                    <li id="liclients" style="display:<?php echo $setlogoutdisplay;?>;"><a href="<?php echo base_url().'billgenerator/clients'; ?>">Clients</a></li>
                                    <li id="liemail"><a href="#">E-mail Notification</a></li>
                                    <li id="lisalutation"><a href="#">Salutations</a></li>
                                    <!--<li role="separator" class="divider"></li>-->
                                </ul>
                            </li>
                            <li id="liabout"><a href="<?php echo base_url().'billgenerator/about'; ?>">About</a></li>
                        </ul>

                        
                        <div id="signin" class="navbar-form navbar-right" role="search" style="display:<?php echo $setlogindisplay;?> ;">
                            <div class="form-group">
                                <input id="username" type="text" class="form-control" name="username" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <button id="btnsignin" class="btn btn-default">
                                <i class="fa fa-unlock fa-lg"></i> Sign In
                            </button>
                        </div>
                    <!--
                        <div id=signout class="navbar-form navbar-right" role="search" style="display:<?php echo $setlogoutdisplay;?>;">
                            <button id="btnsignout" class="btn btn-default">
                                <i class="fa fa-lock fa-lg"></i> Sign Out <?php echo $uname; ?> 
                            </button>
                        </div>
                    -->
                        <div id="signoutv2" class="navbar-collapse collapse navbar-right" style="display:<?php echo $setlogoutdisplay;?>;">
                            <ul class="nav navbar-nav" style="display:<?php echo $setlogoutdisplay;?>;">
                                <li>
                                    <a id="useraccount" class="dropdown-toggle" data-toggle="dropdown" data-target="#" role="button" aria-haspopup="true" aria-expanded="true">
                                    <?php echo $uname; ?> <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="useraccount">
                                        <li id="lisignout">
                                            <a href="javascript:signout_user();">
                                                <span class="fa-stack fa-lg">
                                                    <i class="fa fa-square-o fa-stack-2x"></i>
                                                    <i class="fa fa-power-off fa-stack-1x"></i>
                                                </span> Sign Out
                                            </a>
                                        </li>
                                        <li id="liprofile">
                                            <a href="#">
                                                <span class="fa-stack fa-lg">
                                                    <i class="fa fa-square-o fa-stack-2x"></i>
                                                    <i class="fa fa-user-secret fa-stack-1x"></i>
                                                </span> Profile
                                            </a>
                                        </li>
                                        <li id="lichangepwd">
                                            <a href="#">
                                                <span class="fa-stack fa-lg">
                                                    <i class="fa fa-square-o fa-stack-2x"></i>
                                                    <i class="fa fa-unlock-alt fa-stack-1x"></i>
                                                </span> Change Password
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
            
                        
<!--                        <ul id="signout" style="visibility: visible;" class="nav navbar-nav navbar-right">
                            <li>
                                <a class="btn btn-default" href="javascript: signoutuser();">
                                    <i class="fa fa-lock fa-lg"></i> Sign Out <?php echo $uname; ?>    
                                </a>
                            </li>
                        </ul>-->
                    </div>
                </center>
            </div>
        </nav>
        
