$(function () {
    // Remove button click
    $(document).on(
        'click',
        '[data-role="dynamic-fields"] > .form-inline [data-role="remove"]',
        function (e) {
            e.preventDefault();
            $(this).closest('.form-inline').remove();
        }
    );
    // Add button click
    var n_users = 0;
    $(document).on(
        'click',
        '[data-role="dynamic-fields"] > .form-inline [data-role="add"]',
        function (e) {
            n_users++;
            e.preventDefault();
            var container = $(this).closest('[data-role="dynamic-fields"]');
            new_field_group = container.children().filter('.form-inline:first-child').clone();
            $(new_field_group.find('input')[0]).attr('name', 'username'+ n_users);
            $(new_field_group.find('input')[1]).attr('name', 'userpass'+ n_users);
            new_field_group.find('input').each(function () {
                $(this).val('');
            });
            new_field_group.find('select').each(function () {
                $(this).attr('name', 'roles' + n_users);
            });
            container.append(new_field_group);
        }
    );
});
