@include('layouts.header')
@include('partials.mainPageNav')
@yield('content')
@yield('js-content')
@include('layouts.footer')
<div class="gtranslate_wrapper"></div>
<script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function(){
        const pathname = window.location.pathname
        if(pathname == '/'){
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    //document.getElementById('navbar_top').style.top = 0;
                    document.getElementById('navbar_top').classList.add('bg-primary');
                    //document.getElementById('navbar_top').classList.add('fixed-top');
                    // add padding top to show content behind navbar
                    //navbar_height = document.querySelector('.navbar').offsetHeight;
                    //document.body.style.paddingTop = navbar_height + 'px';
                } else {
                    //document.getElementById('navbar_top').style.top = '30px';
                    document.getElementById('navbar_top').classList.remove('bg-primary');
                    //document.getElementById('navbar_top').classList.remove('fixed-top');
                    // remove padding top from body
                    //document.body.style.paddingTop = '0';
                } 
            });    
        }else{
            document.getElementById('navbar_top').classList.add('bg-primary');
            document.getElementById('navbar_top').classList.remove('fixed-top');
        }
    }); 
    window.gtranslateSettings = {
        "default_language":"id",
        "languages":[
            "id","en"
        ],
        "wrapper_selector":".gtranslate_wrapper",
        "float_switcher_open_direction":"right",
        "flag_style":"3d"
    }
</script>