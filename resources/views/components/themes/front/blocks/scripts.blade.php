<!-- JS Global Compulsory -->
<script src="{{ asset('themes/front/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('themes/front/vendor/jquery-migrate/dist/jquery-migrate.min.js') }}"></script>
<script src="{{ asset('themes/front/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

<!-- JS Implementing Plugins -->
<script src="{{ asset('themes/front/vendor/hs-header/dist/hs-header.min.js') }}"></script>
<script src="{{ asset('themes/front/vendor/hs-go-to/dist/hs-go-to.min.js') }}"></script>
<script src="{{ asset('themes/front/vendor/hs-unfold/dist/hs-unfold.min.js') }}"></script>
<script src="{{ asset('themes/front/vendor/hs-mega-menu/dist/hs-mega-menu.min.js') }}"></script>
<script src="{{ asset('themes/front/vendor/hs-sticky-block/dist/hs-sticky-block.min.js') }}"></script>
<script src="{{ asset('themes/front/vendor/slick-carousel/slick/slick.js') }}"></script>
<script src="{{ asset('themes/front/vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script src="{{ asset('themes/front/vendor/font-awesome/js/all.js') }}"></script>
<script src="{{ asset('themes/front/vendor/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('themes/front/vendor/dropzone/dist/min/dropzone.min.js') }}"></script>

<!-- JS Front -->
<script src="{{ asset('themes/front/js/hs.core.js') }}"></script>
<script src="{{ asset('themes/front/js/hs.slick-carousel.js') }}"></script>
<script src="{{ asset('themes/front/js/hs.validation.js') }}"></script>
<script src="{{ asset('themes/front/js/hs.select2.js') }}"></script>
<script src="{{ asset('themes/front/js/hs.dropzone.jss') }}"></script>

<!-- JS Global Plugins -->
<!-- TinyMCE -->
<script src="{{ asset('plugins/tinymce/js/tinymce.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


<!-- JS Plugins Init. -->
<script>
    $(document).on('ready', function () {
        // initialization of header
        var header = new HSHeader($('#header')).init();

        // initialization of mega menu
        var megaMenu = new HSMegaMenu($('.js-mega-menu'), {
        desktop: {
            position: 'left'
        }
        }).init();

        // initialization of unfold
        var unfold = new HSUnfold('.js-hs-unfold-invoker').init();

        // initialization of form validation
        $('.js-validate').each(function () {
        var validation = $.HSCore.components.HSValidation.init($(this));
        });

        // initialization of slick carousel
        $('#heroSliderNav').on('init', function (event, slick) {
        $(slick.$slider).find('.slick-pagination-line-progress .slick-pagination-line-progress-helper').each(function() {
            $(this).css({
            transitionDuration: (slick.options.autoplaySpeed - slick.options.speed) + 'ms'
            });
        });

        setTimeout(function() {
            $(slick.$slider).addClass('slick-dots-ready');
        });
        });

        $('#heroSliderNav').one('beforeChange', function (event, slick) {
        $(slick.$slider).find('.slick-pagination-line-progress .slick-pagination-line-progress-helper').each(function() {
            $(this).css({
            transitionDuration: (slick.options.autoplaySpeed + slick.options.speed) + 'ms'
            });
        });
        });

        // initialization of slick carousel
        $('.js-slick-carousel').each(function() {
        var slickCarousel = $.HSCore.components.HSSlickCarousel.init($(this));
        });

        $(window).on('resize', function() {
        $('#heroSliderNav').slick('setPosition');
        });

        // initialization of sticky blocks
        $('.js-sticky-block').each(function () {
        var stickyBlock = new HSStickyBlock($(this)).init();
        });

        // initialization of go to
        $('.js-go-to').each(function () {
        var goTo = new HSGoTo($(this)).init();
        });
    });

    // initialization of select picker
    $('.js-custom-select').each(function () {
        var select2 = $.HSCore.components.HSSelect2.init($(this));
    });

    // Dropzone initialization
    $('.dz-dropzone').each(function () {
      // initialization of dropzone file attach module
      var dropzone = $.HSCore.components.HSDropzone.init('#' + $(this).attr('id'));
    });
    
</script>