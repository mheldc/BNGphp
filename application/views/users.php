<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <div class="container">
        <div class="col-sm-3 col-xs-3 col-md-3 pull-right">
            <div class="input-group">
                <input id="usearch" type="text" class="form-control" placeholder="Search" name="q" id="txtsearch">
                <span class="input-group-btn">
                    <button class="btn btn-default" id="btnsearch"><i class="fa fa-search fa-lg"></i></button>
                </span>
            </div>
        </div>
        <br /><br /><br />
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#duseracct">User Account</a></li>
            <li><a data-toggle="tab" href="#duserprofile">User Profile</a></li>
            <li><a data-toggle="tab" href="#daccesssettings">Access Rights</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="duseracct">
                <br /><br />
                <div class="form-horizontal" role="form">
                    <div class="row">
                        <div class="form-group">
                            <label for="uname" class="control-label col-md-2">Username</label>
                            <div class="col-md-4">
                                <input id="uname" type="text" class="form-control"  placeholder="6-8 Alphanumeric characters">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="upwd" class="control-label col-md-2">Password</label>
                            <div class="col-md-4">
                                <input id="upwd" type="password" class="form-control"  placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="ucpwd" class="control-label col-md-2">Confirm Password</label>
                            <div class="col-md-4">
                                <input id="ucpwd" type="password" class="form-control"  placeholder="Confirm Password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="uemail" class="control-label col-md-2">Email Address</label>
                            <div class="col-md-4">
                                <input id="uemail" type="text" class="form-control"  placeholder="Email Address">
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="form-group">
                            <label for="isactive" class="control-label col-md-2">Activated</label>
                            <div class="col-md-4">
                                <b><label id="isactive" class="control-label" id="isactive">Yes</label></b>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
            <div class="tab-pane" id="duserprofile">
                <br /><br />
                <div class="form-horizontal" role="form">
                    <div class="row">
                        <div class="form-group">
                            <label for="fname" class="control-label col-md-2">First Name</label>
                            <div class="col-md-4">
                                <input id="fname" type="text" class="form-control"  placeholder="First Name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="mname" class="control-label col-md-2">Middle Name</label>
                            <div class="col-md-4">
                                <input id="mname" type="text" class="form-control"  placeholder="Middle Name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="lname" class="control-label col-md-2">Last Name</label>
                            <div class="col-md-4">
                                <input id="lname" type="text" class="form-control"  placeholder="Last Name">
                            </div>
                        </div>
                    </div>                   
                </div>
            </div>
            <div class="tab-pane" id="daccesssettings">
                <br /><br />
                <div class="form-horizontal" role="form">
                    <div class="row">
                        <div class="form-group">
                            <label for="selsyslogin" class="control-label col-md-2">System Login</label>
                            <div class="col-md-4">
                                <select id="selsyslogin" class="form-control">
                                    <option value="0">Deny</option>
                                    <option value="1">Allow</option>
                                </select>                        
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="selchangepwd" class="control-label col-md-2">Change Password</label>
                            <div class="col-md-4">
                                <select id="selchangepwd" class="form-control">
                                    <option value="0">Deny</option>
                                    <option value="1">Allow</option>
                                </select>                        
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="selbillnotice" class="control-label col-md-2">Billing Notice</label>
                            <div class="col-md-4">
                                <select id="selbillnotice" class="form-control">
                                    <option value="0">Deny</option>
                                    <option value="1">Allow (Read-Only)</option>
                                    <option value="1">Allow (Read-Write)</option>
                                </select>                        
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="form-group">
                            <label for="selusers" class="control-label col-md-2">User Setup</label>
                            <div class="col-md-4">
                                <select id="selusers" class="form-control">
                                    <option value="0">Deny</option>
                                    <option value="1">Allow (Read-Only)</option>
                                    <option value="1">Allow (Read-Write)</option>
                                </select>                        
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="selclient" class="control-label col-md-2">Client Setup</label>
                            <div class="col-md-4">
                                <select id="selclient" class="form-control">
                                    <option value="0">Deny</option>
                                    <option value="1">Allow (Read-Only)</option>
                                    <option value="1">Allow (Read-Write)</option>
                                </select>                        
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="selccontacts" class="control-label col-md-2">Client Contacts Setup</label>
                            <div class="col-md-4">
                                <select id="selccontacts" class="form-control">
                                    <option value="0">Deny</option>
                                    <option value="1">Allow (Read-Only)</option>
                                    <option value="1">Allow (Read-Write)</option>
                                </select>                        
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="selenotification" class="control-label col-md-2">E-mail Notification Setup</label>
                            <div class="col-md-4">
                                <select id="selenotification" class="form-control">
                                    <option value="0">Deny</option>
                                    <option value="1">Allow (Read-Only)</option>
                                    <option value="1">Allow (Read-Write)</option>
                                </select>                        
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="selsalutations" class="control-label col-md-2">Salutations Setup</label>
                            <div class="col-md-4">
                                <select id="selsalutations" class="form-control">
                                    <option value="0">Deny</option>
                                    <option value="1">Allow (Read-Only)</option>
                                    <option value="1">Allow (Read-Write)</option>
                                </select>                        
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
        <br />
        <div class="row col-md-12" style="bottom: 0;">
            <button id="btnsaveuser" class="btn btn-default">
                <i class="fa fa-save fa-lg"></i> Save
            </button>
            <button id="btncancel" class="btn btn-default">
                <i class="fa fa-close fa-lg"></i> Cancel
            </button>
        </div>
    </div>
