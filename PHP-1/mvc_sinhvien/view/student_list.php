<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f0f2f5; padding: 30px; color: #333; }
        .container { max-width: 900px; margin: 0 auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); padding: 30px; }
        h2 { color: #2c3e50; margin-bottom: 20px; font-size: 24px; }
        .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 10px; }
        .btn { display: inline-block; padding: 8px 18px; border: none; border-radius: 6px; cursor: pointer; font-size: 14px; text-decoration: none; color: #fff; transition: opacity 0.2s; }
        .btn:hover { opacity: 0.85; }
        .btn-add { background: #27ae60; }
        .btn-edit { background: #2980b9; padding: 5px 12px; font-size: 13px; }
        .btn-delete { background: #e74c3c; padding: 5px 12px; font-size: 13px; }
        .search-form { display: flex; gap: 8px; }
        .search-form input[type="text"] { padding: 8px 12px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; width: 220px; }
        .search-form button { background: #3498db; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 10px 14px; text-align: left; border-bottom: 1px solid #e0e0e0; }
        th { background: #f8f9fa; color: #555; font-weight: 600; font-size: 14px; }
        tr:hover { background: #f5f7fa; }
        td { font-size: 14px; }
        .actions { display: flex; gap: 6px; }
        .pagination { display: flex; gap: 6px; justify-content: center; margin-top: 10px; }
        .pagination a, .pagination span { padding: 6px 14px; border-radius: 6px; text-decoration: none; font-size: 14px; border: 1px solid #ddd; color: #333; }
        .pagination a:hover { background: #3498db; color: #fff; border-color: #3498db; }
        .pagination .active { background: #3498db; color: #fff; border-color: #3498db; }
        .empty-msg { text-align: center; padding: 30px; color: #999; font-size: 15px; }
        .search-info { margin-bottom: 10px; color: #666; font-size: 14px; }
        .search-info a { color: #3498db; }
    </style>
</head>
<body>
<div class="container">
    <h2>📋 Danh sách sinh viên</h2>

    <div class="top-bar">
        <a href="index.php?action=add" class="btn btn-add">➕ Thêm sinh viên</a>
        <form class="search-form" method="GET" action="index.php">
            <input type="hidden" name="action" value="list">
            <input type="text" name="keyword" placeholder="Tìm theo ID hoặc tên..." value="<?= htmlspecialchars($keyword ?? '') ?>">
            <button type="submit" class="btn" style="background:#3498db;">🔍 Tìm</button>
        </form>
    </div>

    <?php if (!empty($keyword)): ?>
        <div class="search-info">
            Kết quả tìm kiếm cho "<strong><?= htmlspecialchars($keyword) ?></strong>" (<?= $totalStudents ?> kết quả)
            — <a href="index.php?action=list">Xóa bộ lọc</a>
        </div>
    <?php endif; ?>

    <?php if (empty($students)): ?>
        <div class="empty-msg">Không có sinh viên nào.</div>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Họ tên</th>
                    <th>Ngành học</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $st): ?>
                <tr>
                    <td><?= $st["id"] ?></td>
                    <td><?= htmlspecialchars($st["name"]) ?></td>
                    <td><?= htmlspecialchars($st["major"]) ?></td>
                    <td class="actions">
                        <a href="index.php?action=edit&id=<?= $st['id'] ?>" class="btn btn-edit">✏️ Sửa</a>
                        <a href="index.php?action=delete&id=<?= $st['id'] ?>" class="btn btn-delete">🗑️ Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Phân trang -->
        <?php if ($totalPages > 1): ?>
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="index.php?action=list&page=<?= $page - 1 ?><?= $keyword ? '&keyword=' . urlencode($keyword) : '' ?>">« Trước</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <?php if ($i == $page): ?>
                    <span class="active"><?= $i ?></span>
                <?php else: ?>
                    <a href="index.php?action=list&page=<?= $i ?><?= $keyword ? '&keyword=' . urlencode($keyword) : '' ?>"><?= $i ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <a href="index.php?action=list&page=<?= $page + 1 ?><?= $keyword ? '&keyword=' . urlencode($keyword) : '' ?>">Sau »</a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
</body>
</html>
