@extends('layouts.app')

@section('title', 'Cart')

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
    <script src="{{ asset('js/cart.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/cart_style.css') }}">
@endsection

@section('main')
    <!--stepper-->
    <main id="CartStepper" class="bs-stepper">
        <div class="bs-stepper-header" role="tablist">
            <div class="d-none d-sm-block step" data-target="#content1">
                <button type="button" class="step-trigger" role="tab" id="CartSteppertrigger1" aria-controls="content1">
                    <span class="bs-stepper-circle">1</span>
                    <span class="bs-stepper-label">Nákupný košík</span>
                </button>
            </div>
            <div class="d-none d-md-block bs-stepper-line"></div>
            <div class="d-none d-sm-block step" data-target="#content2">
                <button type="button" class="step-trigger" role="tab" id="CartSteppertrigger2" aria-controls="content2">
                    <span class="bs-stepper-circle">2</span>
                    <span class="bs-stepper-label">Doprava a platba</span>
                </button>
            </div>
            <div class="d-none d-md-block bs-stepper-line"></div>
            <div class="d-none d-sm-block step" data-target="#content3">
                <button type="button" class="step-trigger" role="tab" id="CartSteppertrigger3" aria-controls="content3">
                    <span class="bs-stepper-circle">3</span>
                    <span class="bs-stepper-label">Informácie</span>
                </button>
            </div>
            <div class="d-none d-md-block bs-stepper-line"></div>
            <div class="d-none d-sm-block step" data-target="#content4">
                <button type="button" class="step-trigger" role="tab" id="CartSteppertrigger4" aria-controls="content4">
                    <span class="bs-stepper-circle">4</span>
                    <span class="bs-stepper-label">Zhrnutie</span>
                </button>
            </div>
        </div>
        <div class="bs-stepper-content">
            <form onSubmit="return false">
                <!--Shopping cart-->
                <div id="content1" role="tabpanel" class="bs-stepper-pane container-fluid" aria-labelledby="CartSteppertrigger1">
                    <div class="row">
                        <!--product in cart information-->
                        <section class="col-lg-9 col-md-12">
                            @foreach($products as $product)
                            <div class="card flex-row p-3 m-5">
                                <div class="row">
                                    <img class="img-product ml-3" src="{{ asset('images/'.$product[0]->src_image) }}" alt="{{$product[0]->name}}" />
                                    <div class="card-basic p-0 mx-5">
                                        <h5 class="card-title">{{$product[0]->name}}</h5>
                                        <p class="card-text">Veľkosť: univerzálna</p>
                                        <p class="card-text">Farba: čierna</p>
                                        <p class="card-text">{{$product[0]->price}} €</p>
                                    </div>
                                    <div class="card-count p-0 mx-5">
                                        <label for="count1" class="card-text m-0">Počet:</label>
                                        <input class="count" id="count1" type="number" value="{{$product[1]}}" min="1" max="1000" step="1" />
                                        <form action="{{url('cart', $product[0])}}" method="post">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{ csrf_field() }}
                                            <input type="hidden", name="product", value="{{$product[0]->id}}">
                                            <input type="submit" class="btn btn-outline-secondary mt-5" value="Odobrať"/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </section>
                        <!--contact, sale code, summary-->
                        <aside class="col-lg-3 col-md-12 mt-5">
                            <div class="card p-2">
                                <div class="card-body">
                                    <h5 class="card-title">Kontakt</h5>
                                    <h6>E-mail:</h6>
                                    <p>objednavky@wtechshop.sk</p>
                                    <h6>Telefón</h6>
                                    <p>+421 917 819 325</p>
                                </div>
                            </div>

                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Zľavový kód">
                                <button class="btn btn-outline-secondary" type="button">Potvrdiť</button>
                            </div>
                            <div class="card p-2">
                                <div class="card-body">
                                    <h5 class="card-title">Celková suma</h5>
                                    <p>Spolu: {{$price}} €</p>
                                    <p>Zľavy: 0 €</p>
                                    <p class="font-weight-bold">Celková cena: {{$price}} €</p>
                                    <p>Celková cena bez DPH: {{$tax_free}} €</p>
                                    <form action="{{url('cart', [$product[0]->id])}}" method="POST">
                                        <input type="hidden" name="_method" value="PUT">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-primary btnNext" type="button">Ďalej</button>
                                    </form>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>

                <!--delivery and payment-->
                <div id="content2" role="tabpanel" class="bs-stepper-pane container-fluid" aria-labelledby="CartSteppertrigger2">
                    <div class="row">
                        <section class="col-md-8">
                            <div class="card mb-3">
                                <h5>Zvoľte spôsob dopravy:</h5>
                                <div class="form-check">
                                    <input class="form-check-input deliveryRadio" type="radio" name="ragioDelivery" id="delivery_courier_radio" checked>
                                    <label class="form-check-label" for="delivery_courier_radio">Kuriérom na adresu:</label>
                                    <label class="form-check-label" id="delivery_courier_price" for="delivery_courier_radio">3,99 €</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input deliveryRadio" type="radio" name="ragioDelivery" id="delivery_postoffice_radio">
                                    <label class="form-check-label" for="delivery_postoffice_radio">Balík na poštu:</label>
                                    <label class="form-check-label" id="delivery_postoffice_price" for="delivery_postoffice_radio">2,60 €</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input deliveryRadio" type="radio" name="ragioDelivery" id="delivery_inperson_radio">
                                    <label class="form-check-label" for="delivery_inperson_radio">Osobne na predajni:</label>
                                    <label class="form-check-label" id="delivery_inperson_price" for="delivery_inperson_radio">0,00 €</label>
                                </div>
                            </div>

                            <div class="card">
                                <h5>Zvoľte spôsob platby:</h5>
                                <div class="form-check">
                                    <input class="form-check-input paymentRadio" type="radio" name="radioPayment" id="payment_transfer_radio" checked>
                                    <label class="form-check-label" for="payment_transfer_radio">Prevodom na účet:</label>
                                    <label class="form-check-label" id="payment_transfer_price" for="payment_transfer_radio">0,00 €</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input paymentRadio" type="radio" name="radioPayment" id="payment_card_radio">
                                    <label class="form-check-label" for="payment_card_radio">Kartou online:</label>
                                    <label class="form-check-label" id="payment_card_price" for="payment_card_radio">0,00 €</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input paymentRadio" type="radio" name="radioPayment" id="payment_inperson_radio">
                                    <label class="form-check-label" for="payment_inperson_radio">Na dobierku:</label>
                                    <label class="form-check-label" id="payment_inperson_price" for="payment_inperson_radio">0,50 €</label>
                                </div>
                            </div>
                        </section>
                        <aside class="col-md-4">
                            <div class="card p-2">
                                <div class="card-body">
                                    <h5 class="card-title">Kontakt</h5>
                                    <h6>E-mail:</h6>
                                    <p>objednavky@wtechshop.sk</p>
                                    <h6>Telefón</h6>
                                    <p>+421 917 819 325</p>
                                </div>
                            </div>

                            <div class="card p-2">
                                <div class="card-body">
                                    <h5 class="card-title">Celková suma</h5>
                                    <p>Celkom za tovar: 322,32 €</p>
                                    <p id="deliveryFee"></p><!--Doprava: +3,99 €</p>-->
                                    <p id="paymentFee"></p><!--Platba:  +0,00 €</p>-->
                                    <p class="font-weight-bold">Celková cena: 326,31 €</p>
                                    <p>Celková cena bez DPH: 271,93 €</p>
                                    <div class="row">
                                        <button class="btn btn-primary btnPrev mx-3" type="button">Späť</button>
                                        <button class="btn btn-primary btnNext ml-3" type="button">Ďalej</button>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>

                <!--personal and delivery information-->
                <div id="content3" role="tabpanel" class="bs-stepper-pane container-fluid" aria-labelledby="CartSteppertrigger4">
                    <div class="row">
                        <section class="col-md-8">
                            <h5>Osobné údaje:</h5>
                            <div class="md-form mb-5">
                                <label data-error="wrong" data-success="right" for="personalInfoFirstName">Meno:</label>
                                <input type="text" id="personalInfoFirstName" class="form-control validate">
                            </div>
                            <div class="md-form mb-5">
                                <label data-error="wrong" data-success="right" for="personalInfoLastName">Priezvisko:</label>
                                <input type="text" id="personalInfoLastName" class="form-control validate">
                            </div>
                            <div class="md-form mb-5">
                                <label data-error="wrong" data-success="right" for="personalInfoPhone">Telefón:</label>
                                <input type="tel" id="personalInfoPhone" class="form-control validate">
                            </div>
                            <div class="md-form mb-5">
                                <label data-error="wrong" data-success="right" for="personalInfoEmail">E-mail:</label>
                                <input type="email" id="personalInfoEmail" class="form-control validate">
                            </div>

                            <h5>Doručovania adresa:</h5>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="personalInfoCountry" data-toggle="dropdown" aria-expanded="false">
                                    Krajina
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <p class="dropdown-item country">Slovensko</p><!--style="user-select:none"-->
                                    <p class="dropdown-item country">Maďarsko</p>
                                    <p class="dropdown-item country">Zimbabwe</p>
                                </div>
                            </div>
                            <div class="md-form mb-5">
                                <label data-error="wrong" data-success="right" for="personalInfoCity">Mesto:</label>
                                <input type="text" id="personalInfoCity" class="form-control validate">
                            </div>
                            <div class="md-form mb-5">
                                <label data-error="wrong" data-success="right" for="personalInfoStreet">Ulica + popisné číslo:</label>
                                <input type="text" id="personalInfoStreet" class="form-control validate">
                            </div>
                            <div class="md-form mb-5">
                                <label data-error="wrong" data-success="right" for="personalInfoPSC">PSČ:</label>
                                <input type="text" id="personalInfoPSC" class="form-control validate">
                            </div>

                            <h5>Fakturačná adresa (len ak je iná ako doručovacia):</h5>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="personalInfoCountry2" data-toggle="dropdown" aria-expanded="false">
                                    Krajina
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <p class="dropdown-item country2">Slovensko</p>
                                    <p class="dropdown-item country2">Maďarsko</p>
                                    <p class="dropdown-item country2">Zimbabwe</p>
                                </div>
                            </div>
                            <div class="md-form mb-5">
                                <label data-error="wrong" data-success="right" for="personalInfoCity2">Mesto:</label>
                                <input type="text" id="personalInfoCity2" class="form-control validate">
                            </div>
                            <div class="md-form mb-5">
                                <label data-error="wrong" data-success="right" for="personalInfoStreet2">Ulica + popisné číslo:</label>
                                <input type="text" id="personalInfoStreet2" class="form-control validate">
                            </div>
                            <div class="md-form mb-5">
                                <label data-error="wrong" data-success="right" for="personalInfoPSC2">PSČ:</label>
                                <input type="text" id="personalInfoPSC2" class="form-control validate">
                            </div>
                        </section>
                        <aside class="col-md-4">
                            <div class="card p-2">
                                <div class="card-body">
                                    <h5 class="card-title">Kontakt</h5>
                                    <h6>E-mail:</h6>
                                    <p>objednavky@wtechshop.sk</p>
                                    <h6>Telefón</h6>
                                    <p>+421 917 819 325</p>
                                </div>
                            </div>

                            <div class="card p-2">
                                <div class="card-body">
                                    <h5 class="card-title">Celková suma</h5>
                                    <p class="font-weight-bold">Celková cena: 322,32 €</p>
                                    <p>Celková cena bez DPH: 258,60 €</p>
                                    <div class="row">
                                        <button class="btn btn-primary btnPrev mx-3" type="button">Späť</button>
                                        <button class="btn btn-primary btnNext ml-3" type="button">Ďalej</button>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>

                <!--summary-->
                <div id="content4" role="tabpanel" class="bs-stepper-pane container-fluid" aria-labelledby="CartSteppertrigger4">
                    <div class="row">
                        <section class="col-md-8">

                        </section>
                        <aside class="col-md-4">
                            <div class="card p-2">
                                <div class="card-body">
                                    <h5 class="card-title">Kontakt</h5>
                                    <h6>E-mail:</h6>
                                    <p>objednavky@wtechshop.sk</p>
                                    <h6>Telefón</h6>
                                    <p>+421 917 819 325</p>
                                </div>
                            </div>

                            <div class="card p-2">
                                <div class="card-body">
                                    <h5 class="card-title">Celková suma</h5>
                                    <p class="font-weight-bold">Celková cena: 322,32 €</p>
                                    <p>Celková cena bez DPH: 258,60 €</p>

                                    <div class="row">
                                        <input class="mt-2" type="checkbox" id="bussinessTermsCheckbox">
                                        <label>Súhlasím s obchodnými podmienkami</label>
                                    </div>

                                    <div class="row">
                                        <button class="btn btn-primary btnPrev mx-3" type="button">Späť</button>
                                        <button class="btn btn-primary btnNext ml-3" type="button">Potvdiť</button>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection

