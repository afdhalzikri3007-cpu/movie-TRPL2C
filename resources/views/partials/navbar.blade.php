<nav class="navbar navbar-expand-lg bg-success" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="/">tiMovie</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/movies/data">Data Movie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/movies/create">Input Movie</a>
                </li>
            </ul>
            <form action="/" class="d-flex" role="search">
                <input class="form-control me-2" type="search" name="search"
                    placeholder="Search" value="{{ request('search') }}">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>