<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Created</title>
</head>
<body>
    <h2>Email de notification de compte créer sur le blog FS-08</h2>
    <p>Un compte à été créé par Hippolyte pour vous sur notre blog</p>
    <p>
        <strong>Nom:</strong> {{$user['name']}}
        <strong>Email:</strong> {{$user['email']}}
        <strong>password:</strong> {{$user['pass']}}
    </p>
</body>
</html>