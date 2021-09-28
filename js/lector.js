var r = load_personas();

console.log(r);

const video = document.getElementById('video');

async function startVideo() {
    navigator.getUserMedia = (navigator.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia);

    navigator.getUserMedia(
        { video: {} },
        stream => video.srcObject = stream,
        err => console.log(err)
    )
}

Promise.all([

    faceapi.nets.tinyFaceDetector.loadFromUri('../../js/models'),
    faceapi.nets.faceLandmark68Net.loadFromUri('../../js/models'),
    faceapi.nets.faceRecognitionNet.loadFromUri('../../js/models')


]).then(startVideo);




video.addEventListener('play', () => {

    const canvas = faceapi.createCanvasFromMedia(video);
    document.body.append(canvas);

    const displaySize = { width: video.width, height: video.height };
    faceapi.matchDimensions(canvas, displaySize);

    setInterval(async () => {

        const detections = await faceapi.detectSingleFace(
            video, new faceapi.TinyFaceDetectorOptions()
        ).withFaceLandmarks().withFaceDescriptor();



        if (detections.descriptor) {
            //console.log(detections.descriptor); 
            //// cargar el descriptor a la persona
            let elbody = document.getElementsByTagName('body')[0];

            //console.log(elbody);


            //enviar_descripcion(detections.descriptor);
            /*
            setTimeout(function () {
                elbody.style.backgroundColor = 'green';
                //redirigir_a_persona();
            }, 5000);
            */
           }


        console.log(r);

        const LabeledFaceDescriptors = r;

        const faceMatcher  = new faceapi.FaceMatcher(LabeledFaceDescriptors, .6);

        const resizedDetections = faceapi.resizeResults(detections, displaySize);

        console.log(resizedDetections);
    
        const results = faceMatcher.findBestMatch(resizedDetections.descriptor);

      
        console.log(results);

        //// limpiar canvas
        canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
        ///dibujar detecciones
        // console.log(resizedDetections);

        const box = resizedDetections.detection.box;

        const drawBox = new faceapi.draw.DrawBox( box, {label: 'Prueba'});

        

        faceapi.draw.drawDetections(canvas, resizedDetections);

        drawBox.draw(canvas);
        //faceapi.draw.drawFaceLandmarks(canvas, resizedDetections);

    }, 5000);


});

function load_personas() {

    let loc = '../../server/entity_return.php';
    var res;
    var request = $.ajax({
        url: loc,
        type: "POST",
        data: { e: 1, p: 1, detail: 1, coleccion: 'persona' },
        dataType: "json",
        async: false
    });

    //console.log(request);

    request.done(function (v) {
        // console.log(d);
        //console.log(v);
        res = __separar(v);
         console.log(res);
         return res;
       
    });



    function __separar(v) {

        var conjunto = [];

        for (let i = 0; i <= v.length - 1; i++) 
        {

            let r = v[i];
            let c = (r['nombre']);
            let d = (r['face_description']);

            console.log(c);
            //console.log(d);

            let e = new Float32Array(d);
            console.log(e);
            let f = [];
            f[0] = e;
            console.log(f);
            let y = new faceapi.LabeledFaceDescriptors(c,f);
            conjunto[i] = y;
        }

        return conjunto;
    }

    return res;
};