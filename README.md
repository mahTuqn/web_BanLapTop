1. Tổng quan về kiến trúc chương trình

Chương trình được xây dựng trên Laravel Framework, tuân thủ mô hình Model-View-Controller (MVC).

* Model (M): Đại diện cho cấu trúc dữ liệu và logic nghiệp vụ liên quan đến dữ liệu, tương tác trực tiếp với cơ sở dữ liệu.
* View (V): Hiển thị giao diện người dùng thông qua các tệp Blade template (.blade.php).
* Controller (C): Trung gian giữa người dùng và Model, xử lý logic nghiệp vụ và chọn View phù hợp.

Mô hình MVC giúp mã nguồn dễ quản lý, mở rộng và bảo trì hơn.

---

2. Luồng hoạt động của chương trình (Program Execution Flow)

Khi người dùng truy cập trang web, tiến trình xử lý gồm các bước:

1. Request: Trình duyệt gửi yêu cầu HTTP (GET/POST) tới máy chủ.
2. Routing: Laravel xác định route tương ứng trong routes/web.php hoặc routes/admin.php.
3. Controller: Xử lý dữ liệu đầu vào, tương tác với Model và trả về View.
4. Model (Eloquent ORM): Thực hiện truy vấn, thêm, sửa, xóa dữ liệu.
5. View (Blade Templates): Hiển thị dữ liệu động thông qua HTML.
6. Response: Trả kết quả về trình duyệt để hiển thị.

---

3. Phân quyền Admin và CRUD (Admin Authorization and CRUD)

* Phân quyền:
  - Admin được xác định bằng cột 'role' trong bảng users.
  - Các route dành cho admin được bảo vệ bằng Middleware kiểm tra role.
  - View hiển thị nội dung tùy theo vai trò người dùng.

* CRUD:
  - Các Controller trong app/Http/Controllers/Admin xử lý thao tác CRUD (Create, Read, Update, Delete).
  - Mỗi Controller có các phương thức index(), create(), store(), edit(), update(), destroy().

---

4. Logic và tính năng

* Tìm kiếm và lọc sản phẩm theo giá, danh mục.
* Đếm lượt xem bài viết.
* Thay đổi logo động trong giao diện người dùng và admin.

---

5. Packages được sử dụng

* Eloquent ORM
* Blade Template Engine
* Laravel Authentication
* Vite + Tailwind CSS
* Composer & NPM/Yarn

---

6. Controller, View, Model (CVM)

* Controller: Nhận request, xác thực dữ liệu, gọi Model, xử lý logic, trả View.
* View: Render dữ liệu qua Blade template.
* Model: Đại diện cho bảng dữ liệu, định nghĩa thuộc tính và mối quan hệ giữa các bảng.

---

7. Tương tác với cơ sở dữ liệu

* Migrations: Định nghĩa cấu trúc CSDL bằng PHP.
* Eloquent ORM: Thao tác CRUD dễ dàng bằng cú pháp hướng đối tượng.
* Seeding: Khởi tạo dữ liệu mẫu cho phát triển và kiểm thử.

---

8. Lưu trữ ảnh và dữ liệu

* Ảnh: Lưu tại public/images hoặc storage/app/public.
  - Liên kết hiển thị bằng php artisan storage:link.
* Dữ liệu: Lưu trong MySQL, tương tác qua Model Eloquent.
