<?php
use App\Models\FirstLevelCategory;
use App\Models\SecondLevelCategory;
use App\Models\ThirdLevelCategory;
use App\Models\Brand;
?>

<nav class="navbar navbar-expand-md navbar-dark" id="categories">
    <!--make menu button if screen smaller than lg-->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar-content2">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class='nav-title' href="#">Akcia</a>
            </li>
            <li class="nav-item">
                <a class='nav-title' href="#">Novinky</a>
            </li>
            <li class="nav-item dropdown">
                <a data-target="{{ url('brands') }}" class="ndropdown-toggle nav-title" href="{{ url('brands') }}" id="brands" aria-haspopup="true" aria-expanded="false">
                    Značky
                </a>
                <div class="brand dropdown-menu pre-scrollable" aria-labelledby="brands">
                    <?php $brands = Brand::orderby('name')->get() ?>
                    @foreach($brands as $brand)
                        <a href="{{ url('brands', $brand->id ) }}">{{$brand->name}}</a>
                    @endforeach
                </div>
            </li>
            <?php
                $firstLevelCategories = FirstLevelCategory::all();
                foreach($firstLevelCategories as $cat1)
                {
                    echo '<li class="nav-item dropdown">';
                    echo '<a data-target="';
                    echo url("categories", $cat1->name );
                    echo '" class="ndropdown-toggle nav-title" href="';
                    echo url("categories", $cat1->name );
                    echo '" id="';
                    echo $cat1->name;
                    echo '" aria-haspopup="true" aria-expanded="false">';
                    echo $cat1->name;
                    echo '</a>';
                    echo '<div class="dropdown-menu dropdown-multicolumn p-0" aria-labelledby="';
                    echo $cat1->name;
                    echo '">';

                    $secondLevelCategories = SecondLevelCategory::where('1st_level_category_id', $cat1->id)->get();
                    foreach($secondLevelCategories as $cat2)
                    {
                        echo '<div class="dropdown-col">';
                        echo '<a href="';
                        echo url("categories", $cat2->name );
                        echo '" class="dropdown-item category-title">';
                        echo $cat2->name;
                        echo '</a>';


                        $thirdLevelCategories = ThirdLevelCategory::where('2nd_level_category_id', $cat2->id)->get();
                        foreach ($thirdLevelCategories as $cat3)
                        {
                            echo '<a href="';
                            echo url("categories", $cat3->name );
                            echo '" class="dropdown-item category-item">';
                            echo $cat3->name;
                            echo '</a>';
                        }
                        echo '</div>';
                    }
                    echo '</div>';
                    echo '</li>';
                }
            ?>
            <!--
            <li class="nav-item dropdown">
                <a href="#" id="clothes" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    OBLEČENIE
                </a>
                <div class="dropdown-menu dropdown-multicolumn p-0" aria-labelledby="clothes">
                    <div class="dropdown-col">
                        <a href="#" class="dropdown-item category-title">Nohavice</a>
                        <a href="#" class="dropdown-item category-item">Rifle</a>
                        <a href="#" class="dropdown-item category-item">Voľný čas</a>
                        <a href="#" class="dropdown-item category-item">Turistické</a>
                        <a href="#" class="dropdown-item category-item">Bežecké</a>
                    </div>
                    <div class="dropdown-col">
                        <a href="#" class="dropdown-item category-title">Bundy</a>
                        <a href="#" class="dropdown-item category-item">Zimné</a>
                        <a href="#" class="dropdown-item category-item">Jesenné</a>
                        <a href="#" class="dropdown-item category-item">Športové</a>
                    </div>
                    <div class="dropdown-col">
                        <a href="#" class="dropdown-item category-title">Nohavice</a>
                        <a href="#" class="dropdown-item category-item">Rifle</a>
                        <a href="#" class="dropdown-item category-item">Voľný čas</a>
                        <a href="#" class="dropdown-item category-item">Turistické</a>
                        <a href="#" class="dropdown-item category-item">Bežecké</a>
                    </div>
                    <div class="dropdown-col">
                        <a href="#" class="dropdown-item category-title">Nohavice</a>
                        <a href="#" class="dropdown-item category-item">Rifle</a>
                        <a href="#" class="dropdown-item category-item">Voľný čas</a>
                        <a href="#" class="dropdown-item category-item">Turistické</a>
                        <a href="#" class="dropdown-item category-item">Bežecké</a>
                    </div>
                    <div class="dropdown-col">
                        <a href="#" class="dropdown-item category-title">Nohavice</a>
                        <a href="#" class="dropdown-item category-item">Rifle</a>
                        <a href="#" class="dropdown-item category-item">Voľný čas</a>
                        <a href="#" class="dropdown-item category-item">Turistické</a>
                        <a href="#" class="dropdown-item category-item">Bežecké</a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a href="#" id="shoes" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    OBUV
                </a>
                <div class="dropdown-menu dropdown-multicolumn p-0" aria-labelledby="shoes">
                    <div class="dropdown-col">
                        <a href="#" class="dropdown-item category-title">Letná obuv</a>
                        <a href="#" class="dropdown-item category-item">Šľapky</a>
                        <a href="#" class="dropdown-item category-item">Sandále</a>
                        <a href="#" class="dropdown-item category-item">Balerínky</a>
                    </div>
                    <div class="dropdown-col">
                        <a href="#" class="dropdown-item category-title">Šport</a>
                        <a href="#" class="dropdown-item category-item">Futbal</a>
                        <a href="#" class="dropdown-item category-item">Beh</a>
                        <a href="#" class="dropdown-item category-item">Basketbal</a>
                        <a href="#" class="dropdown-item category-item">Turistické</a>
                        <a href="#" class="dropdown-item category-item">Lezecké</a>
                    </div>
                    <div class="dropdown-col">
                        <a href="#" class="dropdown-item category-title">Šport</a>
                        <a href="#" class="dropdown-item category-item">Futbal</a>
                        <a href="#" class="dropdown-item category-item">Beh</a>
                        <a href="#" class="dropdown-item category-item">Basketbal</a>
                        <a href="#" class="dropdown-item category-item">Turistické</a>
                        <a href="#" class="dropdown-item category-item">Lezecké</a>
                    </div>
                    <div class="dropdown-col">
                        <a href="#" class="dropdown-item category-title">Letná obuv</a>
                        <a href="#" class="dropdown-item category-item">Šľapky</a>
                        <a href="#" class="dropdown-item category-item">Sandále</a>
                        <a href="#" class="dropdown-item category-item">Balerínky</a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a href="#" id="accessories" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    DOPLNKY
                </a>
                <div class="dropdown-menu dropdown-multicolumn p-0" aria-labelledby="accessories">
                    <div class="dropdown-col">
                        <a href="#" class="dropdown-item category-title">Nové</a>
                    </div>
                    <div class="dropdown-col">
                        <a href="#" class="dropdown-item category-title">Tašky & batohy</a>
                        <a href="#" class="dropdown-item category-item">Športové</a>
                        <a href="#" class="dropdown-item category-item">Kabelky</a>
                    </div>
                    <div class="dropdown-col">
                        <a href="#" class="dropdown-item category-title">Peňaženky</a>
                    </div>
                    <div class="dropdown-col">
                        <a href="#" class="dropdown-item category-title">Bižutéria</a>
                        <a href="#" class="dropdown-item category-item">Náušnice</a>
                        <a href="#" class="dropdown-item category-item">Prstene</a>
                    </div>
                </div>
            </li>-->
        </ul>
    </div>
</nav>
