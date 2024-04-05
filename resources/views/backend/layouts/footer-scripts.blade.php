<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
<!-- JQuery min js -->
<script src="{{ URL::asset('backend/assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap Bundle js -->
<script src="{{ URL::asset('backend/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Ionicons js -->
<script src="{{ URL::asset('backend/assets/plugins/ionicons/ionicons.js') }}"></script>
<!-- Moment js -->
<script src="{{ URL::asset('backend/assets/plugins/moment/moment.js') }}"></script>

<!-- Rating js-->
<script src="{{ URL::asset('backend/assets/plugins/rating/jquery.rating-stars.js') }}"></script>
<script src="{{ URL::asset('backend/assets/plugins/rating/jquery.barrating.js') }}"></script>

<!--Internal  Perfect-scrollbar js -->
<script src="{{ URL::asset('backend/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ URL::asset('backend/assets/plugins/perfect-scrollbar/p-scroll.js') }}"></script>
<!--Internal Sparkline js -->
<script src="{{ URL::asset('backend/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<!-- Custom Scroll bar Js-->
<script src="{{ URL::asset('backend/assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<!-- right-sidebar js -->
<script src="{{ URL::asset('backend/assets/plugins/sidebar/sidebar.js') }}"></script>
<script src="{{ URL::asset('backend/assets/plugins/sidebar/sidebar-custom.js') }}"></script>
<!-- Eva-icons js -->
<script src="{{ URL::asset('backend/assets/js/eva-icons.min.js') }}"></script>
@yield('js')
<!-- Sticky js -->
<script src="{{ URL::asset('backend/assets/js/sticky.js') }}"></script>
<!-- custom js -->
<script src="{{ URL::asset('backend/assets/js/custom.js') }}"></script><!-- Left-menu js-->
<script src="{{ URL::asset('backend/assets/plugins/side-menu/sidemenu.js') }}"></script>

<script>
    $(function() {
        data(), $("#category_id").on("change", function() {
            data()
        })
    });

    function data() {
        const id = $('#category_id').val();
        if (id) {
            $.ajax({
                type: "GET",
                url: `${window.location.origin}/admin/get_data/${id}`,
                success: function(response) {
                    $('#sub_category_id').empty().append(
                        `<option selected disabled>{!! __('web.sub_category') !!}</option>`);
                    $.each(response.data, function(i, ele) {
                        $('#sub_category_id').append(
                            `<option value="${ele.id}">${ele.title.{!! app()->getLocale() == 'en' ? 'en' : 'ar' !!}}</option>`
                        );
                    });
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    }
</script>
<script type="text/javascript" src="{{ asset('backend/froala_editor_4.1.4/js/froala_editor.pkgd.min.js') }}"></script>
<script>
    new FroalaEditor("textarea#editor"), new FroalaEditor("textarea#editor1");
</script>
<script type="text/javascript" src="{{ asset('backend/assets/js/main.js') }}"></script>

<script src="{{ asset('assets/js/script.js') }}"></script>
