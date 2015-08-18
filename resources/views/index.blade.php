<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Biforits Image Uploader</title>

<link rel="stylesheet" href="assets/bootstrap.css"/>
<script src="assets/angular.js"></script>
<script src="assets/route.js"></script>

</head>
<body ng-app="Bifortis">

    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#/">
            Uploader
          </a>
          <ul class="nav navbar-nav navbar-right">
              <li><a href="#images">Images</a></li>
            </ul>
        </div>
      </div>
    </nav>

    <div class="container" ng-controller="AppCtrl">
        <div ng-view></div>
    </div>

</body>

<script src="assets/app.js"></script>



</html>