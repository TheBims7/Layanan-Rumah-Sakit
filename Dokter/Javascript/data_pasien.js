// DOM Elements
const sidebar = document.querySelector('.sidebar');
const content = document.querySelector('.content');
const sidebarToggle = document.getElementById('sidebarToggle');
const patientSearch = document.getElementById('patientSearch');
const patientTableBody = document.getElementById('patientTableBody');
const filterSelect = document.getElementById('filterDokter');

// Initialize
renderPatients(patients);

// Toggle sidebar
sidebarToggle.addEventListener('click', function() {
    this.classList.toggle('active');
    sidebar.classList.toggle('active');
    content.classList.toggle('active');
    this.classList.toggle('non-active');
    sidebar.classList.toggle('non-active');
    content.classList.toggle('non-active');
});

// Toggle submenu
function toggleSubMenu(menuId) {
    const subMenu = document.getElementById(menuId);
    const arrow = document.getElementById('patientArrow');
    const isOpen = subMenu.style.display === 'block';
    
    subMenu.style.display = isOpen ? 'none' : 'block';
    arrow.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
}

// Patient search functionality
patientSearch.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const filtered = patients.filter(patient => 
        patient.nama.toLowerCase().includes(searchTerm) || 
        patient.no_rm.toLowerCase().includes(searchTerm) ||
        patient.nama_dokter.toLowerCase().includes(searchTerm)
    );
    renderPatients(filtered);
});

filterSelect.addEventListener('change', function () {
    const selectedDoctor = this.value;
    const filtered = selectedDoctor === 'all'
        ? patients
        : patients.filter(p => p.nama_dokter === selectedDoctor);

    renderPatients(filtered);
});

// Render patients to table
function renderPatients(patients) {
    patientTableBody.innerHTML = '';
    patients.forEach((patient, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="px-4 py-4 whitespace-nowrap">${index + 1}</td>
            <td class="px-4 py-4 whitespace-nowrap font-medium">${patient.antrian}</td>
            <td class="px-4 py-4 whitespace-nowrap">${patient.no_rm}</td>
            <td class="px-4 py-4 whitespace-nowrap">${patient.nama}</td>
            <td class="px-4 py-4 whitespace-nowrap">${patient.nama_dokter}</td>
            <td class="px-4 py-4 whitespace-nowrap">${patient.tanggal_periksa}</td>
            <td class="px-4 py-4 whitespace-nowrap">
                <button class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded mr-1" onclick="window.location.href='info_pasien.php?id=${patient.id}'">
                    <i class="fas fa-eye"></i><span class="hidden sm:inline"> Detail</span>
                </button>
                <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded mr-1" onclick="window.location.href='edit_pasien.php?id=${patient.id}'">
                    <i class="fas fa-edit"></i><span class="hidden sm:inline"> Edit</span>
                </button>
                <button class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded" onclick="openHapusModal(${patient.id})">
                    <i class="fas fa-trash"></i><span class="hidden sm:inline"> Hapus</span>
                </button>
            </td>
        `;
        patientTableBody.appendChild(row);
    });
    
    // Update counts
    document.getElementById('showingFrom').textContent = 1;
    document.getElementById('showingTo').textContent = patients.length;
    document.getElementById('totalPatients').textContent = patients.length;
}

function openHapusModal(id) {
    const btn = document.getElementById("btnHapusConfirm");
    btn.href = `hapus_pasien.php?id=${id}`;

    const modal = new bootstrap.Modal(
        document.getElementById('hapusModal')
    );
    modal.show();
}
