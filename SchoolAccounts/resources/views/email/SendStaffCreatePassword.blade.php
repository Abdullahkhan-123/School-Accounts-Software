<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h4> Form {{ $mailData['AcademyName'] }} requested to please click this link below</h4>
    <a href="{{ route('StaffCreatePassword', $mailData['VerifyCode']) }}">Create Password</a>
</body>
</html>