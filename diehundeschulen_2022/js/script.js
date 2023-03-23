(function ($)
{

    function onScroll()
    {
        var sr = $(window).scrollTop();
        if (sr >= 50)
        {
            $('header#main-nav,#mobile-header').addClass('scrolled');
        } else
        {
            $('header#main-nav,#mobile-header').removeClass('scrolled');
        }
    }


    $(window).scroll(function (e)
    {
        onScroll();
    });

    $(document).ready(function ()
    {
        $('.logged-in #frm_form_6_container .frm_final_submit').val('Speichern');
        
        


        $('.home-slider').each(function ()
        {
            var slides = $(this).find('.one-school.one-review');
            var urls = [];
            $(slides).each(function (k,v)
            {
                var url = $(this).find('a').attr('href');
                if(urls.indexOf(url)>-1)
                {
                    $(v).parent().parent().remove();
                    console.log('remove duplicate!');
                }
                else
                {
                    
                    urls.push(url);
                }
                
                
            });
        });
        

        $('.hund-photos-gallery').slick({
            arrows: false,
            dots: false
        });

        $('.set-slide-photo').click(function (e)
        {
            e.preventDefault();
            var key = $(this).attr('data-key');
            $('.hund-photos-gallery').slick('slickGoTo', key);
        });

        $('.one-hund-act').click(function ()
        {
            window.location = $(this).attr('data-url');
        });

        /*SELECTOR!!!!*/
        
        
        
        if ($('#frm_field_109_container table').length > 0)
        {
            /*$('#frm_field_109_container table').before($('.the-pricing-table'));
            $('.the-pricing-table .col-sm-4:nth-child(1) .op-button-wrapper').append($('#frm_radio_109-107-2'));
            $('.the-pricing-table .col-sm-4:nth-child(2) .op-button-wrapper').append($('#frm_radio_109-107-3'));
            $('.the-pricing-table .col-sm-4:nth-child(3) .op-button-wrapper').append($('#frm_radio_109-107-1'));*/
        }
        
        if(typeof premium !== 'undefined')
        {
            setTimeout(function()
            {
                console.log(premium);
                if(premium)
                {
                    $('#frm_radio_109-107-1 input').trigger('click');
                }
                else
                {
                    $('#frm_radio_109-107-2 input').trigger('click');
                }
                    
            },1000);
        }


        $('#customer_details h2').after('<p>Du hast noch kein Konto als Hundeschule? <br />Dann <a href="/jetzt-anmelden/">registriere dich jetzt hier</a>.</p>');

        $('.cspm_zoom_in_control').click(function ()
        {
            /*console.log('test');
             var map = google.maps.Map;
             map.setZoom(map.getZoom()+1);*/
        });

        if ($('body').hasClass('category-2') || $('#single-school-top').length > 0)
        {
            $('.menu-item-24627').addClass('current-menu-item');
        }

        $('.frm_prev_page').val('Zurück');

        $('.sort-by-rating').each(function ()
        {
            $(this).find('.sort-it-now').sort(function (a, b)
            {
                var s1 = parseInt($(a).find('.the-number-of-the-stars').text());
                var s2 = parseInt($(b).find('.the-number-of-the-stars').text());
                if (isNaN(s1))
                {
                    s1 = 0;
                }
                if (isNaN(s2))
                {
                    s2 = 0;
                }
                //console.log(s1 - s2);
                return s2 - s1;
            }).appendTo($(this));
        });




        var star = '<svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.17969 4.01562L12.5547 4.53125C12.8516 4.57812 13.0547 4.74219 13.1641 5.02344C13.2422 5.32031 13.1797 5.57812 12.9766 5.79688L10.5391 8.1875L11.1016 11.6328C11.1484 11.9297 11.0469 12.1719 10.7969 12.3594C10.5469 12.5312 10.2891 12.5469 10.0234 12.4062L7 10.8125L4 12.4062C3.71875 12.5469 3.45312 12.5312 3.20312 12.3594C2.96875 12.1719 2.86719 11.9297 2.89844 11.6328L3.48438 8.1875L1.04688 5.79688C0.828125 5.57812 0.765625 5.32031 0.859375 5.02344C0.953125 4.74219 1.14844 4.57812 1.44531 4.53125L4.82031 4.01562L6.32031 0.921875C6.47656 0.65625 6.70312 0.515625 7 0.5C7.3125 0.515625 7.53906 0.65625 7.67969 0.921875L9.17969 4.01562Z" fill="#FAB022"/></svg>';
        ajaxurl = $('body').attr('data-ajax-url');
        $('.the-number-of-the-stars').each(function (k, v)
        {
            var number = parseInt($(this).text());

            $(this).html('');
            for (var i = 0; i < number; i++)
            {
                $(this).append(star);
            }

            /*var href = $(this).closest('.sort-it-now').find('a').attr('href');
             $.ajax({
             url: ajaxurl,
             type: 'post',
             data: {action: 'resolve_title', href: href},
             success: function (data)
             {
             
             }
             });*/

        });



        if (typeof frm_step_2 !== 'undefined')
        {
            $('#registration-form-the').css('display', 'block');
            $('#the-table').css('display', 'none');
        }

        $('#open-registration-simple').click(function ()
        {
            $('#registration-form-the').css('display', 'block');
            $('#the-table').css('display', 'none');
        });

        $('.change-subscription').click(function (e)
        {
            e.preventDefault();
            var pid = $(this).attr('data-product-id');

            e.preventDefault();
            var thisForm = $(this);
            $(thisForm).css('opacity', '0.5');
            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: {action: 'cart_subscription', pid: pid},
                success: function (data)
                {
                    $(thisForm).css('opacity', '1');
                    window.location = data;
                }
            });



        });

        $('#s-list-form select').change(function ()
        {
            $('input[name="s"]').val('');
            $(this).closest('form').submit();
        });

        $('#menu-toggle').click(function (e)
        {
            e.preventDefault();
            $('#mobile-menu-wrapper,#mobile-header').toggleClass('active');
            $(this).toggleClass('open');
            $('body').toggleClass('no-scroll');
        });

        onScroll();

        $('.one-school.one-review,#the-comments-list article').each(function (k, v)
        {
            var img = $(this).find('img');
            $(img).wrap($('<div class="reviews-stars"></div>'));
            $(img).removeAttr('data-tgpli-image-inited');
            $(img).removeAttr('data-tgpli-inited');
            var clone = $(img).clone();

            $(img).after($(clone).clone());
            $(img).after($(clone).clone());
            $(img).after($(clone).clone());
            $(img).after($(clone).clone());
        });

        $('.one-ofa-title').click(function ()
        {
            var ta = $(this).closest('.one-ofa');
            var others = $(this).closest('.footer-accordion').find('.one-ofa').not(ta);

            $(ta).toggleClass('active');

            if ($(ta).hasClass('active'))
            {
                $(ta).find('.one-ofa-content').slideDown(550);
            } else
            {
                $(ta).find('.one-ofa-content').slideUp(550);
            }

            $(others).removeClass('active');
            $(others).find('.one-ofa-content').slideUp(550);

        });

        var sliderArrow = '<svg width="15" height="28" viewBox="0 0 15 28" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.9375 27.0625L0.5 15.125C0.166667 14.7083 0 14.3333 0 14C0 13.625 0.145833 13.2708 0.4375 12.9375L11.875 1C12.5417 0.416667 13.25 0.416667 14 1C14.5833 1.66667 14.5833 2.375 14 3.125L3.5625 14L14.0625 24.9375C14.6458 25.6875 14.6458 26.3958 14.0625 27.0625C13.3125 27.6458 12.6042 27.6458 11.9375 27.0625Z" fill="#E3000B"/></svg>';


        $('.home-slider').slick({
            slidesToShow: 4,
            dots: true,
            nextArrow: '<a href="#" class="next-arrow">' + sliderArrow + '</a>',
            prevArrow: '<a href="#" class="prev-arrow">' + sliderArrow + '</a>',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {slidesToShow: 3}
                },
                {
                    breakpoint: 768,
                    settings: {slidesToShow: 2}
                },
                {
                    breakpoint: 575,
                    settings: {slidesToShow: 1}
                }
            ]
        });

        function eh(items)
        {
            $(items).css('min-height', '0px');
            $(items).css('box-sizing', 'border-box');
            var min = 0;
            if ($(window).width() < 575)
            {
                return;
            }
            $(items).each(function (k, v)
            {
                var h = $(v).outerHeight();

                if (h > min)
                {
                    min = h;
                }
            });
            $(items).css('min-height', min);
        }


        setTimeout(function ()
        {
            $('.home-slider').each(function ()
            {
                var items = $(this).find('.one-school');
                eh(items);
            });
        });

        $('#show-write-form').click(function (e)
        {
            e.preventDefault();
            $('#write-review-form').slideToggle(550);
        });

        if ($('.single #the-comments-list').length > 0)
        {
            $('.single #the-comments-list article').each(function (k, v)
            {
                if ($(v).html().indexOf('[check][/check]') > -1)
                {
                    $(v).remove();
                }
            });

            $('.single #the-comments-list article').wrapAll($('<div id="the-masonry"></div>'));
            $('#the-masonry').isotope({
                itemSelector: 'article',
                masonry: {
                    columnWidth: 'article'
                }
            });
        }

        $('#mobile-menu-buttons .the-button').wrap($('<div class="the-button-wrapper"></div>'));

        /*
         var as = '<svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.875 6.34375L1.375 11.3438C1.14583 11.5521 0.90625 11.5625 0.65625 11.375C0.447917 11.1458 0.4375 10.9062 0.625 10.6562L4.84375 6L0.625 1.34375C0.4375 1.09375 0.447917 0.854167 0.65625 0.625C0.90625 0.4375 1.14583 0.447917 1.375 0.65625L5.875 5.625C6.04167 5.875 6.04167 6.11458 5.875 6.34375Z" fill="#E3000B"></path></svg>';
         
         $('#entire-content .cspm_infobox_content .title').each(function()
         {
         var href = $(this).find('a').attr('href');
         $(this).after($('<a href="'+href+'" class="popup-link">Zur Hundeschule '+as+'</a>'));
         });*/

        if (window.navigator.geolocation && !$('body').hasClass('page-id-47314')) {
            window.navigator.geolocation.getCurrentPosition(function (res)
            {
                var lat = res.coords.latitude;
                var lng = res.coords.longitude;
                $('input[name="user_lat"]').val(lat);
                $('input[name="user_lng"]').val(lng);
                $("#range-input-wrapper").css('display', 'block');
                //alert(lat+' '+lng);
                //$('.schools-middle-filters').before('<p>'+lat+' '+lng+'</p>');
            }, function (err)
            {
                console.log(err);
            });
        }

    });

})(jQuery);