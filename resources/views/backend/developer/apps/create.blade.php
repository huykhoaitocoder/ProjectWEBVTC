@extends('backend.developer.layout')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg p-4">
        <h2 class="mb-4 text-center">Tạo ứng dụng mới</h2>

        <form id="appForm" action="{{ route('developer.apps.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Tên ứng dụng:</label>
                <input type="text" id="name" name="name" class="form-control" required placeholder="Nhập tên ứng dụng">
            </div>

            <div class="mb-3">
                <label class="form-label">Gói ứng dụng (package name):</label>
                <input type="text" id="package_name" name="package_name" class="form-control" required placeholder="Nhập package name">
            </div>

            <div class="mb-3">
                <label class="form-label">Danh mục:</label>
                <select id="category_id" name="category_id" class="form-select">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả:</label>
                <textarea id="description" name="description" class="form-control" rows="3" required placeholder="Nhập mô tả ứng dụng"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Giá:</label>
                <input type="number" id="price" name="price" class="form-control" step="0.01" min="0" placeholder="Nhập giá ứng dụng (bỏ qua nếu miễn phí)">
            </div>

            <div class="mb-3">
                <label class="form-label">Icon:</label>
                <input type="file" id="icon" name="icon" class="form-control" accept="image/*" required>
            </div>

            <hr class="my-4">

            <h4 class="mb-3">Phiên bản đầu tiên</h4>

            <div class="mb-3">
                <label class="form-label">Tên phiên bản:</label>
                <input type="text" id="version_name" name="version_name" class="form-control" required placeholder="Nhập tên phiên bản">
            </div>

            <div class="mb-3">
                <label class="form-label">APK:</label>
                <input type="file" id="apk" name="apk" class="form-control" accept=".apk,.xapk" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Changelog:</label>
                <textarea name="changelog" class="form-control" rows="3" placeholder="Nhập nội dung mô tả phiên bản (nếu có)"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Ảnh chụp màn hình (tối đa 10 ảnh):</label>
                <input type="file" id="screenshots" name="screenshots[]" class="form-control" accept="image/*" multiple required>
                <small class="text-danger" id="error-message"></small>
            </div>

            <div class="mb-3">
                <label class="form-label">Video (tùy chọn):</label>
                <input type="file" id="video" name="video" class="form-control" accept="video/*">
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success btn-lg">Tạo ứng dụng</button>
            </div>
        </form>
    </div>
</div>
@endsection

<script>
document.addEventListener("DOMContentLoaded", function () {
    let form = document.getElementById("appForm");
    let submitButton = form.querySelector('button[type="submit"]');

    function createErrorElement(input, message) {
        let errorSpan = input.nextElementSibling;
        if (!errorSpan || !errorSpan.classList.contains("text-danger")) {
            errorSpan = document.createElement("small");
            errorSpan.classList.add("text-danger", "d-block");
            input.insertAdjacentElement("afterend", errorSpan);
        }

        // Cập nhật nội dung lỗi và hiển thị/ẩn thông báo
        errorSpan.textContent = message;
        errorSpan.style.display = message ? "block" : "none";  // Ẩn lỗi nếu không có thông báo
    }

    function validateInput(input, condition, errorMessage) {
        input.addEventListener("input", function () {
            // Nếu giá trị hợp lệ, ẩn lỗi
            if (condition(input.value.trim())) {
                createErrorElement(input, "");  // Ẩn thông báo lỗi
            }
        });

        input.addEventListener("blur", function () {
            // Nếu không hợp lệ, hiển thị lỗi
            if (!condition(input.value.trim())) {
                createErrorElement(input, errorMessage);
            } else {
                createErrorElement(input, "");  // Ẩn lỗi khi hợp lệ
            }
            checkFormValidity();  // Kiểm tra tính hợp lệ của form
        });
    }

    function checkFormValidity() {
        let isValid = true;
        document.querySelectorAll(".text-danger").forEach(error => {
            if (error.style.display === "block") {
                isValid = false;  // Nếu có lỗi hiển thị thì form không hợp lệ
            }
        });
        submitButton.disabled = !isValid;  // Vô hiệu hóa nút submit nếu có lỗi
    }

    // Kiểm tra và xử lý các trường đầu vào
    validateInput(
        document.getElementById("name"),
        value => value !== "" && value.length <= 255,
        "Tên ứng dụng không được để trống và tối đa 255 ký tự."
    );

    validateInput(
        document.getElementById("description"),
        value => value !== "",
        "Mô tả không được để trống."
    );

    validateInput(
        document.getElementById("price"),
        value => value === "" || (!isNaN(value) && parseFloat(value) >= 0),
        "Giá không hợp lệ."
    );

    // Kiểm tra Package Name
    let packageInput = document.getElementById("package_name");
    let packageError = packageInput.nextElementSibling;
    if (!packageError || !packageError.classList.contains("text-danger")) {
        packageError = document.createElement("small");
        packageError.classList.add("text-danger", "d-block");
        packageInput.insertAdjacentElement("afterend", packageError);
    }

    packageInput.addEventListener("input", function () {
        packageError.style.display = "none";  // Ẩn lỗi khi người dùng nhập
    });

    packageInput.addEventListener("blur", function () {
        let packageName = this.value.trim();
        if (packageName === "") {
            createErrorElement(packageInput, "Package Name không được để trống.");
            checkFormValidity();
            return;
        }

        fetch(`/check-package-name?package_name=${encodeURIComponent(packageName)}`)
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    createErrorElement(packageInput, "Package Name đã tồn tại!");
                } else {
                    createErrorElement(packageInput, "");  // Ẩn lỗi nếu không tồn tại
                }
                checkFormValidity();
            })
            .catch(error => {
                createErrorElement(packageInput, "Lỗi kiểm tra package.");
                checkFormValidity();
            });
    });

    // Kiểm tra các trường file (icon, APK, screenshots)
    document.getElementById("icon").addEventListener("change", function () {
        let errorSpan = this.nextElementSibling;
        if (!this.files[0]) {
            createErrorElement(this, "Vui lòng tải lên icon ứng dụng.");
        } else {
            createErrorElement(this, "");  // Ẩn lỗi khi có icon
        }
        checkFormValidity();
    });

    document.getElementById("apk").addEventListener("change", function () {
        let errorSpan = this.nextElementSibling;
        let file = this.files[0];
        if (!file) {
            createErrorElement(this, "Vui lòng tải lên file APK/XAPK!");
        } else {
            let allowedTypes = ["apk", "xapk"];
            let fileExt = file.name.split(".").pop().toLowerCase();
            if (!allowedTypes.includes(fileExt) || file.size > 150 * 1024 * 1024) {
                createErrorElement(this, "File APK không hợp lệ hoặc vượt quá 150MB!");
            } else {
                createErrorElement(this, "");  // Ẩn lỗi khi file hợp lệ
            }
        }
        checkFormValidity();
    });

    document.getElementById("screenshots").addEventListener("change", function () {
        let errorSpan = this.nextElementSibling;
        if (this.files.length > 10) {
            createErrorElement(this, "Chỉ được tải lên tối đa 10 ảnh.");
        } else {
            createErrorElement(this, "");  // Ẩn lỗi khi số lượng ảnh hợp lệ
        }
        checkFormValidity();
    });

    checkFormValidity();
});
</script>

