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
<script src="https://code.jquery.com/jquery-2.1.2.min.js"></script>

<!-- Developer JS -->
<script>

    $(document).ready( function(){
        var getToken =  () => {
            var xhr = new XMLHttpRequest();

            xhr.open("GET", '/api/forge/oauth/token', false);
            xhr.send(null);
            var response = JSON.parse(xhr.responseText);
            return response.access_token;
        }
        
        var viewerApp;
        var options = {
            env: 'AutodeskProduction',
            'getAccessToken': getToken,
            'refreshToken': getToken
        };
        
        var documentId = 'urn:<<place your urn here>>';
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

    });
</script>
</body>