<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="shortcut icon" href="http://imgur.com/a/TrTmM" type="image/x-icon">
    <title>EMed Services :: Password Reset Notification</title>
</head>
<body style="font-family: Arial;background-color:#FAFAFA;">
    <div>
        <div style="background-color:#3c8dbc;padding:20px 5px 20px 5px;text-align:center;font-size:150%;margin-bottom:10px;">
            <a href="http://emedservices.dyndns.org/" target="_blank">
                <img src="http://i.imgur.com/YnmOOtA.png" alt="EMed Services" height="30" width="200">
            </a>
        </div>
        <div style="color:#555 !important;text-align:justify;padding-right:30px;padding-left:30px;font-size:90%!important">
            Hi <strong>{{ $name }}</strong>,
            <br/><br/>
            You have requested to reset your <strong><span style="color:#3c8dbc !important;">EMed Services</span></strong>
            password. To reset your password, please click the button below:

            <br/><br/>
            <strong><a style="color:#3c8dbc;text-decoration:none;border-radius:3px;border:1px solid #3c8dbc;padding:11px 19px 11px 19px;white-space:nowrap;border-collapse:collapse;display:inline-block;" 
                href="{{ url('reset/' . $userid, $hashkey) }}" target="_blank">
                Reset Password
            </a></strong>
            <br/><br/>
            When you visit the page, your password will be reset, the new password will be emailed to you, you will be redirected to the login page, and <strong><span style="text-decoration:underline !important">the link will no longer work</span></strong>.
            If you did not request this change, just log in normally and inform the administrator regarding this matter.<br/>

            <br/><br/>
        </div>
        <div style="background-color:#3c8dbc;color:#3c8dbc">.</div>
    </div>
        
</body>
</html>