<!-- Bootstrap core JavaScript

================================================= -->

{{-- <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script> --}}
<script src="vendor/jquery/jquery.min.js"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

{{-- Custom scripts --}}
{{--<script src="{{asset('js/addon.js')}}"></script>--}}

<script type="text/javascript">
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });
</script>
