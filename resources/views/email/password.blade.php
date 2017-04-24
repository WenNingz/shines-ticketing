<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h3>Password Reset</h3>

<div>
    Please follow the link below to reset password
    {{ URL::to('/reset-password/verify/'. $email_token) }}<br/>

</div>

</body>
</html>