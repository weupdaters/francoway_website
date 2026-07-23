 <div class="flex-grow-1"></div>

                <!-- Start Footer Area -->
                <footer class="footer-area bg-white text-center rounded-10 rounded-bottom-0">
                    <p class="fs-16 text-body">© <span class="text-secondary">{{ date('Y') }} FrancoWay</span> is Proudly Owned by <a href="https://weupdaters.com/" target="_blank" class="text-decoration-none text-primary">Weupdaters</a></p>
                </footer>
                <!-- End Footer Area -->
            </div>
        </div>
        <!-- Start Main Content Area -->

        
     
        <!-- Link Of JS File -->
        <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/js/sidebar-menu.js') }}"></script>
        <script src="{{ asset('admin/js/quill.min.js') }}"></script>
        <script src="{{ asset('admin/js/data-table.js') }}"></script>
        <script src="{{ asset('admin/js/prism.js') }}"></script>
        <script src="{{ asset('admin/js/clipboard.min.js') }}"></script>
        <script src="{{ asset('admin/js/simplebar.min.js') }}"></script>
        <script src="{{ asset('admin/js/apexcharts.min.js') }}"></script>
        <script src="{{ asset('admin/js/echarts.min.js') }}"></script>
        <script src="{{ asset('admin/js/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('admin/js/fullcalendar.main.js') }}"></script>
        <script src="{{ asset('admin/js/jsvectormap.min.js') }}"></script>
        <script src="{{ asset('admin/js/world-merc.js') }}"></script>
        <script src="{{ asset('admin/js/custom/apexcharts.js') }}"></script>
        <script src="{{ asset('admin/js/custom/echarts.js') }}"></script>
        <script src="{{ asset('admin/js/custom/maps.js') }}"></script>
        <script src="{{ asset('admin/js/custom/custom.js') }}"></script>
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // Global toast function
            window.showToast = function(message, type = 'success') {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                Toast.fire({
                    icon: type,
                    title: message
                });
            };

            // Global confirmation helper
            window.confirmAction = function(title, text, confirmButtonText, callback) {
                Swal.fire({
                    title: title || 'Are you sure?',
                    text: text || '',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#E31B23', // Matches primary brand color
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: confirmButtonText || 'Yes, proceed!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        callback();
                    }
                });
            };
        </script>
    </body>
</html>