<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $asset_url = str_replace('index.php/','assets',base_url());
?>
        <div class="container">
            <h3 id="clientheader"><?php echo $acctname; ?></h3>
            <span>
                <?php
                    echo $addr1 .' '. $addr2 . '<br />'. $city .' '. $zipcode;
                ?>
            </span>
            <hr>
            <!-- Button trigger modal -->
            <button id="btncreate" type="button" class="btn btn-default" data-toggle="modal" data-target="#clientContactModal">
                <i class="fa fa-user-plus"></i> Add a Contact
            </button>
            <div class="col-sm-3 col-md-3 pull-right">
                <div class="input-group">
                    <input id="txtsearch" type="text" class="form-control" placeholder="Search">
                    <div class="input-group-btn">
                        <button id="clientsearch" class="btn btn-default"><i class="fa fa-search"></i> Find</button>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        
        <div class="container">
            <table class="table">
                <thead style="background-color: rgb(224,224,224); font-size: 14px; font-weight: bolder;">
                    <tr>
                        <td style="width: 250px;">Reference No.</td>
                        <td style="text-align: left;">Contact Name</td>
                        <td style="text-align: left;">Job Position</td>
                        <td style="width: 70px; text-align: center;">Edit</td>
                        <td style="width: 70px; text-align: center;">Delete</td>
                    </tr>
                </thead>                     
                <tbody id="tblcontent">
                    <tr><td colspan="5" style="text-align: center; font-size: 14px;"><b>No record(s) found.</b></td></tr>
                </tbody>
                <tfoot style="background-color: rgb(224,224,224); font-size: 14px; font-weight: bolder;">
                    <tr>
                        <td id="rowcount" colspan="5">Total # of Records : 0</td>
                    </tr>
                </tfoot>   
            </table>
        </div>
        <!-- Modal Account Contacts -->
        <div class="modal fade" id="clientContactModal" tabindex="-1" role="dialog" aria-labelledby="clientContactLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="clientContactLabel">
                            <i class="fa fa-edit fa-lg"></i> Contact Information
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form">
                            <div class="row">
                                <div class="form-group">
                                    <label for="honorifics" class="col-md-3 control-label"></label>
                                    <div class="col-md-8">
                                        <div id="alertholdercontact"></div>
                                    </div>
                                </div>                                                          
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="honorifics" class="col-md-3 control-label">Honorifics:</label>
                                    <div class="col-md-8">
                                      <div class="dropdown">
                                            <select class="form-control" id="honorifics">
                                                <option value="0" selected="selected">- Select from list -</option>
                                                <option value="1">Mr.</option>
                                                <option value="2">Ms.</option>
                                                <option value="3">Atty.</option>
                                                <option value="4">Engr.</option>
                                                <option value="5">Dr.</option>
                                                <option value="6">Dra.</option>
                                            </select>
                                      </div>
                                    </div>
                                </div>                                                          
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="firstname" class="col-md-3 control-label">First Name:</label>
                                    <div class="col-md-8">
                                      <input type="text" class=" form-control" id="firstname" placeholder="First Name" value="">
                                    </div>
                                </div>                                                          
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="middlename" class="col-md-3 control-label">Middle Name:</label>
                                    <div class="col-md-8">
                                      <input type="text" class=" form-control" id="middlename" placeholder="Middle Name">
                                    </div>
                                </div>                                                          
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="lastnane" class="col-md-3 control-label">Last Name:</label>
                                    <div class="col-md-8">
                                      <input type="text" class=" form-control" id="lastname" placeholder="Last Name">
                                    </div>
                                </div>                                                          
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="jobpost" class="col-md-3 control-label">Job Position:</label>
                                    <div class="col-md-8">
                                      <input type="text" class=" form-control" id="jobpost" placeholder="Job Position">
                                    </div>
                                </div>                                                          
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="btnsavecontact" type="button" class="btn btn-default">
                            <i class="fa fa-save fa-2x"></i> Save Contact
                        </button>                            
                        <button id="btnclosecontact" type="button" class="btn btn-default" data-dismiss="modal">
                            <i class="fa fa-close fa-2x"></i> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <label id="dOps" style="visibility: hidden;">-1</label>
        <label id="lcid" style="visibility: hidden;">0</label>
        <label id="laid" style="visibility: hidden;"><?php echo $acctid; ?></label>