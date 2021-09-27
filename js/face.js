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
    faceapi.nets.faceRecognitionNet.loadFromUri('../../js/models')


]).then(startVideo);

video.addEventListener('play', ()=>{

    const canvas = faceapi.createCanvasFromMedia(video);
    document.body.append(canvas);

    const displaySize = { width: video.width, height: video.height };
    faceapi.matchDimensions(canvas,displaySize);

    setInterval( async ()=>{

        const detections = await faceapi.detectSingleFace(
            video, new faceapi.TinyFaceDetectorOptions() 
        ).withFaceLandmarks().withFaceDescriptor();
            


        if(detections.descriptor)
        {
            //console.log(detections.descriptor); 
            //// cargar el descriptor a la persona
            let elbody =  document.getElementsByTagName('body')[0];

            //console.log(elbody);
            

            enviar_descripcion(detections.descriptor);

            setTimeout(function () {
                elbody.style.backgroundColor = 'green';
                redirigir_a_persona();
            }, 100);

           

        

        }

        const resizedDetections = faceapi.resizeResults(detections, displaySize);

        //// limpiar canvas
        canvas.getContext('2d').clearRect(0,0,canvas.width,canvas.height);
        ///dibujar detecciones
        
        faceapi.draw.drawDetections(canvas,resizedDetections);
        faceapi.draw.drawFaceLandmarks(canvas,resizedDetections);

    },100 );


});

function enviar_descripcion(e){

    let arr = {};
    arr['face_description'] = e;

    console.log('global_id ' + global_id);

    let loc = '../../server/entity_return.php';
    let entity = 'persona';
    let j = { u: 0, d: arr, id: global_id , coleccion: entity };

    var request = $.ajax({
        url: loc,
        type: "POST",
        data: j,
        dataType: "json"

    });

    request.done(function (d) {
        console.log(d);
        //console.log(d);
    });

    request.fail(function (jqXHR, textStatus) {
        console.log(textStatus);
    });

    return null;

}


function redirigir_a_persona(){
    window.location.href = '../persona/index.php';
}