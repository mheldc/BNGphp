<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
        <div class="container">
            <div id="dAccount">
                <h3> Billing Information </h3>
                <hr/>
                <div class="row">
                    <div class="form-group">
                        <label for="alert" class="col-md-2 control-label"></label>
                        <div class="col-md-4">
                            <div id="alertnotice"></div>
                        </div>
                    </div>                 
                </div>
                <form class="form-horizontal" role="form">       
                    <div class="row">
                        <div class="form-group">
                            <label for="accountid" class="col-md-2 control-label">Account:</label>
                            <div class="col-md-4">
                                <select id="accountid" class="form-control"></select>
                            </div>
                        </div>                                                          
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="clientlocation" class="col-md-2 control-label"></label>
                            <div class="col-md-4">
                                <label id="clientaddr" class="control-label"><em>Client Address</em></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="contactid" class="col-md-2 control-label">Contact:</label>
                            <div class="col-md-4">
                                <select id="contactid" class="form-control"></select>
                            </div>
                        </div>                                                          
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="billperiod" class="col-md-2 control-label">Bill Period:</label>
                            <div class="col-md-4">
                                <div class='input-group date' id='dtfrom'>
                                    <input type='text' class="form-control" id="txtfrom"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>                                                          
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="billperiod" class="col-md-2 control-label"></label>
                            <div class="col-md-4">
                                <div class='input-group date' id='dtto'>
                                    <input type='text' class="form-control" id="txtto"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>                                                          
                    </div>
                </form>
                <div class="row">
                    <div class="form-group">
                        <label for="btnnext" class="col-md-2 control-label"></label>
                        <div class="col-md-4" style="text-align: right;">
                            <button class="btn btn-default" id="btnnext">
                                <i class="fa fa-arrow-circle-right fa-lg"></i> Next
                            </button>
                        </div>
                    </div>                                                          
                </div>                
            </div>
            <br />
            
            <div id="dDetails">
                <h3> Billing Details </h3>
                <hr/>
                <div class="row">
                    <div class="form-group">
                        <label for="alert" class="col-md-2 control-label"></label>
                        <div class="col-md-4">
                            <div id="alertnotice2"></div>
                        </div>
                    </div>                 
                </div>
                <div id="billdetails">
                    <form class="form-horizontal" role="form">
                        <div class="row">
                            <div class="form-group">
                                <label for="lastname" class="col-md-2 control-label">Last Name:</label>
                                <div class="col-md-4">
                                    <input type="text" class=" form-control" id="lastname" placeholder="Last Name" value="">      
                                </div>
                            </div>                                                          
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="firstname" class="col-md-2 control-label">First Name:</label>
                                <div class="col-md-4">
                                    <input type="text" class=" form-control" id="firstname" placeholder="First Name" value="">      
                                </div>
                            </div>                                                          
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="middlename" class="col-md-2 control-label">Middle Name:</label>
                                <div class="col-md-4">
                                    <input type="text" class=" form-control" id="middlename" placeholder="Middle Name" value="">      
                                </div>
                            </div>                                                          
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="jobpost" class="col-md-2 control-label">Job Position:</label>
                                <div class="col-md-4">
                                    <input type="text" class=" form-control" id="jobpost" placeholder="Job Position" value="">      
                                </div>
                            </div>                                                          
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="salaryrate" class="col-md-2 control-label">Salary Rate:</label>
                                <div class="col-md-2">
                                    <input type="text" class=" form-control" style="text-align: right;" id="salaryrate" placeholder="0.00" value="">
                                </div>
                                <div class="col-md-2">
                                    <select id="salarytype" class="form-control">
                                        <option value="0"> Rate Type </option>
                                        <option value="1">Daily</option>
                                        <option value="2">Weekly</option>
                                        <option selected="selected" value="3">Monthly</option>
                                        <option value="4">Yearly</option>
                                    </select>     
                                </div>
                            </div>                                                          
                        </div>
                    </form>
                    <div class="row">
                        <div class="form-group">
                            <label for="btnnext2" class="col-md-2 control-label"></label>
                            <div class="col-md-4" style="text-align: right;">
                                <button class="btn btn-default" id="btnnext2">
                                    <i class="fa fa-arrow-circle-right fa-lg"></i> Next
                                </button>
                            </div>
                        </div>                                                          
                    </div>
                </div>
            </div>
            <br />
            
            <div id="dBillItems">
                <h3> Billed Items </h3>
                <hr/>
                <div class="row">
                    <div class="form-group">
                        <label for="alert" class="col-md-2 control-label"></label>
                        <div class="col-md-4">
                            <div id="alertnotice3"></div>
                        </div>
                    </div>                 
                </div>
                <div role="form">
                    <div class="row">
                        <div class="form-group">
                            <label for="itemdesc" class="col-md-2 control-label">&nbsp;</label>
                            <div class="col-md-3">
                                <input type="text" class=" form-control" id="itemdesc" placeholder="Item Description" value="">                                
                            </div>
                            <div class="col-md-2">
                                <select id="opsid" class="form-control">
                                    <option value="1" selected="selected">Add (+)</option>
                                    <option value="2">Less (-)</option>
                                </select>                                        
                            </div>
                            <div class="col-md-2">
                                <input type="text" class=" form-control" style="text-align: right;" id="itemvalue" placeholder="0.00" value="">      
                            </div>
                            <button class="btn btn-default" id="itemsave">
                                <i class="fa fa-plus fa-lg"></i> Add Item
                            </button>
                        </div>                                                          
                    </div>                    
                </div>

                <!--<form class="form-horizontal" role="form">-->
                    <div class="row">
                        <div class="form-group">
                            <label for="itemlist" class="col-md-2 control-label">Item List :</label>
                            <div class="col-md-6">
                                <table class="table">
                                    <thead style="background-color: rgb(224,224,224); font-size: 14px; font-weight: bolder;">
                                        <tr>
                                            <td>Operation(+/-)</td>
                                            <td>Item Description</td>
                                            <td style="text-align: right;">Amount/Value</td>
                                            <td>&nbsp;</td>
                                            <td style="width: 20px; text-align: center;"></td>
                                            <td style="width: 20px; text-align: center;"></td>
                                        </tr>
                                    </thead>
                                    <tbody id="itemcontent"></tbody>
                                    <tfoot style="background-color: rgb(224,224,224); font-size: 14px; font-weight: bolder;">
                                        <tr>
                                            <td colspan="2">Subtotal : </td>
                                            <td id="tbsubtotal" style="text-align: right;"></td>
                                            <td colspan="3"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"> Applied VAT % : &nbsp;<input type="text" id="vatpct" placeholder="VAT%" value="12" style="width:50px !important; text-align: center;"> </td>
                                            <td id="tbappvat" style="text-align: right; border-top: 1px solid black; border-bottom: 1px double black;">P 0.00</td>
                                            <td colspan="3"></td>                              
                                        </tr>
                                        <tr>
                                            <td colspan="2">Total : </td>
                                            <td id="tbtotal" style="text-align: right;">P 0.00</td>
                                            <td colspan="3"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>                                                          
                    </div>
                <!--</form>-->
                <br />
                <div class="row">
                    <div class="col-md-7" style="text-align: right;">
                            <button class="btn btn-default" id="savedetails">
                                <i class="fa fa-save fa-lg"></i> Save Details
                            </button>                   
                            <button class="btn btn-default" id="cancel">
                                <i class="fa fa-close fa-lg"></i> Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
        <div class="container">
            <div id="dvSummary">
                <h3> Billing Summary </h3>
                <hr/>
                <div class="row col-md-7">
                    <table class="table">
                        <thead style="background-color: rgb(224,224,224); font-size: 14px; font-weight: bolder;">
                            <tr>
                                <td>Employee Name</td>
                                <td>Job Position</td>
                                <td style="text-align: right;">Bill Amount(Net)</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody id="summarycontent">
                        </tbody>
                        <tfoot style="background-color: rgb(224,224,224); font-size: 14px; font-weight: bolder;">
                            <tr>
                                <td colspan="2">Total Billed Amount :</td>
                                <td id="summaryamt" style="text-align: right;">P 0.00</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="row col-md-7" style="text-align: right;">
                    <button class="btn btn-default" id="createbillnotice">
                        <i class="fa fa-save fa-lg"></i> Create Bill Notice
                    </button> 
                </div>
            </div>
        </div>

<!--        <div class="container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#dvaccount">Account Information</a></li>
                <li><a data-toggle="tab" href="#2a">Employee and Billed Items</a></li>
                <li><a data-toggle="tab" href="#4a">Billing Summary</a></li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane active" id="dvaccount">
                   <div class="row">
                        <div class="form-group">
                            <label for="alert" class="col-md-2 control-label"></label>
                            <div class="col-md-4">
                                <div id="alertnotice"></div>
                            </div>
                        </div>                 
                    </div>
                    <form class="form-horizontal" role="form">       
                        <div class="row">
                            <div class="form-group">
                                <label for="accountid" class="col-md-2 control-label">Account:</label>
                                <div class="col-md-4">
                                    <select id="accountid" class="form-control"></select>
                                </div>
                            </div>                                                          
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="clientlocation" class="col-md-2 control-label"></label>
                                <div class="col-md-4">
                                    <label id="clientaddr" class="control-label"><em>Client Address</em></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="contactid" class="col-md-2 control-label">Contact:</label>
                                <div class="col-md-4">
                                    <select id="contactid" class="form-control"></select>
                                </div>
                            </div>                                                          
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="billperiod" class="col-md-2 control-label">Bill Period:</label>
                                <div class="col-md-4">
                                    <div class='input-group date' id='dtfrom'>
                                        <input type='text' class="form-control" id="txtfrom"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>                                                          
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="billperiod" class="col-md-2 control-label"></label>
                                <div class="col-md-4">
                                    <div class='input-group date' id='dtto'>
                                        <input type='text' class="form-control" id="txtto"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>                                                          
                        </div>
                    </form>
                    <div class="row">
                        <div class="form-group">
                            <label for="btnnext" class="col-md-2 control-label"></label>
                            <div class="col-md-4" style="text-align: right;">
                                <button class="btn btn-default" id="btnnext">
                                    <i class="fa fa-arrow-circle-right fa-lg"></i> Next
                                </button>
                            </div>
                        </div>                                                          
                    </div>                         
                </div>
				<div class="tab-pane" id="2a" style="margin-left: 1em;">
                    <h4> Employee Information </h4>
                    <hr/>
                    <div class="row">
                        <div class="form-group">
                            <label for="alert" class="col-md-2 control-label"></label>
                            <div class="col-md-4">
                                <div id="alertnotice2"></div>
                            </div>
                        </div>                 
                    </div>
                    <div id="billdetails">
                        <form class="form-horizontal" role="form">
                            <div class="row">
                                <div class="form-group">
                                    <label for="lastname" class="col-md-2 control-label">Last Name:</label>
                                    <div class="col-md-4">
                                        <input type="text" class=" form-control" id="lastname" placeholder="Last Name" value="">      
                                    </div>
                                </div>                                                          
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="firstname" class="col-md-2 control-label">First Name:</label>
                                    <div class="col-md-4">
                                        <input type="text" class=" form-control" id="firstname" placeholder="First Name" value="">      
                                    </div>
                                </div>                                                          
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="middlename" class="col-md-2 control-label">Middle Name:</label>
                                    <div class="col-md-4">
                                        <input type="text" class=" form-control" id="middlename" placeholder="Middle Name" value="">      
                                    </div>
                                </div>                                                          
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="jobpost" class="col-md-2 control-label">Job Position:</label>
                                    <div class="col-md-4">
                                        <input type="text" class=" form-control" id="jobpost" placeholder="Job Position" value="">      
                                    </div>
                                </div>                                                          
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="salaryrate" class="col-md-2 control-label">Salary Rate:</label>
                                    <div class="col-md-2">
                                        <input type="text" class=" form-control" style="text-align: right;" id="salaryrate" placeholder="0.00" value="">
                                    </div>
                                    <div class="col-md-2">
                                        <select id="salarytype" class="form-control">
                                            <option value="0"> Rate Type </option>
                                            <option value="1">Daily</option>
                                            <option value="2">Weekly</option>
                                            <option selected="selected" value="3">Monthly</option>
                                            <option value="4">Yearly</option>
                                        </select>     
                                    </div>
                                </div>                                                          
                            </div>
                        </form>
                        <div class="row">
                            <div class="form-group">
                                <label for="btnnext2" class="col-md-2 control-label"></label>
                                <div class="col-md-4" style="text-align: right;">
                                    <button class="btn btn-default" id="btnnext2">
                                        <i class="fa fa-arrow-circle-right fa-lg"></i> Next
                                    </button>
                                </div>
                            </div>                                                          
                        </div>
                    </div>
                    <br /><br />
                    <h4> Billed Items </h4>
                    <hr/>
                    <div class="form-horizontal" role="form">
                        <div class="row">
                            <div class="form-group">
                                <label for="itemdesc" class="col-md-2 control-label">Description</label>
                                <div class="col-md-4">
                                    <input type="text" class=" form-control" id="itemdesc" placeholder="Item Description" value="">                                
                                </div>
                            </div>                                                          
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="rateperhr" class="col-md-2 control-label">Rate per Hour</label>
                                <div class="col-md-2">
                                    <input type="text" class=" form-control" style="text-align: right;" id="rateperhr" placeholder="0.00" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="hrsrendered" class="col-md-2 control-label">Rendered Hours</label>
                                <div class="col-md-2">
                                    <input type="text" class=" form-control" style="text-align: right;" id="hrsrendered" placeholder="0.00" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="hrsxrate" class="col-md-2 control-label">Item Total</label>
                                <div class="col-md-2">
                                    <input type="text" class=" form-control" style="text-align: right;" id="hrsxrate" placeholder="0.00" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="opsid" class="col-md-2 control-label">Operation</label>
                                <div class="col-md-2">
                                    <select id="opsid" class="form-control">
                                        <option value="1" selected="selected">Add (+)</option>
                                        <option value="2">Less (-)</option>
                                    </select>                                        
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="form-group">
                            <label for="itemlist" class="col-md-1 control-label">Item List :</label>
                            <div class="col-md-8">
                                <table class="table">
                                    <thead style="background-color: rgb(224,224,224); font-size: 14px; font-weight: bolder;">
                                        <tr>
                                            <td>Operation(+/-)</td>
                                            <td>Item Description</td>
                                            <td style="text-align: right;">Amount/Value</td>
                                            <td>&nbsp;</td>
                                            <td style="width: 20px; text-align: center;"></td>
                                            <td style="width: 20px; text-align: center;"></td>
                                        </tr>
                                    </thead>
                                    <tbody id="itemcontent"></tbody>
                                    <tfoot style="background-color: rgb(224,224,224); font-size: 14px; font-weight: bolder;">
                                        <tr>
                                            <td colspan="2">Subtotal : </td>
                                            <td id="tbsubtotal" style="text-align: right;"></td>
                                            <td colspan="3"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"> Applied VAT % : &nbsp;<input type="text" id="vatpct" placeholder="VAT%" value="12" style="width:50px !important; text-align: center;"> </td>
                                            <td id="tbappvat" style="text-align: right; border-top: 1px solid black; border-bottom: 1px double black;">P 0.00</td>
                                            <td colspan="3"></td>                              
                                        </tr>
                                        <tr>
                                            <td colspan="2">Total : </td>
                                            <td id="tbtotal" style="text-align: right;">P 0.00</td>
                                            <td colspan="3"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>                                                          
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-md-8" style="text-align: right;">
                                <button class="btn btn-default" id="savedetails">
                                    <i class="fa fa-save fa-lg"></i> Save Details
                                </button>                   
                                <button class="btn btn-default" id="cancel">
                                    <i class="fa fa-close fa-lg"></i> Cancel
                                </button>
                            </div>
                        </div>
				</div>
                <div class="tab-pane" id="4a">
                    <div class="row">
                        <div class="col-md-10">
                            <table class="table">
                                <thead style="background-color: rgb(224,224,224); font-size: 14px; font-weight: bolder;">
                                    <tr>
                                        <td>Employee Name</td>
                                        <td>Job Position</td>
                                        <td style="text-align: right;">Bill Amount(Net)</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody id="summarycontent">
                                    <tr><td colspan="4" style="text-align: center;"><b><i>No record(s) found.</i></b></td></tr>
                                </tbody>
                                <tfoot style="background-color: rgb(224,224,224); font-size: 14px; font-weight: bolder;">
                                    <tr>
                                        <td colspan="2">Total Billed Amount :</td>
                                        <td id="summaryamt" style="text-align: right;">P 0.00</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>                          
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10" style="text-align: right;">
                            <button class="btn btn-default" id="createbillnotice">
                                <i class="fa fa-save fa-lg"></i> Create Bill Notice
                            </button> 
                        </div>
                    </div>
				</div>
			</div>
        </div>-->