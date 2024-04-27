(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner(0);


    // Fixed Navbar
    $(window).scroll(function () {
        if ($(window).width() < 992) {
            if ($(this).scrollTop() > 55) {
                $('.fixed-top').addClass('shadow');
            } else {
                $('.fixed-top').removeClass('shadow');
            }
        } else {
            if ($(this).scrollTop() > 55) {
                $('.fixed-top').addClass('shadow').css('top', -55);
            } else {
                $('.fixed-top').removeClass('shadow').css('top', 0);
            }
        } 
    });
    
    
   // Back to top button
   $(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
        $('.back-to-top').fadeIn('slow');
    } else {
        $('.back-to-top').fadeOut('slow');
    }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Testimonial carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 2000,
        center: false,
        dots: true,
        loop: true,
        margin: 25,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:1
            },
            992:{
                items:2
            },
            1200:{
                items:2
            }
        }
    });


    // vegetable carousel
    $(".vegetable-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        center: false,
        dots: true,
        loop: true,
        margin: 25,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            },
            1200:{
                items:4
            }
        }
    });
    // Product Quantity
    $('.quantity button').on('click', function () {
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();
        if (button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        button.parent().parent().find('input').val(newVal);
    });

    $('.add-cart').on('click', function () {
        var id = $(this).data('id');
        var url = "add-cart";
        $.ajax({
        url: url+'/'+id,
        type: "GET",
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(resp){
            $('#total-cart').html(resp.data);
        },
        error : function(resp){

        },
        });
    });
    
    $('.custom-qty').on('click', function () {
        var id = $(this).data('id');
        var type = $(this).data('type');
        var url = "custom-qty";
        $.ajax({
        url: url+'/'+id+'/'+type,
        type: "GET",
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(resp){
            $('.sum-product-'+id).html(resp.price);
            $('#total-cart').html(resp.total);
            if (resp.remove) {
                $('.list-cart-'+id).remove();
            }
        },
        error : function(resp){

        },
        });
    });
    
    $('.remove-cart').on('click', function () {
        var id = $(this).data('id');
        var url = "remove-cart";
        $.ajax({
        url: url+'/'+id,
        type: "GET",
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(resp){
            $('#total-cart').html(resp.total);
            $('.list-cart-'+id).remove();
        },
        error : function(resp){

        },
        });
    });
    
    $('.choiceCart').on('change', function () {
        var id = $(this).data('id');
        var selectedValues = [];
        var csrfToken = $("input[name='_token']").val();

        $("input[name='cart[]']:checked").each(function() {
            selectedValues.push($(this).val());
        });

        var url = "calculate-cart";
        $.ajax({
        url: url,
        type: "POST",
        data: {
            _token: csrfToken, 
            cart_id: selectedValues,
        },
        success: function(resp){
            $('.total-product').html(resp.total_product);
            $('.total-qty').html(resp.total_qty);
            $('.total-price').html(resp.total_price);
            $('.total').val(resp.total);
            $('.coupon-product').html('');
            if (resp.coupon_product > 0) {
                for (let index = 0; index < resp.coupon_product; index++) {
                    $('.coupon-product').append('<p class="mb-0">Coupon '+index+'</p>');
                }
            } else {
                $('.coupon-product').html('');
            }
            if(resp.coupon_checkout){
                $('.coupon-checkout').html('<p class="mb-0">Coupon ABCS</p>');
            }else{
                $('.coupon-checkout').html('');
            }
            $('.total-coupon').html(resp.coupon_total+' Coupon');
        },
        error : function(resp){

        },
        });
    });
    
    $('#submit-checkout').on('click', function () {
        var selectedValues = [];
        var csrfToken = $("input[name='_token']").val();
        var total = $(".total").val();
        $("input[name='cart[]']:checked").each(function() {
            selectedValues.push($(this).val());
        });
        if (selectedValues === null || (typeof selectedValues === 'object' && selectedValues.length === 0)) {
            alert('No cart selected');
        }else{
            var url = "checkout-cart";
            $('#spinner').addClass('show');
    
            $.ajax({
            url: url,
            type: "POST",
            data: {
                _token: csrfToken, 
                cart_id: selectedValues,
                total: total,
            },
            success: function(resp){
                location.href = '/history';
            },
            error : function(resp){
                $('#spinner').removeClass('show');
            },
            });
        }
    });
    
    $('.list-data').on('click', function () {
        var id = $(this).data('id');
        $('.list-checkout').removeClass('bg-primary');
        $('.list-checkout-'+id).addClass('bg-primary');
        $('.show-detail').hide();
        $('.show-detail-'+id).show();
    });

    $(document).ready(function () {
        var url = "count-cart";
        $.ajax({
        url: url,
        type: "GET",
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(resp){
            $('#total-cart').html(resp.data);
        },
        error : function(resp){

        },
        });
    });

})(jQuery);

