var listCheckoutItems = document.getElementById('list-checkout-items')      ;
var cartCountBadge    = document.getElementById('cart-count-badge'   )      ;
var totalItemPrice    = document.getElementById('total-item-price'   )      ;
var formInfo          = document.getElementById('form-data'          )      ;
var firstName         = document.getElementById('firstName'          )      ;
var lastName          = document.getElementById('lastName'           )      ;
var email             = document.getElementById('email'              )      ;
var address           = document.getElementById('address'            )      ;
var address2          = document.getElementById('address2'           )      ;
var state             = document.getElementById('state'              )      ;
var zip               = document.getElementById('zip'                )      ;
var shippingItems     = document.getElementById('shipping-items'     )      ;
var formData          = new FormData()                                      ;
var responseHTML      =''                                                   ;
var cartCount         = 0                                                   ;
var description = "Compra de productos: "                                   ;
var productsToSucceed = new Array();
var pricesToSucceed   = new Array();
var totalToSucceed    = '';
//Cart Information
var cartInformation = fetch('../Cart/actionCart.php').then(function(response){
    return response.json();
}).then(function(responseJson){
    responseJson.forEach(element => {
        if(element.pQ > element.st){
            window.location.replace('../Cart/?err=14&p='+element.pName);
        }else{
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
        description += '('+ cartCount + ') id:' + element.idp;
        productsToSucceed.push('( ' +element.pQ+ ' ) '+element.pName); 
        pricesToSucceed.push('$'+element.pPrice*element.pQ); 
        }
    });
    formData.append('description1', description);
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
    if(parseFloat(total).toFixed(2) < 45.0){
        shippingItems.innerHTML = `
        <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
                <h6 class="my-0">Envio</h6>
            </div>
            <span>+$`+ responseJson.shipping +`</span>
        </li>
        `;
    }
    total = parseFloat(total).toFixed(2).toString().replace('.','');
    totalToSucceed = responseJson.totalItemPrice;
    formData.append('total', total);
}).catch(function(err){
    console.log(err);
})

//Submit
//Fetch
var submitDataToCheckout = () =>{
    if(formInfo.reportValidity()){
        $('#buttonData').html(`
        <i class="fa fa-credit-card"></i> Continuar Pago <img src='../uploads/loadpay.svg' width="5%" />
            
            `);

            var submitData = fetch('./pay-process.php',{
            method: 'POST',
            body: formData,
            cache: 'no-cache'
        }).then(function(response){
            return response.json();
        }).then(function(responseJson){
            $('#buttonData').html(`
        <i class="fa fa-credit-card"></i> Continuar Pago
            
            `);
            getPayData(firstName.value, lastName.value, address.value, address2.value, zip.value, email.value, state.value, responseJson.client_secret);
            $('#modalCenter').modal('show');
        }).catch(function(err){
            alert('Ocurrio un error inesperado.');
        })
    }else{
        formInfo.reportValidity();
    }
   
}

var getPayData = (firstName, lastName, address, address2, zip, email,state, _clientSecret) => {
    var stripe    = Stripe('pk_test_7NGKE6jvVPbl7nbWvXhIs4XQ00Q8ebNTgm');
    var elements  = stripe.elements();
    var submitBtn = document.getElementById('submit'); 
    var style = {
        base: {
            color: "#32325d",
            }
        };
        var card = elements.create("card", { style: style });
        card.mount("#card-element");
        
        card.addEventListener('change', function(event){
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        })

        var clientSecret = _clientSecret;

        var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(ev) {
                ev.preventDefault();
                $('#submit').html(`
                                <img src='../uploads/loadpay.svg' width="10%" />
                            `);
                    stripe.confirmCardPayment(clientSecret, {
                        payment_method: {
                            card: card,
                            billing_details: {
                                name    : firstName.trim()+' '+lastName.trim(),
                                address : {
                                    country     : 'US',
                                    line1       : address.trim(),
                                    line2       : address2.trim(),
                                    postal_code : zip.trim(),
                                    state       : state.trim()
                                },
                                email: email.trim()
                            }
                        }
                    }).then(function(result) {
                        if (result.error) {
                            // Show error to your customer (e.g., insufficient funds)
                            console.log(result.error.message);
                            $('#submit').html(`
                                <i class="fa fa-credit-card"></i> Pay
                            `);
                        } else {
                            // The payment has been processed!
                            if (result.paymentIntent.status === 'succeeded') {
                                $('#submit').html(`
                                <div class="loadPay">
                                    SUCCEEDED!
                                </div>
                                `);
                                var cartAction = fetch('../Cart/actionCart.php').then(function(response){
                                    return response.json();
                                }).then(function(responseJson){
                                    var cartObj = '';
                                    responseJson.forEach(element => {
                                        cartObj = element;
                                    });
                                    var formDataToSucceeded = new FormData();
                                    formDataToSucceeded.append('name', firstName.trim() + ' ' + lastName.trim());
                                    formDataToSucceeded.append('email', email.trim());
                                    formDataToSucceeded.append('products', JSON.stringify(Object.assign({}, productsToSucceed)));
                                    formDataToSucceeded.append('prices', JSON.stringify(Object.assign({}, pricesToSucceed)));
                                    formDataToSucceeded.append('total', totalToSucceed);
                                    formDataToSucceeded.append('msg', 'success');
                                    //Fetch the cart
                                    fetch('./redirect.php',{
                                        method: 'POST',
                                        body: formDataToSucceeded,
                                        cache: 'no-cache'
                                    }).then(function(response){
                                        return response.json(); 
                                    }).then(function(responseJson){
                                        window.location.replace(responseJson.redirect);
                                    }).catch(function(err){
                                        console.log('error al redireccionar', err);
                                    })
                                }).catch(function(err){
                                    console.log(err);
                                });
                                console.log('Stripe result: ',result);
                            }else{
                                console.log(result.paymentIntent.status);
                            }
                        }
                    });
        });  
    }

    
