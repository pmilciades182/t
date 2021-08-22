const video = document.getElementById('video');

function startVideo(){
    navigator.getUserMedia =  ( navigator.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia);

    navigator.getUserMedia(
        { video: {}},
        stream =>video.srcObject = stream,
        err =>console.log(err)
    )
}

Promise.all([

    faceapi.nets.tinyFaceDetector.loadFromUri('../../js/models'),
    faceapi.nets.faceLandmark68Net.loadFromUri('../../js/models'),
    faceapi.nets.faceRecognitionNet.loadFromUri('../../js/models'),
    faceapi.nets.faceExpressionNet.loadFromUri('../../js/models'),
    faceapi.nets.ageGenderNet.loadFromUri('../../js/models')

]).then(startVideo);

video.addEventListener('play', ()=>{

    const canvas = faceapi.createCanvasFromMedia(video);
    document.body.append(canvas);

    const displaySize = { width: video.width, height: video.height };
    faceapi.matchDimensions(canvas,displaySize);

    setInterval( async ()=>{

        const detections = await faceapi.detectAllFaces(
            video, new faceapi.TinyFaceDetectorOptions() 
        ).withFaceLandmarks();
            

        //console.log(detections); 

        const resizedDetections = faceapi.resizeResults(detections, displaySize);

        //// limpiar canvas
        canvas.getContext('2d').clearRect(0,0,canvas.width,canvas.height);
        ///dibujar detecciones
        
        faceapi.draw.drawDetections(canvas,resizedDetections);
        faceapi.draw.drawFaceLandmarks(canvas,resizedDetections);

    },100 );


});