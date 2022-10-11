{{-- <script src="{{ url('backend/js/jquery-3.6.0.min.js') }}"></script> --}}

<script src="{{ url('backend/vendor/jquery/jquery.min.js') }}"></script>

<script src="{{ url('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ url('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ url('backend/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ url('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ url('backend/js/demo/datatables-demo.js') }}"></script>

    <!-- development version, includes helpful console warnings -->
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>


<!-- Page level plugins -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{-- Select2 Mutiple --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@yield('js')