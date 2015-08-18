<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Biforits Image Uploader</title>

<link rel="stylesheet" href="assets/bootstrap.css"/>
<script src="assets/angular.js"></script>

</head>
<body ng-app="Bifortis">

  <div class="container" ng-controller="AppCtrl">

        <h1 class="text-center">Uploader</h1>

        <div class="row">

            <br/><br/>
            <form novalidate name="uploader">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="label">Label of Image</label>
                        <input required type="text" class="form-control" id="label" name="label" ng-model="data.label" placeholder="Enter label of image"/>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="image">Select Image</label>
                        <input required type="file" class="form-control" name="image" file-directive="data.avatar"/>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <button ng-click="upload(data)" class="btn btn-primary" ng-disabled="uploader.$invalid">Upload Image</button>
                    </div>
                </div>
                <div class="col-md-6" ng-show="errorMsg">
                    <p class="text-danger">@{{ errorMsg }}</p>
                </div>
            </form>

        </div>
        <hr/>

        <div data-ng-init="getImages()">
            <h3 ng-show="! images.length" class="text-info text-center" >
                No image posted yet.
            </h3>

            <div class="row">
                <div ng-repeat="image in images" class="col-md-4">
                    <h4 class="text-center">@{{ image.caption }}</h4>
                    <img ng-src="@{{ image.avatar }}" alt="@{{image.caption}}"/>
                </div>
            </div>

        </div>


  </div>

</body>
<script src="assets/app.js"></script>



</html>