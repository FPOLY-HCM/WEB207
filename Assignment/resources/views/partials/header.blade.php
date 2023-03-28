<nav class="navbar navbar-dark navbar-expand-lg bg-primary">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="https://docs.angularjs.org/img/angularjs-for-header-only.svg" height="30">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Trang chủ</a>
                </li>
            </ul>
            <form class="me-4">
                <input type="text" class="form-control" placeholder="Tìm kiếm" />
            </form>
            @auth
                <div class="dropdown">
                    <button class="text-white btn btn-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth()->user()->name }}
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Đăng xuất
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <button type="button" class="btn btn-text text-white" data-bs-toggle="modal" data-bs-target="#loginModal">Đăng nhập</button>
            @endauth
        </div>
    </div>
</nav>

@include('template.login')
@include('template.register')
