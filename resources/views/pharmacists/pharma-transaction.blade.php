@extends('welcome')

@section('body')

<div class="container-fluid">
	<table class="table">
                <thead>
                  <tr class="active">
                    <th>Generic Name</th>
                    <th>Brand</th>
                    <th>Dosage</th>
                    <th>Quantity</th>
                    <th>Manage</th>
                  </tr>
                </thead>
                <tbody>
               
                    <tr>
                      <td>Generic Name</td>
                      <td>Brand</td>
                      <td>Dosage</td>
                      <td> Quantity</td>
                      <td>
                      	<div class="input-group spinner">
    <input type="text" class="form-control" value="42">
    <div class="input-group-btn-vertical">
      <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
      <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
    </div>

  </div>

                      </td>
                    </tr>
                  
                </tbody>
                <button class="btn btn-default pull-right" type="button"><i class="fa fa-heart">Purchase</i></button>
              </table>
         
</div>
<script type="text/javascript">
	(function ($) {
  $('.spinner .btn:first-of-type').on('click', function() {
    $('.spinner input').val( parseInt($('.spinner input').val(), 10) + 1);
  });
  $('.spinner .btn:last-of-type').on('click', function() {
    $('.spinner input').val( parseInt($('.spinner input').val(), 10) - 1);
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
.input-group-btn-vertical > .btn {
  display: block;
  float: none;
  width: 100%;
  max-width: 100%;
  padding: 8px;
  margin-left: -1px;
  position: relative;
  border-radius: 0;
}
.input-group-btn-vertical > .btn:first-child {
  border-top-right-radius: 4px;
}
.input-group-btn-vertical > .btn:last-child {
  margin-top: -2px;
  border-bottom-right-radius: 4px;
}
.input-group-btn-vertical i{
  position: absolute;
  top: 0;
  left: 4px;
}
.table {
    width: 80%;
    max-width: 80%;
    margin-top: 76px;
}
</style>

@endsection