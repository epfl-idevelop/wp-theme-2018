<?php
    $predefined_faculty = get_query_var('epfl_labs-predefined_faculty');
?>

<script type='text/javascript'>
    jQuery(document).ready(function( $ ) {
        var options = {
            valueNames: [
                'site-title',
                'site-tagline',
                {name: 'site-url', attr: 'href'},
                {name: 'site-tags', attr: 'data-tags'}
            ],
            page: 500,
            indexAsync: true
        };

        var siteList = new List('sites-list', options);

        $('.epfl-labs-select').each(function (index, element) {
            $(element).change(function (e) {
                let filter_on = $(this).val();
                if ($(this).val() === 'all') {
                    siteList.filter();
                } else {
                    siteList.filter(function(item) {
                        tags = item.values()['site-tags'].split(";");
                        return (tags.includes(filter_on));
                    });
                }
            });
        });

        <?php if (!empty($predefined_faculty)): ?>
        $('#select-faculty').change();
        <?php endif;?>
    });
</script>
