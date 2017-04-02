@extends('welcome') @section('body')

<div class="container-fluid">
    <table class="lefty pull-left">
        <thead>
            <tr class="active">
                <th><br></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <img alt="User Pic" src="/" style="width: 150px; height: 150px;" class="img-circle img-responsive"><br>
                </td>
                <td>Name:<br> Nikki Gallego <br> Birthdate: 9/26/1994 <br> Age: 20</td>
            </tr>
        </tbody>
    </table>
    <table class="table">
        <thead>
            <tr class="active">
                <th>Doctor</th>
                <th>Generic Name</th>
                <th>Brand Name</th>
                <th>Dosage</th>
                <th>Quantity</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="input-group spinner">Doctor</div>
                </td>
                <td>Generic Name</td>
                <td>Brand</td>
                <td>Dosage</td>
                <td> Quantity</td>
                <td>
                    <div class="input-group spinner"><input type="text" class="form-control" value="0"></div>
                </td>
            </tr>
        </tbody>
    </table>
    <button class="btn btn-success pull-right" type="button"><i class="fa fa-heart">Purchase</i></button>
</div>

<script type="text/javascript">
    (function($) {
        $('.spinner .btn:first-of-type').on('click', function() {
            $('.spinner input').val(parseInt($('.spinner input').val(), 10) + 1);
        });
        $('.spinner .btn:last-of-type').on('click', function() {
            $('.spinner input').val(parseInt($('.spinner input').val(), 10) - 1);
        });
    })(jQuery);

</script>

<style type="text/css">
    .spinner {
        width: 100px;
    }
    
    .spinner input {
        text-align: right;
    }
    
    .input-group-btn-vertical {
        position: relative;
        white-space: nowrap;
        width: 1%;
        vertical-align: middle;
        display: table-cell;
    }
    
    .input-group-btn-vertical>.btn {
        display: block;
        float: none;
        width: 100%;
        max-width: 100%;
        padding: 8px;
        margin-left: -1px;
        position: relative;
        border-radius: 0;
    }
    
    .input-group-btn-vertical>.btn:first-child {
        border-top-right-radius: 4px;
    }
    
    .input-group-btn-vertical>.btn:last-child {
        margin-top: -2px;
        border-bottom-right-radius: 4px;
    }
    
    .input-group-btn-vertical i {
        position: absolute;
        top: 0;
        left: 4px;
    }
    
    .table {
        width: 73%;
        max-width: 80%;
        margin-top: 76px;
        margin-left: 313px;
    }
    
    .lefty {
        width: 27%;
        margin-top: 79px;
        margin-left: -56px;
    }
    
    .img-circle {
        border-radius: 50%;
        margin-left: 7px;
    }

</style>

@endsection
