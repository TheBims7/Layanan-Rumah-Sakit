// DOM Elements
const sidebar = document.querySelector('.sidebar');
const content = document.querySelector('.content');
const sidebarToggle = document.getElementById('sidebarToggle');
const doctorSearch = document.getElementById('doctorSearch');
const doctorTableBody = document.getElementById('doctorTableBody');

// Initialize
renderdoctors(doctors);

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
    const arrow = document.getElementById('doctorArrow');
    const isOpen = subMenu.style.display === 'block';
    
    subMenu.style.display = isOpen ? 'none' : 'block';
    arrow.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
}

// doctor search functionality
doctorSearch.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const filtered = doctors.filter(doctor => 
        doctor.nama_dokter.toLowerCase().includes(searchTerm) || 
        doctor.NIP.toLowerCase().includes(searchTerm) ||
        doctor.status_dokter.toLowerCase().includes(searchTerm)
    );
    renderdoctors(filtered);
});

// Render doctors to table
function renderdoctors(doctors) {
    doctorTableBody.innerHTML = '';
    doctors.forEach((doctor, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="px-4 py-4 whitespace-nowrap">${index + 1}</td>
            <td class="px-4 py-4 whitespace-nowrap font-medium">${doctor.nama_dokter}</td>
            <td class="px-4 py-4 whitespace-nowrap">${doctor.NIP}</td>
            <td class="px-4 py-4 whitespace-nowrap">${doctor.status_dokter}</td>
        `;
        doctorTableBody.appendChild(row);
    });
    
    // Update counts
    document.getElementById('showingFrom').textContent = 1;
    document.getElementById('showingTo').textContent = doctors.length;
    document.getElementById('totaldoctors').textContent = doctors.length;
}