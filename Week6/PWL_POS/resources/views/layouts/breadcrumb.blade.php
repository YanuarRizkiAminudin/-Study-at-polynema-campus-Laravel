<!-- {{-- <i class="fas fa-search"></i>
</a>
<div class="navbar-search-block">
  <form class="form-inline">
    <div class="input-group input-group-sm">
      <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-navbar" type="submit">
          <i class="fas fa-search"></i>
        </button>
        <button class="btn btn-navbar" type="button" data-widget="navbar-search">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div> --}} -->

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>{{ $breadcrumb->title }}</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        @foreach($breadcrumb->list as $key => $value)
                            @if($key == count($breadcrumb->list) - 1)
                                <li class="breadcrumb-item active">{{ $value }}</li>
                            @else
                                <li class="breadcrumb-item">{{ $value }}</li>
                            @endif
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </section>