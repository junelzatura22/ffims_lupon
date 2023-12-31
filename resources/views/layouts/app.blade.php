@include('layouts.header')

@include('layouts.sidebar')

@yield('content-details')

@include('layouts.footer')




<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>

<script type="text/javascript" src='https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js'></script>
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js'></script>


<!-- ./wrapper -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
    integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
</script>
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js">
</script>
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- jQuery -->
{{-- <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script> --}}
<!-- jQuery UI 1.11.4 -->

{{-- <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script> --}}
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->



<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>

<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

{{-- for the dual list  --}}
<script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>

{{-- validations  --}}
<script src="{{ asset('val_script/auth.js') }}"></script>
{{-- <script src="{{ asset('val_script/auth.js') }}"></script> --}}
<script>
    //load province through region id
    $("#region_id").on("change", function() {
        var uri = $("#region_id option:selected").attr("id"); //get the value
        var id = $(this).val();
        $("#province_id").html('');
        $("#citymun_id").html('');
        var provinceUrl = '{{ route('location.showcitymunbyprovince', 'param') }}';
        $.ajax({
            url: uri,
            type: "get",
            dataType: "json",
            success: function(response) {
                $("#province_id").html(
                    '<option value="">[Select Province]</option>'
                );
                $.each(response.provinceData, function(key, value) {
                    $("#province_id").append(
                        '<option value="' +
                        value.id + '" id="' + provinceUrl.replaceAll('param', value
                            .id) + '">' +
                        value.provDesc +
                        "</option>"
                    );
                });
            },
            error: function() {
                swal("OPPS!", "Error Loading Region ", "error");
            },
        });
    });
    $("#province_id").on("change", function() {
        var uri = $("#province_id option:selected").attr("id"); //get the value
        $("#citymun_id").html('');
        $.ajax({
            url: uri,
            type: "get",
            dataType: "json",
            success: function(response) {
                $("#citymun_id").html(
                    '<option value="">[Select City/Municipality]</option>'
                );
                $.each(response.citymunData, function(key, value) {
                    $("#citymun_id").append(
                        '<option value="' +
                        value.id + ' ">' +
                        value.citymunDesc +
                        "</option>"
                    );
                });
            },
            error: function() {
                swal("OPPS!", "Error Loading Province", "error");
            },
        });
    });


@stack('scripts')
    
   
</script>


</body>

</html>
