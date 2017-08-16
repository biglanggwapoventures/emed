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
                    <h2 style="color: #202098;">
                        <center>Frequently Asked Questions</center>
                    </h2>
                    <br><br>
                </div>

                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <button type="button" id="hello" class="btn btn-link btn-md" data-toggle="collapse" data-parent="#accordion" data-target="#collapse1" style="text-decoration: none;">What is Electronic Medical Services?
					</button>
                        </div>

                        <div id="collapse1" class="panel-collapse collapse">
                            <div class="panel-body bg">
                                - Electronic Medical Services is an online electronic medical record system <br>that is designed to help physicians monitor their patient's records anywhere and anytime.
                            </div>
                        </div>

                        <div class="panel-heading">
                            <button type="button" id="hello" class="btn btn-link btn-md" data-toggle="collapse" data-parent="#accordion" data-target="#collapse2" style="text-decoration: none;">How is your system different from others?
					</button>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse">
                            <div class="panel-body bg">
                                - Aside from being an online system, we have included an RFID system for <br>the monitoring of drug purchases.
                            </div>
                        </div>

                        <div class="panel-heading">
                            <button type="button" id="hello" class="btn btn-link btn-md" data-toggle="collapse" data-parent="#accordion" data-target="#collapse3" style="text-decoration: none;">What about the internet connection - Isn't that a weak point?
					</button>
                        </div>

                        <div id="collapse3" class="panel-collapse collapse">
                            <div class="panel-body bg">
                                - Yes, it is weak point for our system. That's why I suggest that you should have another source of internet connection. <br>The good thing about the system running online is that you can check your profile and your patient's records anywhere.
                            </div>
                        </div>

                        <div class="panel-heading">
                            <button type="button" id="hello" class="btn btn-link btn-md" data-toggle="collapse" data-parent="#accordion" data-target="#collapse4" style="text-decoration: none;">What is an RFID?
					</button>
                        </div>

                        <div id="collapse4" class="panel-collapse collapse">
                            <div class="panel-body bg">
                                - Radio-Frequency Identification, it refers to a small electornic devices that consist of a small chip and an antenna. The device serves the same purpose as a bar code or a magnetic strip on the back of a credit card or ATM card; it provides a unique identifier for that object. And, just as a bar code or magnetic strip must be scanned to get the information, the RFID device must be scanned to retrieve the identifying information.
                            </div>
                        </div>

                        <div class="panel-heading">
                            <button type="button" id="hello" class="btn btn-link btn-md" data-toggle="collapse" data-parent="#accordion" data-target="#collapse5" style="text-decoration: none;">How does the RFID works in your system?
					</button>
                        </div>

                        <div id="collapse5" class="panel-collapse collapse">
                            <div class="panel-body bg">
                                - It works as a third-party application that will detect the cards and retrieve its tag to execute the action depending on the user that is logged in.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    <style type="text/css">
        #hello:focus {
            outline: none;
        }
        
        .bg {
            background-color: #dfdddf;
        }

    </style>
</body>

</html>
