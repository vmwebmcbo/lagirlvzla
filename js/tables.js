var select            = document.getElementById        ('categorias'       )
var select2           = document.getElementById        ('subcategorias'    )
var filasTables       = document.getElementsByClassName('filasTables'      )
var categoriaTable    = document.getElementsByClassName('categoriaTable'   )
var subCategoriaTable = document.getElementsByClassName('subCategoriaTable')
var noItemExistMsg    = document.getElementById('no-item-exist-msg'        );
var catSelected       = new Array();
var subCatSelected    = new Array();
var checkProductsCategory = () =>{
    catSelected.length = 0;
    for(let i = 0; i < filasTables.length; i++){
        if(categoriaTable[i].innerHTML == select.options[select.options.selectedIndex].value){
            catSelected.push(filasTables[i]);
        }
        if(select.options[select.options.selectedIndex].value == '1'){
            filasTables[i].classList.remove('displayNone');
            filasTables[i].classList.add   ('displayShow');
        }else {
          filasTables[i].classList.remove('displayShow');
          filasTables[i].classList.add('displayNone');
        }
    }

    if(catSelected.length >= 1){
      for(let i = 0; i < catSelected.length; i++){
          catSelected[i].classList.remove('displayNone');
          catSelected[i].classList.add('displayShow');

          noItemExistMsg.classList.remove('displayShow');
          noItemExistMsg.classList.add('displayNone');
      }
    }else if(select.options[select.options.selectedIndex].value == 1){
      noItemExistMsg.classList.remove('displayShow');
      noItemExistMsg.classList.add('displayNone');
    }else{
      noItemExistMsg.classList.remove('displayNone');
      noItemExistMsg.classList.add('displayShow');
    }
}

var checkProductsSubCategory = () =>{
  subCatSelected.length = 0;
  for(let i = 0; i < filasTables.length; i++){
    if(subCategoriaTable[i].innerHTML == select2.options[select2.options.selectedIndex].value){
      subCatSelected.push(filasTables[i]);
    }
    if(select2.options[select2.options.selectedIndex].value == '1'){
      filasTables[i].classList.remove('displayNone');
      filasTables[i].classList.add   ('displayShow');
    }else {
      filasTables[i].classList.remove('displayShow');
      filasTables[i].classList.add('displayNone');
    }
  }
  if(subCatSelected.length >= 1){
    for(let i = 0; i < subCatSelected.length; i++){
        subCatSelected[i].classList.remove('displayNone');
        subCatSelected[i].classList.add('displayShow');

        noItemExistMsg.classList.remove('displayShow');
        noItemExistMsg.classList.add('displayNone');
    }
  }else if(select2.options[select2.options.selectedIndex].value == 1){
    noItemExistMsg.classList.remove('displayShow');
    noItemExistMsg.classList.add('displayNone');
  }else{
    noItemExistMsg.classList.remove('displayNone');
    noItemExistMsg.classList.add('displayShow');
  }
}