function openModal(id) {
const data = registrations.find(row => row.id == id);
if (data) {
    document.getElementById("popupContent").innerHTML = `
        <div class="detail_pasien">
            <p class="label">No Rekam Medis</p>
            <p class="value">${escapeHtml(data.no_rm)}</p>
        </div>
        <div class="detail_pasien">
            <p class="label">Antrian</p>
            <p class="value">${escapeHtml(data.antrian)}</p>
        </div>
        <div class="detail_pasien">
            <p class="label">Nama</p>
            <p class="value">${escapeHtml(data.nama)}</p>
        </div>
        <div class="detail_pasien">
            <p class="label">Tanggal Lahir</p>
            <p class="value">${escapeHtml(data.tanggal_lahir || '-')}</p>
        </div>
        <div class="detail_pasien">
            <p class="label">Jenis Kelamin</p>
            <p class="value">${escapeHtml(data.jenis_kelamin || '-')}</p>
        </div>
        <div class="detail_pasien">
            <p class="label">Nama Dokter</p>
            <p class="value">${escapeHtml(data.nama_dokter)}</p>
        </div>
        <div class="detail_pasien">
            <p class="label">Tanggal Periksa</p>
            <p class="value">${escapeHtml(data.tanggal_periksa)}</p>
        </div>
        <div class="detail_pasien">
            <p class="label">Poliklinik</p>
            <p class="value">${escapeHtml(data.poli)}</p>
        </div>
        <div class="detail_pasien">
            <p class="label">No Telepon</p>
            <p class="value">${escapeHtml(data.no_telepon || '-')}</p>
        </div>
    `;
    document.getElementById("detailModal").classList.add("show");
}
}

function escapeHtml(text) {
const div = document.createElement('div');
div.textContent = text;
return div.innerHTML;
}

function closeModal() {
document.getElementById("detailModal").classList.remove("show");
}

function confirmDelete(id) {
window.location.href = 'hapus.php?id=' + id;
}

function showPopup() {
document.getElementById('popup').style.display = 'block';
}

function hidePopup() {
document.getElementById('popup').style.display = 'none';
}

// Tutup modal jika klik di luar
window.onclick = function(event) {
const modal = document.getElementById("detailModal");
if (event.target === modal) {
    closeModal();
}
}

// Tutup modal dengan ESC key
document.addEventListener('keydown', function(event) {
if (event.key === 'Escape') {
    closeModal();
}
});