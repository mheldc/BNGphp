<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
        <hr/>
            <div class="container">
                <div class="col-sm-3 col-xs-3 col-md-3 pull-left">
                    <button id="btnnewbill" class="btn btn-default" onclick="javascript: window.location = siteurl + 'billgenerator/createbillnotice';">
                        <i class="fa fa-edit fa-lg"></i> Create Billing Notice
                    </button>
                </div>  
                <div class="col-sm-3 col-xs-3 col-md-3 pull-right">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" name="q" id="txtsearch">
                            <div class="input-group-btn">
                                <button class="btn btn-default" id="btnsearch"><i class="fa fa-search fa-lg"></i></button>
                            </div>
                        </div>
                </div>
                
            </div>
        <hr/>
        <div class="container">
            <table class="table table-striped">
                <thead style="background-color: rgb(224,224,224); font-size: 14px; font-weight: bolder;"
                    <tr>
                        <td>Reference #</td>
                        <td>Company</td>
                        <td>Billing Period</td>
                        <td>Date Created</td>
                        <td>Created By</td>
                        <td style="text-align: right;">Bill Amount</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody id="tbbilllist"></tbody>
                <tfoot style="background-color: rgb(224,224,224); font-size: 14px; font-weight: bolder;">
                    <tr>
                        <td colspan="7" id="tdbillcount"></td>
                    </tr>
                </tfoot>
           </table>           
        </div>