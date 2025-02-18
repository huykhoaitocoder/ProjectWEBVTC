-- APKRebelPlay.com

-- roles – Danh sách vai trò 
CREATE TABLE roles (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name ENUM('admin', 'user', 'developer') NOT NULL, 
    description TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- users – Lưu thông tin người dùng, developer
CREATE TABLE users (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    avatar VARCHAR(255) NULL,
    role_id BIGINT REFERENCES roles(id),
    status ENUM('active', 'inactive') DEFAULT 'active',  
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- user_profiles – Thông tin mở rộng của người dùng
CREATE TABLE user_profiles (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT REFERENCES users(id) ON DELETE CASCADE,
    phone VARCHAR(20) NULL,
    address TEXT NULL,
    bio TEXT NULL,
    social_links JSON NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- admins – Lưu danh sách quản trị viên
CREATE TABLE admins (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT REFERENCES users(id) ON DELETE CASCADE,
    level ENUM('Super Admin', 'Moderator') NOT NULL,
    status ENUM('active', 'inactive') DEFAULT 'active', 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- developers – Lưu thông tin nhà phát triển ứng dụng
CREATE TABLE developers (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT REFERENCES users(id),
    company_name VARCHAR(255) NOT NULL,
    website VARCHAR(255) NULL,
    contact_email VARCHAR(255) NULL,
    status ENUM('active', 'inactive') DEFAULT 'active',  
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- permissions – Danh sách quyền hạn của từng vai trò
CREATE TABLE permissions (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) UNIQUE NOT NULL,
    description TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- role_permissions – Liên kết quyền hạn với vai trò
CREATE TABLE role_permissions (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    role_id BIGINT REFERENCES roles(id) ON DELETE CASCADE,
    permission_id BIGINT REFERENCES permissions(id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- categories – Danh mục ứng dụng 
CREATE TABLE categories (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) UNIQUE NOT NULL,
    status ENUM('active', 'inactive') DEFAULT 'active', 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- apps – Lưu thông tin ứng dụng (miễn phí va co tien)
CREATE TABLE apps (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    developer_id BIGINT REFERENCES developers(id),
    category_id BIGINT REFERENCES categories(id),
    name VARCHAR(255) NOT NULL,
    description TEXT,
    package_name VARCHAR(255) UNIQUE NOT NULL,
    price DECIMAL(10,2) DEFAULT 0,
    icon VARCHAR(255) NULL,
    status ENUM('approved', 'pending', 'rejected') DEFAULT 'pending',
    total_downloads BIGINT DEFAULT 0,  -- Trường tổng lượt tải
    average_rating DECIMAL(3,2) DEFAULT 0,  -- Trường đánh giá trung bình
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- app_versions – Phiên bản ứng dụng 
CREATE TABLE app_versions (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    app_id BIGINT REFERENCES apps(id) ON DELETE CASCADE,
    version_name VARCHAR(50) NOT NULL,
    version_code INT NOT NULL,
    apk_file VARCHAR(255) NOT NULL,
    file_size BIGINT NOT NULL,
    status ENUM('current', 'old', 'hidden') DEFAULT 'current',  
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- app_permissions – Quyền ứng dụng yêu cầu (camera, micro......)
CREATE TABLE app_permissions (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    app_id BIGINT REFERENCES apps(id) ON DELETE CASCADE,
    permission_name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- downloads – Lưu lượt tải ứng dụng
CREATE TABLE downloads (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT,
    app_id BIGINT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (app_id) REFERENCES apps(id) ON DELETE CASCADE
);


-- screenshots – Ảnh chụp màn hình ứng dụng 
CREATE TABLE screenshots (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    app_id BIGINT REFERENCES apps(id) ON DELETE CASCADE,
    image_url VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- reviews – Đánh giá ứng dụng của người dùng 
CREATE TABLE reviews (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT REFERENCES users(id),
    app_id BIGINT REFERENCES apps(id) ON DELETE CASCADE,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    comment TEXT NULL,
    status ENUM('approved', 'pending', 'deleted') DEFAULT 'approved', 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- review_replies – Phản hồi của developer đối với đánh giá
CREATE TABLE review_replies (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    review_id BIGINT REFERENCES reviews(id) ON DELETE CASCADE,
    developer_id BIGINT REFERENCES developers(id),
    response TEXT NOT NULL,
    status ENUM('approved', 'pending', 'deleted') DEFAULT 'approved', 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- app_updates – Lịch sử cập nhật ứng dụng
CREATE TABLE app_updates (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    app_id BIGINT REFERENCES apps(id) ON DELETE CASCADE,
    version_id BIGINT REFERENCES app_versions(id) ON DELETE CASCADE,
    update_notes TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- purchases – Lưu lịch sử mua ứng dụng trả phí
CREATE TABLE purchases (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT REFERENCES users(id),
    app_id BIGINT REFERENCES apps(id),
    amount DECIMAL(10,2) NOT NULL,
    payment_status ENUM('pending', 'completed', 'failed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- payments – Lưu thông tin thanh toán khi mua ứng dụng
CREATE TABLE payments (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    purchase_id BIGINT REFERENCES purchases(id) ON DELETE CASCADE,
    payment_method ENUM('credit_card', 'paypal', 'bank_transfer') NOT NULL,
    transaction_id VARCHAR(255) UNIQUE NOT NULL,
    status ENUM('success', 'failed', 'pending') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- refunds – Lưu thông tin hoàn tiền ứng dụng
CREATE TABLE refunds (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    purchase_id BIGINT REFERENCES purchases(id) ON DELETE CASCADE,
    reason TEXT NOT NULL,
    refund_status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- subscriptions – Lưu thông tin đăng ký thuê bao ứng dụng
CREATE TABLE subscriptions (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT REFERENCES users(id),
    app_id BIGINT REFERENCES apps(id),
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    status ENUM('active', 'expired', 'cancelled') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- discounts – Lưu mã giảm giá, khuyến mãi ứng dụng
CREATE TABLE discounts (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    app_id BIGINT REFERENCES apps(id),
    discount_percentage INT CHECK (discount_percentage BETWEEN 1 AND 100),
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- coupons – Lưu mã coupon giảm giá khi mua ứng dụng
CREATE TABLE coupons (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(50) UNIQUE NOT NULL,
    discount_percentage INT CHECK (discount_percentage BETWEEN 1 AND 100),
    max_usage INT DEFAULT 1,
    used_count INT DEFAULT 0,
    expiration_date DATE NOT NULL,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- reports – Lưu báo cáo vi phạm ứng dụng
CREATE TABLE reports (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT REFERENCES users(id),
    app_id BIGINT REFERENCES apps(id),
    report_reason_id BIGINT REFERENCES report_reasons(id),
    description TEXT NOT NULL,
    status ENUM('pending', 'reviewed', 'resolved') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- report_reasons – Danh sách lý do báo cáo ứng dụng
CREATE TABLE report_reasons (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    reason VARCHAR(255) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- developer_payments – Lưu lịch sử thanh toán doanh thu cho developer
CREATE TABLE developer_payments (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    developer_id BIGINT REFERENCES developers(id),
    amount DECIMAL(10,2) NOT NULL,
    payment_method ENUM('bank_transfer', 'paypal', 'check') NOT NULL,
    transaction_id VARCHAR(255) UNIQUE NOT NULL,
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- developer_apps – Liên kết giữa developer và ứng dụng họ sở hữu
CREATE TABLE developer_apps (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    developer_id BIGINT REFERENCES developers(id),
    app_id BIGINT REFERENCES apps(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- settings – Lưu cài đặt chung của hệ thống
CREATE TABLE settings (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(255) UNIQUE NOT NULL,
    setting_value TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- banners – Lưu thông tin banner quảng cáo trên trang chủ
CREATE TABLE banners (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    image_url VARCHAR(255) NOT NULL,
    link VARCHAR(255) NOT NULL,
    display_order INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- notifications – Lưu thông báo gửi đến người dùng
CREATE TABLE notifications (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT,
    message TEXT NOT NULL,
    status ENUM('unread', 'read') DEFAULT 'unread',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- logs – Lưu nhật ký hoạt động hệ thống
CREATE TABLE logs (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT,
    action VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- feedbacks – Lưu phản hồi của người dùng về hệ thống
CREATE TABLE feedbacks (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT REFERENCES users(id),
    feedback TEXT NOT NULL,
    status ENUM('pending', 'resolved') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- api_keys – Lưu API key cho nhà phát triển ứng dụng
CREATE TABLE api_keys (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    developer_id BIGINT REFERENCES developers(id),
    api_key VARCHAR(255) UNIQUE NOT NULL,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- oauth_clients – Quản lý OAuth khi đăng nhập Google, Facebook
CREATE TABLE oauth_clients (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(255) NOT NULL,
    client_id VARCHAR(255) UNIQUE NOT NULL,
    client_secret VARCHAR(255) NOT NULL,
    redirect_uri VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- oauth_tokens – Lưu token xác thực API
CREATE TABLE oauth_tokens (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    client_id BIGINT REFERENCES oauth_clients(id),
    user_id BIGINT REFERENCES users(id),
    access_token VARCHAR(255) UNIQUE NOT NULL,
    refresh_token VARCHAR(255) NOT NULL,
    expires_at TIMESTAMP NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ads – Lưu thông tin quảng cáo hiển thị trên web
CREATE TABLE ads (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    link VARCHAR(255) NOT NULL,
    display_order INT DEFAULT 1,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- sponsored_apps – Lưu ứng dụng được tài trợ (hiển thị trên trang chủ)
CREATE TABLE sponsored_apps (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    app_id BIGINT REFERENCES apps(id),
    sponsor_name VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    display_order INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- blog_posts – Lưu bài viết tin tức, hướng dẫn
CREATE TABLE blog_posts (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    author_id BIGINT REFERENCES users(id),
    published_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('draft', 'published', 'archived') DEFAULT 'draft',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- blog_categories – Danh mục bài viết
CREATE TABLE blog_categories (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) UNIQUE NOT NULL,
    status ENUM('active', 'inactive') DEFAULT 'active',  
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- blog_comments – Bình luận bài viết
CREATE TABLE blog_comments (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    post_id BIGINT REFERENCES blog_posts(id) ON DELETE CASCADE,
    user_id BIGINT REFERENCES users(id),
    comment TEXT NOT NULL,
    status ENUM('approved', 'pending', 'rejected') DEFAULT 'approved',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- slider
CREATE TABLE sliders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NULL,
    image VARCHAR(255) NOT NULL,
    link VARCHAR(255) NULL,
    position INT DEFAULT 1,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
