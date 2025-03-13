<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="reviewForm" method="POST" action="{{ route('reviews.store', $app->id) }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="reviewModalLabel">Đánh giá {{ $app->name }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="rating" class="form-label">Đánh giá (1-5 sao)</label>
            <select name="rating" id="rating" class="form-select" required>
              @for ($i = 5; $i >= 1; $i--)
                <option value="{{ $i }}">{{ $i }} ⭐</option>
              @endfor
            </select>
          </div>
          <div class="mb-3">
            <label for="comment" class="form-label">Bình luận</label>
            <textarea name="comment" id="comment" class="form-control" rows="3" placeholder="Nhập bình luận..."></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-success">Gửi đánh giá</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.getElementById('reviewForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch(this.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) throw new Error('Lỗi máy chủ!');
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert('✅ Đánh giá thành công!');
            const modal = bootstrap.Modal.getInstance(document.getElementById('reviewModal'));
            modal.hide();
            location.reload();  // Cập nhật lại đánh giá mới
        } else {
            alert('❌ Có lỗi xảy ra.');
        }
    })
    .catch(error => {
        console.error(error);
        alert('🚫 Lỗi gửi đánh giá!');
    });
});
</script>
