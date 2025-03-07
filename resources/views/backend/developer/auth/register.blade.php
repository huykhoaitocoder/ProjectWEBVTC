@extends('frontend.layout')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="form-container p-5" style="max-width: 800px; width: 100%; background: white; border-radius: 12px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); margin-top: -304px;">
        <h2 class="text-center mb-4" style="padding-bottom: 24px;">Đăng ký Developer</h2>

        <div class="progress mb-4" style="height: 12px;">
            <div class="progress-bar bg-primary" id="progressBar" style="width: 33%;"></div>
        </div>

        <form id="developerForm">
            <div id="step1">
                <h4>Đầu tiên, nhập tên Developer</h4>
                <input type="text" name="name" id="developer_name" class="form-control form-control-lg mt-4" maxlength="50" placeholder="Tên hiển thị trên VH APK" required>
                <small id="nameError" class="text-danger mt-3"></small>
                <div class="mt-5 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary btn-lg px-5" id="continueBtn" onclick="nextStep(2)" disabled>Tiếp tục</button>
                </div>
            </div>

            <div id="step2" style="display: none;">
                <h4>Nhập hồ sơ Developer</h4>
                <input type="text" name="full_name" class="form-control form-control-lg mt-4" placeholder="Họ và tên đầy đủ" required>
                <input type="email" name="email" class="form-control form-control-lg mt-4" placeholder="Email" required>
                <input type="text" name="phone" class="form-control form-control-lg mt-4" placeholder="Số điện thoại" required>
                <input type="text" name="address" class="form-control form-control-lg mt-4" placeholder="Địa chỉ" required>
                <input type="url" name="website" class="form-control form-control-lg mt-4" placeholder="Website (nếu có)">
                <div class="mt-5 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary btn-lg px-5" onclick="prevStep(1)">Quay lại</button>
                    <button type="button" class="btn btn-primary btn-lg px-5" onclick="nextStep(3)">Tiếp tục</button>
                </div>
            </div>

            <div id="step3" style="display: none;">
                <h4>Hoàn thành</h4>
                <p class="mt-4">Vui lòng đồng ý điều khoản để tiếp tục.</p>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="agree_terms" required>
                    <label for="agree_terms" class="form-check-label">Tôi đồng ý</label>
                </div>
                <div class="mt-5 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary btn-lg px-5" onclick="prevStep(2)">Quay lại</button>
                    <button type="submit" class="btn btn-success btn-lg px-5">Hoàn thành</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('developer_name').addEventListener('input', function () {
    let name = this.value.trim();
    let errorElement = document.getElementById('nameError');
    let continueBtn = document.getElementById('continueBtn');

    if (name.length === 0) {
        errorElement.textContent = "Vui lòng nhập tên Developer.";
        continueBtn.disabled = true;
        return;
    }

    fetch(`/check-developer-name?name=${encodeURIComponent(name)}`)
        .then(response => response.json())
        .then(data => {
            errorElement.textContent = data.message;
            errorElement.style.color = data.exists ? 'red' : 'green';
            continueBtn.disabled = data.exists;
        })
        .catch(() => {
            errorElement.textContent = "Lỗi kết nối, vui lòng thử lại.";
            continueBtn.disabled = true;
        });
});

function nextStep(step) {
    document.querySelectorAll("[id^='step']").forEach(e => e.style.display = "none");
    document.getElementById(`step${step}`).style.display = "block";
    document.getElementById('progressBar').style.width = (step / 3) * 100 + "%";
}

function prevStep(step) {
    nextStep(step);
}

document.getElementById('developerForm').addEventListener('submit', function (e) {
    e.preventDefault();
    let formData = new FormData(this);

    fetch("{{ route('developer.register') }}", {
        method: "POST",
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Network response was not ok");
        }
        return response.json(); 
    })
    .then(data => {
        if (data.success) {
            alert("Đăng ký thành công!");
            window.location.href = "{{ route('developer.dashboard') }}";
        } else {
            alert("Lỗi: " + (data.message || "Đăng ký thất bại"));
        }
    })
    .catch(error => {
        console.error("Lỗi kết nối:", error);
        alert("Lỗi!");
    });
});
</script>
@endsection
