<script src="/assets/admin/js/plugins/popper.min.js"></script>
<script src="/assets/admin/js/plugins/simplebar.min.js"></script>
<script src="/assets/admin/js/plugins/bootstrap.min.js"></script>
<script src="/assets/admin/js/fonts/custom-font.js"></script>
<script src="/assets/admin/js/pcoded.js"></script>
<script src="/assets/admin/js/plugins/feather.min.js"></script>
<script>
    layout_change("light");
</script>
<script>
    change_box_container("false");
</script>
<script>
    layout_caption_change("true");
</script>
<script>
    layout_rtl_change("false");
</script>
<script>
    preset_change("preset-9");
</script>
<script>
    main_layout_change("vertical");
</script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.4/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.4/js/responsive.bootstrap5.js"></script>
<script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js"></script>
<script src="{{ asset('assets/admin/plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/ckfinder/ckfinder.js') }}"></script>
<script src="{{ asset('assets/admin/custom/finder.js') }}"></script>
<script src="{{ asset('assets/admin/custom/datatable.js') }}"></script>
<script>
    const BASE_URL = '{{ url('/') }}';
    var input_tag = document.querySelector('.tagify');
    new Tagify(input_tag)

    if ($(".js-choice")) {
        const element_vd = document.querySelector('.js-choice');
        const choices = new Choices(element_vd, {
            searchEnabled: true,
            removeItemButton: true,
            shouldSort: false,
            placeholder: true,
            placeholderValue: 'Chọn thể loại',
        });
    }
</script>

@stack('scripts')
