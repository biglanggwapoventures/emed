<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/body.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
@include('partials.navbar')

<div class="container">
		<div class="row-bod">
			<div class="col-md-12">
				<div class="page-header">
					<h2>Frequently Asked Questions</h2>
				</div>

				<div class="panel-group" id="accordion">
				<div class="panel panel-default">
				<div class="panel-heading">
					<button type="button" class="btn btn-link btn-md" data-toggle="collapse" data-parent="#accordion" data-target="#collapse1">What is Electronic Medical Services?
					</button>
				</div>

						<div id="collapse1" class="panel-collapse collapse">
							<div class="panel-body"> 
								- Electronic Medical Services is an online electronic medical record system that is designed to help physicians monitor their patient's records anywhere and anytime.
							</div>
						</div>

				<div class="panel-heading">
					<button type="button" class="btn btn-link btn-md" data-toggle="collapse" data-parent="#accordion" data-target="#collapse2">How is your system different from others?
					</button>
				</div>
						<div id="collapse2" class="panel-collapse collapse">
							<div class="panel-body"> 
								- Aside from being an online system, we have included an RFID system for the monitoring of drug purchases.
							</div>
						</div>

				<div class="panel-heading">
					<button type="button" class="btn btn-link btn-md" data-toggle="collapse" data-parent="#accordion" data-target="#collapse3">What about the internet connection - Isn't that a weak point?
					</button>
				</div>

						<div id="collapse3" class="panel-collapse collapse">
							<div class="panel-body"> 
								- Yes, it is weak point for our system. That's why I suggest that you should have another source of internet connection. The good thing about the system running online is that you can check your profile and your patient's records anywhere.
							</div>
						</div>

				<div class="panel-heading">
					<button type="button" class="btn btn-link btn-md" data-toggle="collapse" data-parent="#accordion" data-target="#collapse4">What is an RFID?
					</button>
				</div>

						<div id="collapse4" class="panel-collapse collapse">
							<div class="panel-body"> 
								- Radio-Frequency Identification, it refers to a small electornic devices that consist of a small chip and an antenna. The device serves the same purpose as a bar code or a magnetic strip on the back of a credit card or ATM card; it provides a unique identifier for that object. And, just as a bar code or magnetic strip must be scanned to get the information, the RFID device must be scanned to retrieve the identifying information.
							</div>
						</div>
				
				<div class="panel-heading">
					<button type="button" class="btn btn-link btn-md" data-toggle="collapse" data-parent="#accordion" data-target="#collapse5">How does the RFID works in your system?
					</button>
				</div>

						<div id="collapse5" class="panel-collapse collapse">
							<div class="panel-body"> 
								- The RFID tags are given to the patients. 
							</div>
						</div>
				</div>
				</div>
				</div>

			</div>
		</div>
</div>

</body>
</html>