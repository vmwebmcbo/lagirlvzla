var listCheckoutItems = document.getElementById('list-checkout-items')      ;
var cartCountBadge    = document.getElementById('cart-count-badge'   )      ;
var totalItemPrice    = document.getElementById('total-item-price'   )      ;
var formInfo          = document.getElementById('form-data'          )      ;
var firstName         = document.getElementById('firstName'          )      ;
var lastName          = document.getElementById('lastName'           )      ;
var email             = document.getElementById('email'              )      ;
var address           = document.getElementById('address'            )      ;
var telefono          = document.getElementById('telefono'           )      ;
var titularNombre     = document.getElementById('titularNombre'      )      ;
var referencia        = document.getElementById('referencia'         )      ;
var method            = document.getElementById('method'             )      ;
var shippingItems     = document.getElementById('shipping-items'     )      ;
var formData          = new FormData()                                      ;
var responseHTML      =''                                                   ;
var cartCount         = 0                                                   ;
var description       = "Compra de productos: "                             ;
var products          = new Array()                                         ;
var totalToSucceed    = ''                                                  ;
//Cart Information
var cartInformation = fetch('../Cart/actionCart.php')
.then(function(response){
    return response.json();
}).then(function(responseJson){
    responseJson.forEach(element => {
        responseHTML += `
        <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
                <h6 class="my-0">(`+element.pQ+`) `+element.pName+`</h6>
            </div>
            <span class="text-muted">$`+(element.pPrice*element.pQ)+`</span>
        </li>
    `;
    cartCount++;
    //loadPList
    //description += '('+ cartCount + ') id:' + element.idp;
    products.push(
            {
                pQ    : element.pQ,
                pName : element.pName,
                pPrice: element.pPrice,
                tProductName: element.tProductName
            }
        );
    });
    cartCountBadge.innerHTML    = cartCount;
    listCheckoutItems.innerHTML = responseHTML;
}).catch(function(err){
    console.log(err);
})
//CartLoad
var loadCart = fetch('../Cart/loadCart.php').then(function(response){
    return response.json();
}).then(function(responseJson){
    totalItemPrice.innerHTML = responseJson.totalItemPrice;
    total                    = responseJson.totalItemPrice.replace('$ ','');
}).catch(function(err){
    console.log(err);
})
var confirmPayment = () =>{
    if(formInfo.reportValidity())
    {
        $('#buttonData').html(`
        <i class="fa fa-credit-card"></i> Continuar Pago <img src='../uploads/loadpay.svg' width="5%" />

            `);
        $('#confirm-your-data').html(
            `
            <div style="margin-bottom: 1%">
                <h6 style="margin-bottom: 0">Forma de Pago: </h6>
                    <span style="color: #999999;">`+ method.value+`</span>
            </div>
            <div style="margin-bottom: 1%">
                <h6 style="margin-bottom: 0">Nombre del Comprador: </h6>
                    <span style="color: #999999;">`+ firstName.value+` `+lastName.value+`</span>
            </div>
            <div style="margin-bottom: 1%">
                <h6 style="margin-bottom: 0">E-Mail del Comprador: </h6>
                <span style="color: #999999;">`+email.value+`</span>
            </div>
            <div style="margin-bottom: 1%">
                <h6 style="margin-bottom: 0">Telefono del Comprador: </h6>
                <span style="color: #999999;">`+telefono.value+`</span>
            </div>
            <div style="margin-bottom: 1%">
                <h6 style="margin-bottom: 0">Direccion del Comprador: </h6>
                <span style="color: #999999;">`+address.value+`</span>
            </div>
            <div style="margin-bottom: 1%">
                <h6 style="margin-bottom: 0">Nombre del Titular: </h6>
                <span style="color: #999999;">`+titularNombre.value+`</span>
            </div>
            <div style="margin-bottom: 1%">
                <h6 style="margin-bottom: 0">Referencia de la Transaccion: </h6>
                <span style="color: #999999;">`+referencia.value+`</span>
            </div>
            `
        );
        $('#modalCenter').modal('show');
        if(firstName.value && lastName.value && email.value && telefono.value && titularNombre.value && referencia.value && products && total)
        {
          var msg = 'success';
        //   var priceCurrency     = document.getElementById('total-item-price-currency');
          formData.append('firstName'    , firstName.value    );
          formData.append('lastName'     , lastName.value     );
          formData.append('email'        , email.value        );
          formData.append('telefono'     , telefono.value     );
          formData.append('direccion'    , address.value      );
          formData.append('titularNombre', titularNombre.value);
          formData.append('referencia'   , referencia.value   );
          formData.append('method'       , method.value       );
          formData.append('products'     , JSON.stringify(Object.assign({}, products)));
          formData.append('msg'          , msg  );
          formData.append('total'        , total);
        //   formData.append('currency'     , priceCurrency.innerHTML.replaceAll('.', '').replace(',','.'));
        }else
        {
          var msg = 'error';
          formData.append('msg',msg);
        }
    }else
    {
        formInfo.reportValidity();
    }
}
$('#submit').on('click', function successPay(){
    fetch('./redirect.php',{
        method: 'POST',
        body: formData,
        cache: 'no-cache'
    }).then(function(response){
        return response.json();
    }).then(function(responseJson){
        $('#modalCenter').modal('hide');
        window.location.replace(responseJson.redirect);
    }).catch(function(err){
        console.log("ERROR:::", err);
    });
});
