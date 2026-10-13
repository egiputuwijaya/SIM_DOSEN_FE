/**
 * SIM Dosen - Frontend Script
 */

document.addEventListener('DOMContentLoaded', () => {
  // 1. Auto dismiss alerts after 5 seconds
  document.querySelectorAll('.alert').forEach(alert => {
    const closeBtn = alert.querySelector('.alert-close');
    if (closeBtn) {
      closeBtn.addEventListener('click', () => alert.remove());
    }
    setTimeout(() => {
      alert.style.opacity = '0';
      alert.style.transform = 'translateY(-10px)';
      alert.style.transition = 'all 0.3s ease';
      setTimeout(() => alert.remove(), 300);
    }, 6000);
  });

  // 2. Tab switcher (Login page)
  const tabBtns = document.querySelectorAll('.login-tab-btn');
  const tabContents = document.querySelectorAll('.login-tab-content');

  tabBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      const targetId = btn.getAttribute('data-tab');

      tabBtns.forEach(b => b.classList.remove('active'));
      tabContents.forEach(c => c.classList.remove('active'));

      btn.classList.add('active');
      const targetContent = document.getElementById(targetId);
      if (targetContent) {
        targetContent.classList.add('active');
      }
    });
  });

  // 3. Modal Delete Confirmation
  const deleteModal = document.getElementById('deleteConfirmModal');
  const deleteForm = document.getElementById('deleteConfirmForm');
  const deleteDosenName = document.getElementById('deleteDosenName');

  window.confirmDelete = function (id, nama) {
    if (!deleteModal || !deleteForm) return;

    deleteDosenName.textContent = `"${nama}" (ID #${id})`;
    deleteForm.setAttribute('action', `${window.BASE_URL}/dosen/${id}`);

    deleteModal.classList.add('is-active');
  };

  window.closeDeleteModal = function () {
    if (deleteModal) {
      deleteModal.classList.remove('is-active');
    }
  };

  if (deleteModal) {
    deleteModal.addEventListener('click', (e) => {
      if (e.target === deleteModal) {
        closeDeleteModal();
      }
    });
  }

  // 4. Modal Quick View Dosen Detail
  const detailModal = document.getElementById('dosenDetailModal');
  window.viewDosenDetail = function (dosenData) {
    if (!detailModal) return;

    for (const [key, value] of Object.entries(dosenData)) {
      const elem = document.getElementById(`detail_${key}`);
      if (elem) {
        elem.textContent = value || '-';
      }
    }

    detailModal.classList.add('is-active');
  };

  window.closeDetailModal = function () {
    if (detailModal) {
      detailModal.classList.remove('is-active');
    }
  };

  if (detailModal) {
    detailModal.addEventListener('click', (e) => {
      if (e.target === detailModal) {
        closeDetailModal();
      }
    });
  }

  // 5. Cek status API Backend secara asinkron (untuk status bar)
  const apiStatusBadge = document.getElementById('apiStatusBadge');
  if (apiStatusBadge) {
    fetch(`${window.BASE_URL}/api-status`)
      .then(res => res.json())
      .then(res => {
        if (res.success && res.data && res.data.database === 'terhubung') {
          apiStatusBadge.className = 'badge badge-success';
          apiStatusBadge.innerHTML = '● API Backend Terhubung';
        } else {
          apiStatusBadge.className = 'badge badge-warning';
          apiStatusBadge.innerHTML = '▲ API Health Issues';
        }
      })
      .catch(() => {
        apiStatusBadge.className = 'badge badge-danger';
        apiStatusBadge.innerHTML = '✕ API Backend Offline/500';
      });
  }
});
