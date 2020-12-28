<ul class="list-unstyled components">
    <li>
        <a href={{ url('/dashboard') }}>Panel</a>
    </li>
    <li>
        <a href={{ url('/dashboard/categories') }}>Kategorie</a>
    </li>
    <li>
        <a href={{ url('/dashboard/attributes') }}>Atrybuty</a>
    </li>
    <li>
        <a href={{ url('/dashboard/products') }}>Produkty</a>
    </li>
    <li>
        <a href={{ url('/dashboard/orders') }}>Zamówienia</a>
    </li>
    <li>
        <a href="#userSubmenu" data-toggle="collapse" aria-expanded="false"
            class="dropdown-toggle">{{ Auth::user()->email }}</a>
        <ul class="collapse list-unstyled" id="userSubmenu">
            <li>
                <a href={{ url('/logout') }}>Wyloguj</a>
            </li>
        </ul>
    </li>
</ul>
