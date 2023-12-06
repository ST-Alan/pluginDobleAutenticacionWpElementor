const camposDelFormulario = () =>{
    let codigo = document.querySelector('input#form-field-codigo').value;
    let correo = document.querySelector('input#form-field-email').value;
    
    return {codigo, correo};
}

const sendWpApi = () =>{
    let datosFormulario = camposDelFormulario();
    let urlBaseApi=window.location.origin;    
	let url=`${urlBaseApi}/wp-json/bajaUsuario/v1/validarCodigoEnviado`;
    
    fetch(url, 
        {
            method: 'POST',			
            headers: 
            {
                'Accept': 'application/json, text/plain, */*',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(datosFormulario),
        })
        .then(response => 
            {
                console.log(response)
                if (response.ok == 1) {
                    // Procesar la respuesta si es exitosa
                    console.log('Usuario validado exitosamente');
                } else {
                    // Manejar errores de la respuesta
                    console.error('Error al validar usuario:', response.statusText);
                }
            })
            .catch(error => 
                {
                    // Manejar errores en la petición
                    console.error('Error en la petición:', error);
                });
            }
            
            
            // const formularioDeBaja = document.getElementById('formBajaUsuario')
            
            
const clickBotonForm = (event) => 
{
    camposDelFormulario();
    sendWpApi();
    event.preventDefault();
    console.log('Alan was here')
}
let btnForm=document.querySelector('#btnFormBajaEnviar');
btnForm.setAttribute('onclick', 'clickBotonFormulario(event)')