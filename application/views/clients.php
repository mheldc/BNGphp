<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
        <div class="container">
            <h3 class=""> Client Accounts </h3>
            <hr>
            <!-- Button trigger modal -->
            <button id="btncreate" type="button" class="btn btn-default" data-toggle="modal" data-target="#clientInfoModal">
                <i class="fa fa-edit"></i> Create an Account
            </button>
            <div class="col-sm-3 col-md-3 pull-right">
                <div class="input-group">
                    <input id="txtsearch" type="text" class="form-control" placeholder="Search">
                    <div class="input-group-btn">
                        <button id="clientsearch" class="btn btn-default"><i class="fa fa-search"></i> Find</button>
                    </div>
                </div>
            </div>
            <br>
            <div id="alertholdermain"></div>
            <hr>
            <div class="container-fluid">
                <table id="tblclient" class="table table-responsive table-hover" border ="0">
                    <thead style="background-color: rgb(224,224,224); font-size: 14px; font-weight: bolder;">
                        <tr>
                            <td style="width: 250px;">Reference No.</td>
                            <td style="text-align: left;">Account Name</td>
                            <td style="width: 70px; text-align: center;">Contacts</td>
                            <td style="width: 70px; text-align: center;">Edit</td>
                            <td style="width: 70px; text-align: center;">Delete</td>
                        </tr>
                    </thead>                     
                    <tbody id="tblcontent">
                    </tbody>
                    <tfoot style="background-color: rgb(224,224,224); font-size: 14px; font-weight: bolder;">
                        <tr>
                            <td id="rowcount" colspan="5">Total # of Records : 0</td>
                        </tr>
                    </tfoot>   
                </table>
            </div>
            <!-- Modal Accounts -->
            <div class="modal fade" id="clientInfoModal" tabindex="-1" role="dialog" aria-labelledby="clientModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="clientModalLabel">
                                <i class="fa fa-edit fa-lg"></i> Account Information
                            </h4>
                        </div>
                        <div class="modal-body">
                            
                            <form class="form-horizontal" role="form">
                                <div class="row">
                                    <div id="alertholder"></div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="acctname" class="col-md-3 control-label">Account Name:</label>
                                        <div class="col-md-8">
                                          <input type="text" class=" form-control" id="acctname" placeholder="Account Name" value="">
                                        </div>
                                    </div>                                                          
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="address" class="col-md-3 control-label">Address:</label>
                                        <div class="col-md-8">
                                          <input type="text" class=" form-control" id="address1" placeholder="Street Address">
                                        </div>
                                    </div>                                                          
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="address2" class="col-md-3 control-label">&nbsp;</label>
                                        <div class="col-md-8">
                                          <input type="text" class=" form-control" id="address2" placeholder="Brgy./Village/Subdivision">
                                        </div>
                                    </div>                                                          
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="city" class="col-md-3 control-label">City:</label>
                                        <div class="col-md-8">
                                          <input type="text" class=" form-control" id="city" placeholder="City">
                                        </div>
                                    </div>                                                          
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="province" class="col-md-3 control-label">Province:</label>
                                        <div class="col-md-8">
                                          <input type="text" class=" form-control" id="province" placeholder="Province">
                                        </div>
                                    </div>                                                          
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="province" class="col-md-3 control-label">Zip Code:</label>
                                        <div class="col-md-3">
                                          <input type="text" class=" form-control" maxlength="5" id="zipcode" placeholder="Zip Code">
                                        </div>
                                    </div>                                                          
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button id="btnsave" type="button" class="btn btn-default">
                                <i class="fa fa-save fa-2x"></i> Save changes
                            </button>                            
                            <button id="btnclose" type="button" class="btn btn-default" data-dismiss="modal">
                                <i class="fa fa-close fa-2x"></i> Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="hOps" value="-1">
        <div id="rcontainer"></div>
    