<!DOCTYPE html>
<html lang="ru">
<head>
    <base href="<?=BASE_URL?>">
    <meta charset="utf-8">
</head>
<body>

<table width="50%" align="center" border="0">
    <tr>
        <th bgcolor="#428bca" style="font-size: 50px">
            <a style="color: #cdddeb; text-decoration: none" href="<?=BASE_URL?>"><img src="images/phpfinansist_logo_plain.svg">
            phpfinansist
            </a>
        </th>
    </tr>
    <tr bgcolor="#f3f3f3">
        <td  height="300px">
            <?php include BASE_PATH . 'application/views/'.$content_view; ?>
        </td>
    </tr>
    <tr align="center" bgcolor="#bbbbbb">
        <td>
            подвал
        </td>
    </tr>

</table>

</body>
</html>
