<footer class="footer">
    <div class="container-fluid">
        <!-- <nav class="pull-left">
            <ul>
                <li>
                    <a href="#">
                        Home
                    </a>
                </li>
                <li>
                    <a href="#">
                        Company
                    </a>
                </li>
                <li>
                    <a href="#">
                        Portfolio
                    </a>
                </li>
                <li>
                    <a href="#">
                       Blog
                    </a>
                </li>
            </ul>
        </nav> -->
        <!-- <p class="copyright pull-right">
            &copy;
            <script>document.write(new Date().getFullYear())</script>
            <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
        </p> -->
    </div>
</footer>
</div>
</div>

</body>

<!--   Core JS Files   -->
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/material.min.js') }}" type="text/javascript"></script>

<!--  Notifications Plugin    -->
<script src="{{ asset('js/bootstrap-notify.js') }}"></script>

<!-- Material Dashboard javascript methods -->
<script src="{{ asset('js/material-dashboard.js') }}"></script>

<!-- Sweet Alert -->
<script src="{{ asset('js/sweetalert.min.js') }}"></script>

{{--DateTimePicker--}}
<script type="text/javascript" src="{{ asset('js/moment-with-locales.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-material-datetimepicker.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function()
    {
        $('#pengumpulan-proposal-final').bootstrapMaterialDatePicker
        ({
            format: 'YYYY-MM-DD HH:mm',
            lang: 'id',
            weekStart: 0,
            cancelText : 'Batal',
            nowText : 'Sekarang',
            nowButton : true,
            switchOnClick : true
        });
        $('#pengumpulan-proposal-final').bootstrapMaterialDatePicker('setMinDate', $('#pengumpulan-proposal').val());
        $('#pengumpulan-proposal').bootstrapMaterialDatePicker
        ({
            format: 'YYYY-MM-DD HH:mm',
            lang: 'id',
            weekStart: 0,
            cancelText : 'Batal',
            nowText : 'Sekarang',
            nowButton : true,
            switchOnClick : true
        }).on('change', function (e, date) {
            $('#pengumpulan-proposal-final').bootstrapMaterialDatePicker('setMinDate', date);
        });

        $.material.init()
    });
</script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.js') }}"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    }
})
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.use-datatable').DataTable({
            responsive: true,
            "paging":   false,
            "info":     false,
            "columnDefs": [
                {"orderable": false, "targets": 3}
            ]
        });
    });
    $(document).ready(function () {
        $('#fakultas').DataTable({
            responsive: true,
            "info": false,
            "sort": false,
            "searching": false,
            "lengthMenu": [[5, 10, 20, 40, 80, 100, -1], [5, 10, 20, 40, 80, 100, "Semua data"]],
        });
    });
    $(document).ready(function () {
        $('#aspek').DataTable({
            responsive: true,
            "info": false,
            "sort": false,
            "searching": false,
            "lengthMenu": [[5, 10, 20, 40, 80, 100, -1], [5, 10, 20, 40, 80, 100, "Semua data"]],
        });
    });
</script>
@stack('js')

</html>
