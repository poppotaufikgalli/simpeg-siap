    <!-- Bootstrap core JavaScript-->
    <!-- <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

    <!-- Core plugin JavaScript-->
    <!-- <script src="vendor/jquery-easing/jquery.easing.min.js"></script> -->

    <!-- Custom scripts for all pages-->
    <!-- <script src="js/sb-admin-2.min.js"></script> -->

    <!-- Page level plugins -->
    <!-- <script src="vendor/chart.js/Chart.min.js"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script> -->
    @livewireScripts
    <script>
        window.onload = (event)=> {
            const notyf = new Notyf();
            
            var errors = {!!$errors!!};
            var lserror = Object.values(errors);
            //console.log(e)
            
            if(lserror.length > 0){
                for (var i = lserror.length - 1; i >= 0; i--) {
                    notyf.error(lserror[i][0])
                }
            }

            var success = '{!!Session::get('success')!!}';

            //var lssuccess = Object.values(success);
            //console.log(success.length)
            if(success != ""){
                notyf.success(success)
            }

            document.getElementById('sidebarToggleTop').addEventListener('click', function(e){
                document.getElementsByTagName('body')[0].classList.toggle("sidebar-toggled")
                const sidebar = document.querySelector(".sidebar");
                sidebar.classList.toggle('toggled')
                const collapsePersonel = document.getElementById('collapsePersonel')
                collapsePersonel.classList.toggle('show')
                
            })
        }
    </script>
</body>

</html>