
                <footer class="footer text-center text-sm-left">
                    &copy; 2022 Gelera <span class="text-muted d-none d-sm-inline-block float-right">Crafted with <i class="mdi mdi-heart text-danger"></i> by g7technologies.com</span>
                </footer><!--end footer-->
            </div>
            <!-- end page content -->
        </div>
        <!-- end page-wrapper -->

        <!-- jQuery  -->
        <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/metisMenu.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/waves.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/jquery.slimscroll.min.js') }}"></script>

       

         <!-- Required datatable js -->
        <script src="{{ asset('public/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('public/assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <!-- Buttons examples -->
        <script src="{{ asset('public/assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('public/assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('public/assets/plugins/datatables/jszip.min.js') }}"></script>
        <script src="{{ asset('public/assets/plugins/datatables/pdfmake.min.js') }}"></script>
        <script src="{{ asset('public/assets/plugins/datatables/vfs_fonts.js') }}"></script>
        <script src="{{ asset('public/assets/plugins/datatables/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('public/assets/plugins/datatables/buttons.print.min.js') }}"></script>
        <script src="{{ asset('public/assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
        <!-- Responsive examples -->
        <script src="{{ asset('public/assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('public/assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('public/assets/pages/jquery.datatable.init.js') }}"></script>

        {{-- Moment js --}}
        <script src="{{ asset('public/assets/plugins/moment/moment.js') }}"></script> 
       

        <script src="{{ asset('public/assets/js/jquery.core.js') }}"></script>
        <!-- App js -->
        <script src="{{ asset('public/assets/js/app.js') }}"></script>

        <script src="{{ asset('public/assets/js/main.js') }}"></script>

                <!--Morris Chart-->
        
        <script src="{{asset('public/assets/plugins/morris/morris.min.js')}}"></script>
        <script src="{{asset('public/assets/plugins/raphael/raphael-min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        
            <!--Wysiwig js-->
        <script src="{{asset('public/assets/plugins/tinymce/tinymce.min.js')}}"></script>
        <script src="{{asset('public/assets/pages/jquery.form-editor.init.js')}}"></script> 
        @stack('scripts')

    </body>
</html>
