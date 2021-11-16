@extends('layouts.app')

@section('title', 'Brands')

@section('scripts')
    <link rel="stylesheet" href="{{ asset('css/products_style.css') }}">
@endsection

@section('main')
<main class="wrapper">
    <div class="container-fluid m-0 mt-5">
        <div class="row">
            <!--sidebar-->
            <aside class="d-none d-md-block col-xl-2 col-lg-3 col-md-4">
                <div class="sidebar">
                    <a href="#" class="sidebar-title"><h5>{{$data['name']}}</h5></a>
                    <ul class="sidebar-items">
                        @foreach($data['brandslist'] as $brand)
                            <li><a class="item" href="#">{{ $brand->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </aside>
            <!--products-->
            <section class="col-xl-10 col-lg-9 col-md-8">
                <h1>{{$data['name']}}</h1>
                <!--filters-->
                <div class="filter m-3">
                    <div class="row">
                        <div class="dropdown mr-3 mb-2">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Zoradiť
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item m-0" href="#">Od najlacnejších</a>
                                <a class="dropdown-item m-0" href="#">Od najdrahších</a>
                                <a class="dropdown-item m-0" href="#">A - Z</a>
                                <a class="dropdown-item m-0" href="#">Z - A</a>
                            </div>
                        </div>
                        <div class="dropdown mr-3 mb-2">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Cena
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <form class="ml-3">
                                    <label for="lowest-price">Najnižšia cena v €</label>
                                    <input id="lowest-price" type="number" value="0" min="0" max="1000" step="1" />
                                    <label for="highest-price">Najvyššia cena v €</label>
                                    <input id="highest-price" type="number" value="0" min="0" max="1000" step="1" />
                                </form>
                                <button type="button" class="btn btn-secondary ml-3">Potvrdiť</button>
                            </div>
                        </div>
                        <div class="dropdown mr-3 mb-2">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Veľkosť
                            </button>
                            <div class="brand dropdown-menu" aria-labelledby="size-selection">
                                <form class=" color-list mx-2">
                                    <input type="checkbox" id="xs" value="xs">
                                    <label for="xs">XS</label><br>
                                    <input type="checkbox" id="s" value="s">
                                    <label for="s">S</label><br>
                                    <input type="checkbox" id="m" value="m">
                                    <label for="m">M</label><br>
                                    <input type="checkbox" id="l" value="l">
                                    <label for="l">L</label><br>
                                    <input type="checkbox" id="xl" value="xl">
                                    <label for="xl">XL</label><br>
                                </form>
                            </div>
                        </div>
                        <div class="dropdown mr-3 mb-2">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Farba
                            </button>
                            <div class="brand dropdown-menu pre-scrollable" aria-labelledby="color-selection">
                                <form class=" color-list mx-2">
                                    <input type="checkbox" id="red" value="red">
                                    <label for="red">Červená</label><br>
                                    <input type="checkbox" id="black" value="black">
                                    <label for="black">Čierna</label><br>
                                    <input type="checkbox" id="yellow" value="yellow">
                                    <label for="yellow">Žltá</label><br>
                                    <input type="checkbox" id="blue" value="blue">
                                    <label for="blue">Modrá</label><br>
                                    <input type="checkbox" id="white" value="white">
                                    <label for="white">Biela</label><br>
                                    <input type="checkbox" id="pink" value="pink">
                                    <label for="pink">Ružová</label><br>
                                </form>
                            </div>
                        </div>
                        <div class="dropdown mr-3 mb-2">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Značka
                            </button>
                            <div class="brand dropdown-menu pre-scrollable" aria-labelledby="brand-selection">
                                <form class=" brand-list mx-2">
                                    <input type="checkbox" id="brand 1" value="adidas">
                                    <label for="brand 1">Adidas</label><br>
                                    <input type="checkbox" id="brand 2" value="nike">
                                    <label for="brand 2">Nike</label><br>
                                    <input type="checkbox" id="brand 3" value="puma">
                                    <label for="brand 3">Puma</label><br>
                                    <input type="checkbox" id="brand 4" value="Gucci">
                                    <label for="brand 4">Gucci</label><br>
                                    <input type="checkbox" id="brand 5" value="the north face">
                                    <label for="brand 5">The North Face</label><br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--all product on the page-->
                <div class="row">
                    <!--Product -->
                    <div class="product col-sm-12 col-md-6 col-lg-4 col-xl-3">
                        <a href="#" class="single-product">
                            <div class="wish-icon">
                                <img class="product-img w-100" src="../sources/klobuk1.jpg" alt="Klobuk">
                                <button class="btn"><img src="../sources/bookmark.svg" alt="bookmark" width="35" height="35"></button>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title">Autumn&style štýlový klobúk</h3>
                                <h4 class="product-old-price">15 €</h4>
                                <h4 class="product-price">7,50 €</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <nav class="pager" aria-label="page navigation">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
</main>
@endsection
