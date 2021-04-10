<!doctype html>
<html lang="fr">

<head>
<link rel="icon" href="../images/icon.png" />
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <title>Connexion</title>
</head>

<body>
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="../index.php">3DHUB</a>
    </div>
  </nav>

  <div class="container">
    <div class="row mt-5">
      <div class="col-3"></div>
      <div class="col-6">
        <h3>Bienvenue sur 3DHUB</h3>
        <h1>Se connecter</h1>

        <form>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Adresse Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Mot de Passe</label>
            <input type="password" class="form-control" id="exampleInputPassword1">
          </div>
          <button type="submit" class="btn btn-primary">Se connecter</button>
          <a type="button" class="btn btn-outline-primary" href="register.php">S'incrire</a>
        </form>
      </div>
      <div class="col-3"></div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
    crossorigin="anonymous"></script>

</body>

</html>