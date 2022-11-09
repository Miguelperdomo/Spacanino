let formulario = document.getElementById('formulario');//captura el formulario
let respuesta = document.getElementById('respuesta');
formulario.addEventListener('submit',function(e){//detecta el submit
    e.preventDefault();//evita la recarga
        
        var datos = new FormData(formulario);//Objeto guarda información del formulario en datos
        console.log(datos.get('id'));
        fetch('json/servidor.php',{//envia los datos del formulario
            method:'POST',
            body: datos
        })
            
        .then(function(response) {
            if(response.ok) {
                return response.text()
            } else {
                throw "Error en la llamada Ajax";
            }
         
        })
        
        .then(function(texto) {
            document.getElementById("respuesta").innerHTML = texto
        })
        .catch(function(err) {
            console.log(err);
        });
})

        

