README

1. Cách chạy
- Yêu cầu: Cài đặt XAMPP (hoặc các phần mềm tương tự như WAMP, Laragon).
- Bước 1: Copy thư mục dự án `mvc_sinhvien` vào thư mục `htdocs` của XAMPP (VD: `C:\xampp\htdocs\mvc_sinhvien`).
- Bước 2: Mở XAMPP Control Panel, khởi động (Start) Apache và MySQL.
- Bước 3: (Cấu hình Port MySQL nếu cần) Vào file `model/Database.php`, kiểm tra biến `$port`. Mặc định ứng dụng dùng thư mục `$port = "3307"`. Nếu MySQL của bạn chạy ở port 3306 mặc định, hãy đổi lại thành `$port = "3306"`.
- Bước 4: Mở trình duyệt và truy cập: http://localhost/mvc_sinhvien/
Lưu ý: Bạn không cần tạo Database bằng tay. Ứng dụng sẽ tự động tạo Database `mvc_sinhvien_db`, bảng `students` và dữ liệu mẫu trong lần chạy đầu tiên.

---

2. Các chức năng đã làm
- Xem danh sách sinh viên: Hiển thị toàn bộ sinh viên trong cơ sở dữ liệu lên bảng (Read).
- Thêm sinh viên mới: Cho phép nhập tên và chuyên ngành để thêm một sinh viên mới vào cơ sở dữ liệu (Create).
- Sửa thông tin sinh viên: Cho phép cập nhật tên và chuyên ngành của một sinh viên đã có (Update).
- Xóa sinh viên: Cho phép xóa một sinh viên khỏi cơ sở dữ liệu (Delete).
- Tự động cấp phát CSDL: Tự động khởi tạo cấu trúc Database, Table và chèn dữ liệu mẫu nếu chưa tồn tại.
- Áp dụng mô hình MVC: Tách biệt logic xử lý thành các thành phần Model (Database, Student), View (giao diện HTML/PHP), và Controller (StudentController).
