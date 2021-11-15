<header class="navbar navbar-expand-sm navbar-dark">
    <div class="collapse navbar-collapse mr-auto" id="navbar-content">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#">ŽENY</a>
            </li>
            <li class="nav-item">
                <a href="#">MUŽI</a>
            </li>
            <li class="nav-item">
                <a href="#">DETI</a>
            </li>
        </ul>
    </div>
    <!--title-->
    <a class="navbar-brand mx-auto" href="#">LOGO</a>
    <!--options bar search, login, bookmark, cart-->
    <ul class="navbar-nav ml-auto">
        <li><a data-toggle="collapse" href="#searchbar" role="button" aria-expanded="false" aria-controls="collapseExample">
                <img src="{{ asset('images/search.svg') }}"
                     alt="Vyhľadávanie produktov a ketogórií." width="35" height="35">
            </a></li>
        <li><div class="collapse collapse-horizontal" id="searchbar">
                <div class="input-group rounded">
                    <input type="search" class="form-control rounded mr-3" placeholder="Search" aria-label="Search"
                           aria-describedby="search-addon" />
                </div>
            </div></li>
        <li><a href="" class="btn p-0" data-toggle="modal" data-target="#modal_login_register">
                <img src="{{ asset('images/login.svg') }}"
                     alt="Prihlásenie alebo registrácia" width="35" height="35">
            </a></li>
        <li><a href="#">
                <img src="{{ asset('images/bookmark.svg') }}"
                     alt="Záložky" width="35" height="35">
            </a></li>
        <li><a href="../shoppingCart/cart.html">
                <img src="{{ asset('images/shopping_cart.svg') }}"
                     alt="Nákupný košík" width="35" height="35">
            </a></li>
    </ul>
</header>
