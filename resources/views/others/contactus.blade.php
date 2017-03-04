<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/body.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
@include('partials.navbar')

<center>

<div class="container">
  <div class="row-bod">
      <div class="col-md-12">
        <div class="page-header">
          <h2>Get in touch with E-med Services</h2>
        </div>

      <!-- Trigger the modal with a button -->
      <button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target="#myModal">Email</button>
      <button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target="#myModal2">Address</button>
      <button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target="#myModal3">Contact Number</button>

      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Email</h4>
              </div>
              <div class="modal-body">
                  <p>emedservices@gmail.com</p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div> 
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="myModal2" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Address</h4>
              </div>
              <div class="modal-body">
                  <p>Nasipit, Talamban Cebu City 6000</p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>  
        </div>
      </div>
      

      <!-- Modal -->
      <div class="modal fade" id="myModal3" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Contact Number</h4>
              </div>
              <div class="modal-body">
                <p>09993647047</p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

</center>


</body>
</html>