@extends('layouts.app')

@section('title', 'Product detail')

@section('scripts')

@endsection

@section('main')
<main class="container-fluid">
    <!--product photo and information-->
    <section class="row">
        <div class="col-lg-5">
            <button class="btn product p-0" type="button" data-toggle="modal" data-target="#showPhoto">
                <img class="w-100 mt-3" src="{{ asset('images/'.$product->src_image) }}" alt="Product image">
            </button>
        </div>
        <div class="col-lg-7">
            <div class="card mt-3 mx-5">
                <div class="card-body">
                    <h1 class=" card-title">{{ $product->name }}</h1>
                    <p class="text-muted">
                        @for($i = 0; $i < sizeof($brands); $i++)
                            @if ($i > 0)
                                |
                            @endif
                            {{ $brands[$i]->name }}
                        @endfor
                    </p>
                    <div class="row price mt-5">
                        <p class="old-price card-content mx-3">{{ $product->price }} €</p>
                        <p class="new-price card-content">7,50 €</p>
                    </div>
                    <p class="discount">Zľava <strong>50%</strong></p>
                    <div class="row">
                        <script type="text/javascript">
                            let variants = [];
                            @foreach($variants as $variant)
                                variants.push({ color: '{{ $variant->name }}', size: '{{ $variant->size }}'});
                            @endforeach

                            $(document).ready(function () {
                                let sizeContainter = document.getElementById("size_options");
                                let colorContainter = document.getElementById("color_options");

                                let sizeOptions  = Array.from(document.getElementsByClassName("size_option"));
                                let colorOptions = Array.from(document.getElementsByClassName("color_option"))

                                let sizeDropdown = document.getElementById("sizeButton");
                                let colorDropdown = document.getElementById("colorButton");

                                sizeOptions.forEach(option => option.addEventListener("click", () => {
                                    let size = option.innerHTML;
                                    sizeDropdown.innerHTML = size;
                                    let keepText = false;

                                    colorContainter.innerHTML = "";
                                    colorOptions.forEach(child =>
                                    {
                                        let keepChild = false;
                                        variants.forEach(variant =>
                                        {
                                            if (variant.color == child.innerHTML && variant.size == size)
                                            {
                                                keepChild = true;
                                                if (colorDropdown.innerHTML == variant.color)
                                                    keepText = true;
                                            }
                                        });
                                        if (keepChild) colorContainter.appendChild(child);
                                    });

                                    if (!keepText) colorDropdown.innerHTML = "Farba";
                                }));


                                colorOptions.forEach(option => option.addEventListener("click", () => {
                                    let color = option.innerHTML;
                                    colorDropdown.innerHTML = color;
                                    let keepText = false;

                                    sizeContainter.innerHTML = "";
                                    sizeOptions.forEach(child =>
                                    {
                                        let keepChild = false;
                                        variants.forEach(variant =>
                                        {
                                            if (variant.size == child.innerHTML && variant.color == color)
                                            {
                                                keepChild = true;
                                                if (sizeDropdown.innerHTML == variant.size)
                                                    keepText = true;
                                            }
                                        });
                                        if (keepChild) sizeContainter.appendChild(child);
                                    });

                                    if (!keepText) sizeDropdown.innerHTML = "Veľkosť";

                                    /*
                                    let color = option.innerHTML;
                                    colorDropdown.innerHTML = color;
                                    sizeDropdown.innerHTML = "Veľkosť";

                                    sizeContainter.innerHTML = "";
                                    sizeOptions.forEach(child => {
                                        variants.forEach(variant => {
                                            if (variant.size == child.innerHTML) {
                                                sizeContainter.appendChild(child);
                                                if (variant.color == color && sizeDropdown.innerHTML != "Veľkosť")
                                                    sizeDropdown.innerHTML = child.innerHTML;
                                            }

                                        })
                                    })
                                    */
                                }));
                            });
                        </script>

                        <div class="dropdown mx-3">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="colorButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Farba
                            </button>
                            <div class="dropdown-menu" id= "color_options" aria-labelledby="colorButton">
                                @foreach(array_unique(array_column($variants->toArray(), 'name')) as $color)
                                <p class="dropdown-item color_option">{{ $color }}</p>
                                @endforeach
                            </div>
                        </div>
                        <div class="dropdown mx-3">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="sizeButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Veľkosť
                            </button>
                            <div class="dropdown-menu" id = "size_options" aria-labelledby="sizeButton">
                                @foreach(array_unique(array_column($variants->toArray(), 'size')) as $size)
                                    <p class="dropdown-item size_option">{{ $size }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!--<div class="information mt-3">
                        <p>Zvolená farba: čierna</p>
                        <p>Zvolená veľkosť: M</p>
                    </div>-->
                    <div class="row">
                        <button type="button" class="btn btn-dark btn-lg m-3">Pridať do košíka</button>
                        <button class="bookmark"><img src="{{ asset('images/bookmark_b.svg') }}"
                                                      alt="Záložky" width="35" height="35">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="carousel-slide" class="d-none d-lg-block carousel slide" data-ride="carousel">
        <h3 class="mt-5">Podobné</h3>
        <ol class="carousel-indicators">
            <li data-target="#carouselSlide" data-slide-to="0" class="active"></li>
            <li data-target="#carouselSlide" data-slide-to="1"></li>
            <li data-target="#carouselSlide" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-2">
                            <a href="#" class="card p-2">
                                <div class="wish-icon">
                                    <img class="product-img w-100" src="../sources/klobuk.jpg" alt="Klobuk">
                                    <button class="btn"><img src="{{ asset('images/bookmark.svg') }}" alt="bookmark" width="35" height="35"></button>
                                </div>
                                <div class="card-body px-0">
                                    <h5 class="card-title">Čierny Klobúk</h5>
                                    <p class="card-text">5 €</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2">
                            <a href="#" class="card p-2">
                                <div class="wish-icon">
                                    <img class="product-img w-100" src="../sources/klobuk.jpg" alt="Klobuk">
                                    <button class="btn"><img src="../sources/bookmark.svg" alt="bookmark" width="35" height="35"></button>
                                </div>
                                <div class="card-body px-0">
                                    <h5 class="card-title">Čierny Klobúk</h5>
                                    <p class="card-text">5 €</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2">
                            <a href="#" class="card p-2">
                                <div class="wish-icon">
                                    <img class="product-img w-100" src="../sources/klobuk.jpg" alt="Klobuk">
                                    <button class="btn"><img src="../sources/bookmark.svg" alt="bookmark" width="35" height="35"></button>
                                </div>
                                <div class="card-body px-0">
                                    <h5 class="card-title">Čierny Klobúk</h5>
                                    <p class="card-text">5 €</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2">
                            <a href="#" class="card p-2">
                                <div class="wish-icon">
                                    <img class="product-img w-100" src="../sources/klobuk.jpg" alt="Klobuk">
                                    <button class="btn"><img src="../sources/bookmark.svg" alt="bookmark" width="35" height="35"></button>
                                </div>
                                <div class="card-body px-0">
                                    <h5 class="card-title">Čierny Klobúk</h5>
                                    <p class="card-text">5 €</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2">
                            <a href="#" class="card p-2">
                                <div class="wish-icon">
                                    <img class="product-img w-100" src="../sources/klobuk.jpg" alt="Klobuk">
                                    <button class="btn"><img src="../sources/bookmark.svg" alt="bookmark" width="35" height="35"></button>
                                </div>
                                <div class="card-body px-0">
                                    <h5 class="card-title">Čierny Klobúk</h5>
                                    <p class="card-text">5 €</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-2">
                            <a href="#" class="card p-2">
                                <div class="wish-icon">
                                    <img class="product-img w-100" src="../sources/šaty.jpg" alt="Klobuk">
                                    <button class="btn"><img src="../sources/bookmark.svg" alt="bookmark" width="35" height="35"></button>
                                </div>
                                <div class="card-body px-0">
                                    <h5 class="card-title">Indické šaty</h5>
                                    <p class="card-text">15 €</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2">
                            <a href="#" class="card p-2">
                                <div class="wish-icon">
                                    <img class="product-img w-100" src="../sources/šaty.jpg" alt="Klobuk">
                                    <button class="btn"><img src="../sources/bookmark.svg" alt="bookmark" width="35" height="35"></button>
                                </div>
                                <div class="card-body px-0">
                                    <h5 class="card-title">Indické šaty</h5>
                                    <p class="card-text">15 €</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2">
                            <a href="#" class="card p-2">
                                <div class="wish-icon">
                                    <img class="product-img w-100" src="../sources/šaty.jpg" alt="Klobuk">
                                    <button class="btn"><img src="../sources/bookmark.svg" alt="bookmark" width="35" height="35"></button>
                                </div>
                                <div class="card-body px-0">
                                    <h5 class="card-title">Indické šaty</h5>
                                    <p class="card-text">15 €</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2">
                            <a href="#" class="card p-2">
                                <div class="wish-icon">
                                    <img class="product-img w-100" src="../sources/šaty.jpg" alt="Klobuk">
                                    <button class="btn"><img src="../sources/bookmark.svg" alt="bookmark" width="35" height="35"></button>
                                </div>
                                <div class="card-body px-0">
                                    <h5 class="card-title">Indické šaty</h5>
                                    <p class="card-text">15 €</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2">
                            <a href="#" class="card p-2">
                                <div class="wish-icon">
                                    <img class="product-img w-100" src="../sources/šaty.jpg" alt="Klobuk">
                                    <button class="btn"><img src="../sources/bookmark.svg" alt="bookmark" width="35" height="35"></button>
                                </div>
                                <div class="card-body px-0">
                                    <h5 class="card-title">Indické šaty</h5>
                                    <p class="card-text">15 €</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carousel-slide" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-slide" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </section>
</main>

<!--product description-->
<article class="container-fluid mt-3 px-5">
    <h2>Popis produktu:</h2>
    <div class="row mx-3">
        <div class="col-lg-4">
            <h3 class="mx-3 mt-5">Materiály:</h3>
            <ul class="mx-3">
                @foreach($materials as $material)
                    <li>{{ $material->name }}</li>
                @endforeach
                <!--
                <li>Materiál: 100% Bavlna</li>
                <li>Druh materiálu: Hrubý úplet</li>
                <li>Krajina pôvodu: Čína</li>
                -->
            </ul>
            <!--
            <h3 class="mx-3 mt-5">Funkčnosť</h3>
            <ul class="mx-3">
                <li>Jesenná kolekcia</li>
                <li>Odolné proti vode</li>
                <li>Jednoferebné</li>
            </ul>
            -->
        </div>
        <div class="description col-lg-7 mt-5">
            <!--
            <p>Veľmi pútavý, príbeh o návrhu produktu nasledovaný dojímavým životným príbehom zakľadateľa/ov spoločnosti,
                ktorá  ho vyrobila.
                Pre miľovníkov životného prostredia malá, ale veľmi populárna vsuvka o ekologickosti výrobného procesu. Ale
                azíjske deti, ktoré sú platené minimum wage a svoju rodinu uvidia len na sviatky, sú takticky zamlčané.

                Akože on en popis ajtak nikto nečíta, takže je prakticky irelevantné ako veľmi sa autor textu pri jeho písaní opustil. Jediné užitočné informácie sú napríklad o vodeodolnosti materiálu alebo miery protišmykovosti podrážky.
            </p>
            -->
            <p>{{ $product->description }}</p>
        </div>
    </div>
</article>

<!--product photos carousel-->
<div class="modal fade" id="showPhoto" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="img">
        <div class="modal-content">
            <div class="modal-body">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @for($i = 0; $i < sizeof($images); $i++)
                            <div class="carousel-item @if($i == 0 ) active @endif">
                                <img class="d-block w-100" src="{{ asset('images/'.$images[$i]->src_image) }}" alt="Slide">
                            </div>
                        @endfor
                        <!--
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="../sources/klobuk1.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="../sources/klobuk2.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="../sources/klobuk3.jpg" alt="Third slide">
                        </div>
                        -->
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
