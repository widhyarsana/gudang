<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>

    @include('layouts.partials._assets')

    @yield('style')
    @livewireStyles
    @livewireScripts
</head>

<body>

    @include('layouts.partials._navbar')


    @yield('header')


    <!-- Page content -->
    <div class="page-content pt-0">

        @role('superadmin')
        <input type="hidden" id="sub" value="superadmin">
        @endrole

        @role('admin')
        <input type="hidden" id="sub" value="admin">
        @endrole

        @role('customer')
        <input type="hidden" id="sub" value="customer">
        @endrole
        <!-- Main sidebar -->
        <div class="sidebar sidebar-light sidebar-main sidebar-expand-md align-self-start">

            <!-- Sidebar mobile toggler -->
            <div class="sidebar-mobile-toggler text-center">
                <a href="#" class="sidebar-mobile-main-toggle">
                    <i class="icon-arrow-left8"></i>
                </a>
                <span class="font-weight-semibold">Main sidebar</span>
                <a href="#" class="sidebar-mobile-expand">
                    <i class="icon-screen-full"></i>
                    <i class="icon-screen-normal"></i>
                </a>
            </div>
            <!-- /sidebar mobile toggler -->


            <!-- Sidebar content -->
            @include('layouts.partials._sidebar')
        </div>

        <!-- Main content -->
        <div class="content-wrapper">

            @yield('content')

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

    @include('layouts.partials._footer')

    @yield('script')

    <script type="text/javascript">
        window.livewire.on('adminStored', ($admin) => {
            $('#form').modal('hide');
        });
        window.livewire.on('adminUpdate', ($admin) => {
            $('#form').modal('hide');
        });
        window.livewire.on('alert', param => {
            toastr.options.showMethod = 'slideDown';
            toastr.options.hideMethod = 'slideUp';
            toastr.options.progressBar = true;
            toastr.options.timeOut = 3000;
            toastr.success(param['message'])
        });
    </script>
</body>

</html>
