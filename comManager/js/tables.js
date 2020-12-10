var select         = document.getElementById        ('categorias'    )
var filasTables    = document.getElementsByClassName('filasTables'   )
var categoriaTable = document.getElementsByClassName('categoriaTable')
var noItemExistMsg = document.getElementById('no-item-exist-msg');
var catSelected    = new Array();
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
