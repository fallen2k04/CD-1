<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa sinh viên</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f0f2f5; padding: 30px; color: #333; }
        .container { max-width: 500px; margin: 0 auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); padding: 30px; }
        h2 { color: #2c3e50; margin-bottom: 20px; font-size: 22px; }
        .form-group { margin-bottom: 16px; }
        label { display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px; color: #555; }
        input[type="text"] { width: 100%; padding: 10px 12px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; }
        input[type="text"]:focus { outline: none; border-color: #3498db; box-shadow: 0 0 0 2px rgba(52,152,219,0.15); }
        .btn { display: inline-block; padding: 10px 22px; border: none; border-radius: 6px; cursor: pointer; font-size: 14px; text-decoration: none; color: #fff; transition: opacity 0.2s; }
        .btn:hover { opacity: 0.85; }
        .btn-save { background: #2980b9; }
        .btn-back { background: #95a5a6; margin-left: 8px; }
        .errors { background: #fdecea; border: 1px solid #f5c6cb; border-radius: 6px; padding: 12px 16px; margin-bottom: 16px; }
        .errors li { color: #c0392b; font-size: 14px; margin-left: 16px; }
        .id-display { background: #f8f9fa; padding: 8px 12px; border-radius: 6px; font-size: 14px; color: #555; margin-bottom: 16px; }
        .btn-group { margin-top: 10px; }
    </style>
</head>
<body>
<div class="container">
    <h2>✏️ Sửa thông tin sinh viên</h2>

    <div class="id-display">
        <strong>ID:</strong> <?= $student['id'] ?>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="errors">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?action=edit">
        <input type="hidden" name="id" value="<?= $student['id'] ?>">
        <div class="form-group">
            <label for="name">Họ tên:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($name ?? $student['name']) ?>">
        </div>
        <div class="form-group">
            <label for="major">Ngành học:</label>
            <input type="text" id="major" name="major" value="<?= htmlspecialchars($major ?? $student['major']) ?>">
        </div>
        <div class="btn-group">
            <button type="submit" class="btn btn-save">💾 Cập nhật</button>
            <a href="index.php?action=list" class="btn btn-back">↩️ Quay lại</a>
        </div>
    </form>
</div>
</body>
</html>
