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
                <input type="text" class="form-control" placeholder="Tìm kiếm">
            </form>
            @auth
                <div class="dropdown">
                    <a class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
            @else
                <button type="button" class="btn btn-text text-white" data-bs-toggle="modal" data-bs-target="#loginModal">Đăng nhập</button>
            @endauth
        </div>
    </div>
</nav>

<div ng-controller="LoginController" class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="loginModalLabel">Đăng nhập</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form ng-submit="login()">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" ng-model="email"e class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input type="password" name="password" id="password" ng-model="password"e class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
                </form>
            </div>
        </div>
    </div>
</div>
