# Za Ze Computer - Laravel 11 Project

## 🔹 Giới thiệu
Za Ze Computer là website bán máy tính được phát triển bằng **Laravel 11**, sử dụng **màu chủ đạo hồng** và tuân theo chuẩn **Model-View-Controller (MVC)**. Dự án bao gồm hai vai trò chính: **Admin** và **User**, được thiết kế để trình bày, quản trị và mô phệ hoá các tính năng thương mại điện tử cơ bản.

---

## 💡 Kiến trúc
- **Framework:** Laravel 11 (PHP 8.2+)
- **CSDL:** MySQL / MariaDB
- **Frontend:** Blade Template + Tailwind + CSS tùy chỉnh (pink-theme.css)
- **Phân quyền:** `admin` và `user`
- **Quản lý dữ liệu:** Eloquent ORM

Cấu trúc tuân thủ mô hình MVC, giúp dễ mở rộng, bảo trì và kiểm thử.

---

## 🔄 Luồng hoạt động chương trình
1. **Request:** Trình duyệt gửi yêu cầu HTTP.
2. **Routing:** Laravel định tuyến URL tới Controller tương ứng.
3. **Controller:** Xử lý logic, tương tác Model, chuẩn bị dữ liệu.
4. **Model:** Làm việc với CSDL bằng Eloquent ORM.
5. **View:** Blade render HTML và trả về giao diện.
6. **Response:** Gửi kết quả hiển thị về trình duyệt.

---

## 🔒 Phân quyền & Chức năng
### Admin
- Quản lý sản phẩm (CRUD)
- Quản lý bài viết (CRUD)
- Quản lý đơn hàng
- Quản lý người dùng

### User
- Xem danh sách sản phẩm & bài viết
- Tìm kiếm, lọc sản phẩm theo danh mục/giá
- Thêm sản phẩm vào giỏ hàng (session)
- Thanh toán tượng trưng (tạo đơn hàng)

---


## 🔗 Cài đặt
```bash
# 1. Clone repo
composer create-project laravel/laravel zaze_computer

# 2. Cấu hình file .env
DB_DATABASE=zaze_computer
DB_USERNAME=root
DB_PASSWORD=

# 3. Import CSDL
php artisan migrate:fresh --seed
hoặc import trực tiếp file zaze_computer.sql qua phpMyAdmin

# 4. Build giao diện
npm install && npm run dev

# 5. Liên kết storage (hiển thị ảnh)
php artisan storage:link

# 6. Chạy server
php artisan serve
```

**Tài khoản mẫu:**
- Admin: `admin@zaze.com` / `123456`
- User: `user@zaze.com` / `123456`

---

## 🛠️ Công nghệ sử dụng
| Loại     | Tên                                      |
|----------|------------------------------------------|
| Backend  | Laravel 11, PHP 8.2                      |
| Frontend | Blade, TailwindCSS, Vite, pink-theme.css |
| Database | MySQL / phpMyAdmin                       |
| ORM      | Eloquent ORM                             |
| Auth     | Laravel Breeze                           |
| Package  | Composer, NPM                            |

---

## 🎨 Giao diện & Màu sắc
- **Màu chủ đạo:** Hồng (#ff69b4)
- **Giao diện:** card bo tròn, shadow nhẹ, sidebar hồng.
- **View:** Blade template tùy chỉnh cho admin/user.

---


## 🔋 Tính năng nổi bật
- Quản trị CRUD toàn diện
- Giỏ hàng bằng session
- Thanh toán tượng trưng (lưu vào orders)
- Lượt xem bài viết (increment views)
- Giao diện hồng thân thiện, responsive

---

## 🔍 Ghi chú triển khai
- Dọn sạch CSDL trước khi migrate (nếu import SQL trước).
- Dùng lệnh `php artisan migrate:fresh --seed` để reset và nhập lại toàn bộ.
- Đảm bảo đã cài Node và Composer.

---

## 🔗 Giấy phép
MIT License — Copyright © 2025 Lưu Đức Hiệp
