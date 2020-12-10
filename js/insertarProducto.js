//Imagen del Producto en el formulario
var imgProduct  = document.querySelector('#imgProduct')              ;
var imgProduct1 = document.querySelector('#imgProduct1')             ;
var imgAboutUs  = document.getElementById('sobreNosotros-container' );
var imgAboutUs1 = document.getElementById('sobreNosotros-container1');
if(imgAboutUs != null){
  var imgAboutUsURL = imgAboutUs.style.backgroundImage.replace('url("', '').replace('")','');
  if(imgAboutUsURL.length <= 0){
    imgAboutUs.style.backgroundImage  = 'url("../../aboutUsBg.jpg")';
    imgAboutUs1.style.backgroundImage = 'url("../../aboutUsBg.jpg")';
  }
  var seleccionarArchivo1 = document.querySelector('#seleccionarArchivo1');
  seleccionarArchivo1.addEventListener("change", () =>{
    var archivos1 = seleccionarArchivo1.files;
    if(!archivos1 || !archivos1.length){
        imgAboutUs.style.backgroundImage  = "";
        imgAboutUs1.style.backgroundImage = "";
        return
      }
    var primerArchivo1 = archivos1[0]                       ;
    var objectURL1     = URL.createObjectURL(primerArchivo1);
    imgAboutUs.style.backgroundImage  = "url('"+objectURL1+"')";
    imgAboutUs1.style.backgroundImage = "url('"+objectURL1+"')";
  })
}

if(imgProduct.src.length <= 0){
    imgProduct.src = 'https://maquette.pro/wp-content/uploads/2017/11/1-55.jpg';
}

//Input
var seleccionarArchivo  = document.querySelector('#seleccionarArchivo')     ;
seleccionarArchivo.addEventListener("change", () => {
    var archivos  = seleccionarArchivo.files;
    if(!archivos || !archivos.length){
        imgProduct.src = '';
        return
    }
    var primerArchivo  = archivos[0]                        ;
    var objectURL      = URL.createObjectURL(primerArchivo) ;
    imgProduct.src     = objectURL                          ;
    imgProduct1.src    = objectURL                          ; 
});
