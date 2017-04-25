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
                        <td colspan="9">Dr. Gladys SLut  &nbsp &nbsp &nbsp &nbsp
                     <b> PRC: </b> 12321  &nbsp &nbsp <b>S2:</b> 124124 </b> &nbsp &nbsp <b>PRC:</b> 2345235</b>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td>Brand</td>
                        <td>Generic Name</td>
                        <td>Frequency</td>
                        <td>Dosage</td>
                        <td>Duration</td>
                        <td>Quantity</td>
                        <td style="width:10%"></td>
                    </tr>
                
                    <tr>
                      

                        <td colspan="2"></td>
                        <td>Sample</td>
                        <td>Sample</td>
                        <td>Sample</td>
                        <td>Sample</td>
                        <td></td>
                        <td>Sample</td>
                        <td>
                           {!! Form::bsText('quantity', 'Quantitiy') !!}
                        </td>
                    </tr>
                   </tbody> 
             

                    </table>
                </div>
                <div class="text-right">
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> proceed</button>
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

