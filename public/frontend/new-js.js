    
import $ from 'jquery';
source('new-js.js')
    
        $(document).ready(function () {

            $(".banner-wrapper").on("mousemove", function (e) {

                var width = $(this).width();
                var height = $(this).height();
                var offset = $(this).offset();

                var mouseX = e.pageX - offset.left;
                var mouseY = e.pageY - offset.top;


                var moveX = (mouseX / width - 0.3) * 50;
                var moveY = (mouseY / height - 0.3) * 50;

                $(".banner-img").css("transform",
                    "translateX(" + moveX + "px) translateY(" + moveY + "px) rotateY(" + moveX / 5 + "deg)"
                );
            });

            $(".banner-wrapper").on("mouseleave", function () {
                $(".banner-img").css("transform", "translateX(0) translateY(0) rotateY(0)");
            });

        });

        //hello  hover effect

        $(document).ready(function () {

            $(".hello-wrapper").on("mousemove", function (e) {

                var width = $(this).width();
                var height = $(this).height();
                var offset = $(this).offset();

                var mouseX = e.pageX - offset.left;
                var mouseY = e.pageY - offset.top;


                var moveX = (mouseX / width - 0.3) * 50;
                var moveY = (mouseY / height - 0.3) * 50;

                $(".hello-img").css("transform",
                    "translateX(" + moveX + "px) translateY(" + moveY + "px) rotateY(" + moveX / 5 + "deg)"
                );
            });

            $(".hello-wrapper").on("mouseleave", function () {
                $(".hello-img").css("transform", "translateX(0) translateY(0) rotateY(0)");
            });

        });

  

    
        $(document).ready(function () {

            $('.testimonial-slider').slick({
                slidesToShow: 2,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                dots: true,
                arrows: false,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });

        });