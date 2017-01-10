
$(function() {
                var bannerSlider = new Slider($('#banner_tabs'), {
                    time: 5000,
                    delay: 400,
                    event: 'hover',
                    auto: true,
                    mode: 'fade',
                    controller: $('#bannerCtrl'),
                    activeControllerCls: 'active'
                });
                /*$('#banner_tabs .flex-prev').click(function() {
                    bannerSlider.prev()
                });
                $('#banner_tabs .flex-next').click(function() {
                    bannerSlider.next()
                });*/
				 var bannerSlidera = new Slider($('#toppic_tabs'), {
                    time: 5000,
                    delay: 400,
                    event: 'hover',
                    auto: true,
                    mode: 'fade',
                    controller: $('#toppicCtrl'),
                    activeControllerCls: 'banneractive'
                });
				
				 var bannerSlider = new Slider($('#ztbanner_tabs'), {
                    time: 5000,
                    delay: 400,
                    event: 'hover',
                    auto: true,
                    mode: 'fade',
                    controller: $('#ztbannerCtrl'),
                    activeControllerCls: 'active'
                });
            })
// JavaScript Document

