<li class="nav-item">
    <a href="{{ route('home') }}"
       class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i style="color: black" class="nav-icon fas fa-tachometer-alt"></i>
        <p style="color: black">Dashboard</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('tickets.index') }}"
       class="nav-link {{ Request::is('tickets*') ? 'active' : '' }}">
       <i style="color: black" class="nav-icon fa fa-school"></i></i>
        <p style="color: black">Tickets</p>
    </a>
</li>