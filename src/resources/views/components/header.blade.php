@auth
    <nav class="navbar navbar-light mb-5 d-flex justify-content-end">
        <div class="mr-3">{{ Auth::user()->name }}</div>

        <a role="button" class="btn btn-primary btn-sm" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout').submit();">Logout</a>

        <form method="POST" action="{{ route('logout') }}" id="logout" style="display: none;">
            @csrf
        </form>
    </nav>
@endauth
