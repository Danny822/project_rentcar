<?php
require __DIR__ . '/__cred.php';
require __DIR__ . '/__connect_db.php';

$page_name = 'user_shop_list';

include __DIR__ . '/__html_head.php';
include __DIR__ . '/__navbar.php';
?>

<script>

    const tr_str = `<tr>
                        <td><%= sid %></td>
                        <td><%= name %></td>
                        <td><%= email %></td>
                        <td><%= mobile %></td>
                        <td><%= address %></td>
                        <td><%= birthday %></td>
                    </tr>`;
    const tr_func = _.template(tr_str);
    console.log(tr_func);
</script>


