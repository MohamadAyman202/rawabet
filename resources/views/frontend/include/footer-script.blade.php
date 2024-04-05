<script src="{{ URL::asset('frontend/assets/js/loader.js') }}"></script>
<script src="{{ URL::asset('frontend/assets/js/scrollSticky.js') }}"></script>
<script src="{{ URL::asset('frontend/assets/fontawesome/js/all.min.js') }}"></script>
<script src="{{ URL::asset('frontend/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
@yield('js')
<script>
    $(function() {
        console.log(window.location.origin);
        data();
        $("#category_id").on("change", function() {
            data()
        })
    });

    function data() {
        const id = $('#category_id').val();
        if (id) {
            $.ajax({
                type: "GET",
                url: `${window.location.origin}/get_data/${id}`,
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
<!-- Internal Select2 js-->
<script src="{{ URL::asset('backend/assets/plugins/select2/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<script src="{{ URL::asset('frontend/assets/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
