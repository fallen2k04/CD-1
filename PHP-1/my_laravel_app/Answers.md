# Câu hỏi kiểm tra

## 1. Laravel khác PHP thuần ở điểm nào?
- **Framework vs Language**: PHP là ngôn ngữ lập trình, Laravel là một framework được xây dựng trên PHP.
- **Cấu trúc MVC**: Laravel bắt buộc sử dụng mô hình Model-View-Controller, giúp code sạch và dễ bảo trì hơn so với PHP thuần thường viết trộn lẫn logic và hiển thị.
- **Tính năng có sẵn**: Laravel cung cấp sẵn các thư viện để xử lý Database (Eloquent ORM), Routing, Authentication, Validation, Security (CSRF, XSS), v.v. giúp phát triển nhanh hơn.

## 2. Route dùng để làm gì?
- Route đóng vai trò là "biển chỉ đường". Nó ánh xạ các URL (đường dẫn người dùng nhập trên trình duyệt) tới các phương thức xử lý tương ứng trong Controller.

## 3. Controller có vai trò gì?
- Controller là bộ não xử lý logic. Nó nhận yêu cầu từ Route, giao tiếp với Model để lấy/lưu dữ liệu, xử lý các nghiệp vụ (vd: validation, tính toán) và sau đó trả về View tương ứng cho người dùng.

## 4. Migration là gì?
- Migration giống như một hệ thống quản lý phiên bản cho Database (Version Control for Database). Nó cho phép bạn định nghĩa các bảng và cột của cơ sở dữ liệu bằng code PHP thay vì viết SQL trực tiếp, giúp dễ dàng đồng bộ hóa cấu trúc database giữa các thành viên trong nhóm.

## 5. Dữ liệu được lưu ở đâu?
- Trong ứng dụng này, dữ liệu được lưu trong **Cơ sở dữ liệu MySQL** (database `student_db`, bảng `students`).
