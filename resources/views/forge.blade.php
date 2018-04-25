<head>
<meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1, user-scalable=no" />
<meta charset="utf-8">

<!-- The Viewer CSS -->
<link rel="stylesheet" href="https://developer.api.autodesk.com/modelderivative/v2/viewers/style.min.css" type="text/css">

<!-- Developer CSS -->
<style>
    body {
        margin: 0;
    }
    #MyViewerDiv {
        width: 100%;
        height: 100%;
        margin: 0;
        background-color: #F0F8FF;
    }
</style>
</head>
<body>

<!-- The Viewer will be instantiated here -->
<div id="MyViewerDiv"></div>

<!-- The Viewer JS -->
<script src="https://developer.api.autodesk.com/modelderivative/v2/viewers/three.min.js"></script>
<script src="https://developer.api.autodesk.com/modelderivative/v2/viewers/viewer3D.min.js"></script>

<!-- Developer JS -->
<script>
    var viewerApp;
    var options = {
        env: 'AutodeskProduction',
        getAccessToken: function(onGetAccessToken) {
            //
            // TODO: Replace static access token string below with call to fetch new token from your backend
            // Both values are provided by Forge's Authentication (OAuth) API.
            //
            // Example Forge's Authentication (OAuth) API return value:
            // {
            //    "access_token": "<YOUR_APPLICATION_TOKEN>",
            //    "token_type": "Bearer",
            //    "expires_in": 86400
            // }
            //
            var accessToken = 'eyJhbGciOiJIUzI1NiIsImtpZCI6Imp3dF9zeW1tZXRyaWNfa2V5In0.eyJjbGllbnRfaWQiOiJ6OGZHRDdzT3oyN2RHc2lHMWczZGYybmVsa1hjaFRBViIsImV4cCI6MTUyNDY1MTAyMCwic2NvcGUiOlsiZGF0YTpyZWFkIiwiYnVja2V0OnJlYWQiLCJidWNrZXQ6Y3JlYXRlIiwiZGF0YTp3cml0ZSIsImJ1Y2tldDpkZWxldGUiXSwiYXVkIjoiaHR0cHM6Ly9hdXRvZGVzay5jb20vYXVkL2p3dGV4cDYwIiwianRpIjoiWWU1NFNpVmk4eEg5dUg1Tm1FTldZRzFlMHNXcmdvYk1Kb0NSa1hHYkRxZVFibHMzNjZxR1Q1bGpkSzI4ekNDYyJ9.hEj5HcTa4LQfdc1-zl4BmAYtMir57xeu7Utym2hWykw';
            var expireTimeSeconds = 60 * 30;
            onGetAccessToken(accessToken, expireTimeSeconds);
        }

    };
    var documentId = 'urn:dXJuOmFkc2sub2JqZWN0czpvcy5vYmplY3Q6am9obm9uc29mdHdhcmV3b3Jrc2hvcDMvYmI4YXIuZjNk';
    Autodesk.Viewing.Initializer(options, function onInitialized(){
        viewerApp = new Autodesk.Viewing.ViewingApplication('MyViewerDiv');
        viewerApp.registerViewer(viewerApp.k3D, Autodesk.Viewing.Private.GuiViewer3D);
        viewerApp.loadDocument(documentId, onDocumentLoadSuccess, onDocumentLoadFailure);
    });

    function onDocumentLoadSuccess(doc) {

        // We could still make use of Document.getSubItemsWithProperties()
        // However, when using a ViewingApplication, we have access to the **bubble** attribute,
        // which references the root node of a graph that wraps each object from the Manifest JSON.
        var viewables = viewerApp.bubble.search({'type':'geometry'});
        if (viewables.length === 0) {
            console.error('Document contains no viewables.');
            return;
        }

        // Choose any of the avialble viewables
        viewerApp.selectItem(viewables[0].data, onItemLoadSuccess, onItemLoadFail);
    }

    function onDocumentLoadFailure(viewerErrorCode) {
        console.error('onDocumentLoadFailure() - errorCode:' + viewerErrorCode);
    }

    function onItemLoadSuccess(viewer, item) {
        console.log('onItemLoadSuccess()!');
        console.log(viewer);
        console.log(item);

        // Congratulations! The viewer is now ready to be used.
        console.log('Viewers are equal: ' + (viewer === viewerApp.getCurrentViewer()));
    }

    function onItemLoadFail(errorCode) {
        console.error('onItemLoadFail() - errorCode:' + errorCode);
    }

</script>
</body>