<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/style.css">
    <title>Ledenadministratie</title>
</head>
<body>
    <div class="title">
        <h1>Ledenadministratie</h1>
    </div>

    <div class="form_container">
    <form method="POST" action="Controllers/UserController.php">  
        <input type="text" name="Username" placeholder="Username">
        <input type="password" name="Password" placeholder="Password">
        <button type="submit">Log in</button>
    </form>
    </div>
    
</body>
</html>