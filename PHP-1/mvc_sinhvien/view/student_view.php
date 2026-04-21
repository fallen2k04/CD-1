<!DOCTYPE html>
<html>
<head>
    <title>Danh sách sinh viên</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { border-collapse: collapse; width: 60%; }
        th, td { border: 1px solid #999; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Danh sách sinh viên</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Họ tên</th>
            <th>Ngành học</th>
        </tr>
        <?php foreach ($students as $st): ?>
        <tr>
            <td><?= $st["id"] ?></td>
            <td><?= $st["name"] ?></td>
            <td><?= $st["major"] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
