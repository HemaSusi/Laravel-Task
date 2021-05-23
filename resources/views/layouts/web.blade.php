<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
        <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('css/custom.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('css/validationEngine.jquery.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous"/>        <link href="{{ URL::asset('css/custom.css') }}" rel="stylesheet" type="text/css">
        <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
 <script src="{{ URL::asset('js/jquery.validationEngine.js') }}"></script>
  <script src="{{ URL::asset('js/jquery.validationEngine-en.js') }}"></script>
        <title>Laravel - Test</title>
    </head>

    <body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default "  >
        <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page">
            <!-- BEGIN: Header -->
            <!-- END: Header -->
            <!-- begin::Body -->
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
                <!-- BEGIN: Left Aside -->

                <?php
                if (session()->has('message')) {
                    $success = session()->get('message');
                    $type = session()->get('alert-class');
                    ?>
                    <script>
    swal("Success!", "<?php echo $success; ?>", "<?php echo $type; ?>");
                    </script>
                <?php }
                ?>
                @yield('content');
                <!-- end:: Body -->
                <!-- begin::Footer -->
            </div>
            <!-- end::Footer -->
        </div>

        <!-- end::Quick Sidebar -->
        <!-- begin::Scroll Top -->

        <!-- begin::Quick Nav -->
        <!-- Modal -->

    </body>
    <script>
        $('.validation_form').validationEngine({scroll: false});
        $(function () {
            $("[rel='tooltip']").tooltip();
        });
    </script>
</html>