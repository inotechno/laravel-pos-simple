<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">
                @yield('title', 'Page Title')
            </h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    @yield('breadcrumb')
                </nav>
            </div>
        </div>
        <div class="col-5 align-self-center">
            <div class="customize-input float-right">
                @yield('customize-element')
            </div>
        </div>
    </div>
</div>
