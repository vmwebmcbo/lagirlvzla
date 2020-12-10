<?php
    include '../../php/comManager.php';
    session_start();
    $manager                = new Manager()              ;
    $conn                   = OpenCon()                  ;
    if(empty($_SESSION['cart'])){
        header('location:../');
    }
    if($conn == true){
      $getAllCategories_res   = $manager->getCategorias()  ;
    }else{
      header("Location:../../404.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Checkout</title>
    <!-- Required meta tags always come first -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- css -->
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/main.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <!--BOOTSTRAP-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--FONT AWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.6/css/flag-icon.min.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:800&display=swap" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body>
    
<div class="loader"></div>
    <nav  class="navbar sticky-top navbar-expand-lg navbar-light bg-white">
        <a  class="row justify-content-center mt-2" href="#">
          <img src="../../imgProducts/logoRounded.png" id="logoHeader" alt="AGUA DE MAYO">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto align-self-center">
                <li class="nav-item active">
                    <a id="navBarBootstrap" class="nav-link" href="../">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a id="navBarBootstrap" class="nav-link" href="../Details/All">Products</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navBarBootstrap" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categories
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                            foreach ($conn->query($getAllCategories_res) as $categoria) {
                                echo '<a id="navBarBootstrap" class="dropdown-item" href="../Details/All?idc='.$categoria['id_categoria'].'">' . $categoria['nombre'] . '</a>';
                            }
                        ?>
                    </div>
                </li>
            </ul>
            <a id="" style="font-size: 20pt; color:#343a5f; " class="navbar-brand" href="#">
                    <i class="fab fa-instagram"></i>
            </a>
        </div>
        <a id="shoppingCart" class="navbar-brand" href="../Cart/">
                <i class="fas fa-shopping-cart"></i>
                <span class="badge badge-secondary" id="cartCount"></span>
        </a>
    </nav>
    <main id="main" role="main">
        <section id="checkout-container">
            <div class="container">
                <div class="row py-5">
                    <div class="col-md-4 order-md-2 mb-4">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Your Shopping Cart</span>
                            <span class="badge badge-secondary badge-pill" id="cart-count-badge"></span>
                        </h4>
                        <ul class="list-group mb-3">
                            <!--Products On Bill-->
                            <div id='list-checkout-items'>

                            </div>
                            <div id="shipping-items" style="color: #43bd17;">

                            </div>
                            <!--Promo Code-->
                            <!--<li class="list-group-item d-flex justify-content-between bg-light">
                                <div class="text-success">
                                    <h6 class="my-0">Promo code</h6>
                                    <small>EXAMPLECODE</small>
                                </div>
                                <span class="text-success">-$5</span>
                            </li>-->
                            <!--TOTAL-->
                            <li style="color: #fff; background-color: #60297d;" class="list-group-item d-flex justify-content-between">
                                <span>Total (USD)</span>
                                <strong id="total-item-price"></strong>
                            </li>
                        </ul>
                        <!--<form class="card p-2">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Promo code">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-secondary">Redeem</button>
                                </div>
                            </div>
                        </form>-->
                        <!--
                        <div class="payment-methods">
                            <p class="pt-4 mb-2">Payment Options</p>
                            <hr>
                            <ul class="list-inline d-flex">
                                <li class="mx-1 text-info">
                                    <i class="fa-2x fa fa-cc-visa"></i>
                                </li>
                                <li class="mx-1 text-info">
                                    <i class="fa-2x fa fa-cc-stripe"></i>
                                </li>
                                <li class="mx-1 text-info">
                                    <i class="fa-2x fa fa-cc-paypal"></i>
                                </li>
                                <li class="mx-1 text-info">
                                    <i class="fa-2x fa fa-cc-jcb"></i>
                                </li>
                                <li class="mx-1 text-info">
                                    <i class="fa-2x fa fa-cc-discover"></i>
                                </li>
                                <li class="mx-1 text-info">
                                    <i class="fa-2x fa fa-cc-amex"></i>
                                </li>
                            </ul>
                        </div>-->
                    </div>
                    <div class="col-md-8 order-md-1">
                        <h4 class="mb-3">Billing address</h4>
                        <form id="form-data" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">First name</label>
                                    <input type="text" class="form-control" name="firstName" id="firstName" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Valid first name is required.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName">Last name</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Valid last name is required.
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" required class="form-control" id="email" placeholder="you@example.com" >
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="address">Address</label>
                                <input type="text" required class="form-control" id="address" placeholder="1234 Main St" >
                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="address2">Address 2
                                    <span class="text-muted">(Optional)</span>
                                </label>
                                <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="state">State</label>
                                    <select  required class="custom-select d-block w-100" id="state">
                                        <option value="">Elegir...</option>
                                        <option value="AL">Alabama</option>
                                        <option value="AK">Alaska</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="CA">California</option>
                                        <option value="CO">Colorado</option>
                                        <option value="CT">Connecticut</option>
                                        <option value="DE">Delaware</option>
                                        <option value="DC">District Of Columbia</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="ID">Idaho</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IN">Indiana</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="ME">Maine</option>
                                        <option value="MD">Maryland</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MI">Michigan</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NV">Nevada</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="NY">New York</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="OH">Ohio</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="OR">Oregon</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="TX">Texas</option>
                                        <option value="UT">Utah</option>
                                        <option value="VT">Vermont</option>
                                        <option value="VA">Virginia</option>
                                        <option value="WA">Washington</option>
                                        <option value="WV">West Virginia</option>
                                        <option value="WI">Wisconsin</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please provide a valid state.
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="zip">Zip</label>
                                    <input required type="text" class="form-control" id="zip" placeholder="" >
                                    <div class="invalid-feedback">
                                        Zip code required.
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-4">
                            <!--<div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="same-address">
                                <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="save-info">
                                <label class="custom-control-label" for="save-info">Save this information for next time</label>
                            </div>
                            <hr class="mb-4">-->

                            
                            <button style="color: #fff; background-color: #60297d;" id="buttonData" class="btn btn-primary btn-lg btn-block" type="button" onclick="submitDataToCheckout()">
                                        <i class="fa fa-credit-card"></i> Continue Checkout
                            </button>
                        </form>
                        <output></output>
                        <!-- MODAL -->
                        <div class="modal fade" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Pay</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="modalHere">
                                    <form id="payment-form">
                                        <small>Confirm your information and complete your payment process</small>
                                        <ul class="list-group mb-3">
                                            <div id="confirm-your-data">
                                                
                                            </div>
                                        </ul>
                                        <div id="card-element">
                                            <!-- Elements will create input elements here -->
                                        </div>

                                        <!-- We'll put the error messages in this element -->
                                        <div id="card-errors" role="alert"></div>

                                        <hr class="mb-4">
                                        <button id="submit" class="btn btn-primary btn-lg btn-block">
                                            <i class="fa fa-credit-card"></i> Pay
                                        </button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </div>
                                </div>
                             </div>
                            </div>
                    </div>
                </div>
            </div>
        </section>
        <a href="#" class="btn btn-primary scrollUp">
            <i class="fa fa-arrow-circle-o-up"></i>
        </a>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/d5631b4b09.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="../../js/main.min.js"></script>
    
    <script src="../../js/pay-us.js"></script>

</body>

</html>