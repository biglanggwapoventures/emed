@extends('welcome') @section('body')
<style>
    table.table td {
        vertical-align: middle;
    }
    
    table.table td .form-group {
        margin-bottom: 0;
    }

</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
        <h1>
           Transaction
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Transaction</a></li>
           

        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
               
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table id="example1" class="table table-bordered table-striped">
                       
                        <tbody>
                    <tr>
                        <td colspan="9">Transaction Summary
                        </td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>Quantity Purchased</td>
                        <td>Available Quantity</td>
                        <td>Pharmacist </td>
                        <td>Time</td>
                        <td></td>
                    </tr>
                
                    <tr>
                
                        <td>Biogesic</td>
                        <td>4</td>
                        <td>5</td>
                       <td>Pharmacist name</td>
                       <td>Time</td>
                    </tr>
                   </tbody> 
             

                    </table>
                </div>
                <div class="text-right">
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
            </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->

<!-- /.row -->
        </section>
<!-- /.content -->

        

</div>
@endsection

