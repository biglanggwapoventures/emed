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

            Your password has been reset. Enter the password below to temporarily log in so that you can change your password. 
            You will resume all access after updating your credential.
            <br/><br/>

            Temporary password : <span style="text-decoration:underline !important">{{ $temporaryPW --}}</span>
            <br/><br/>

            <strong>
                ** If you did not make this change, immediately contact administrator.
            </strong>

            <br/><br/>
        </div>
        <div style="background-color:#3c8dbc;color:#3c8dbc">.</div>
    </div>
        
</body>
</html>