// DOM Elements
const sidebar = document.querySelector('.sidebar');
const content = document.querySelector('.content');
const sidebarToggle = document.getElementById('sidebarToggle');
const adminSearch = document.getElementById('adminSearch');
const adminTableBody = document.getElementById('adminTableBody');

// Initialize
renderadmins(admins);

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
    const arrow = document.getElementById('adminArrow');
    const isOpen = subMenu.style.display === 'block';
    
    subMenu.style.display = isOpen ? 'none' : 'block';
    arrow.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
}

// admin search functionality
adminSearch.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const filtered = admins.filter(admin => 
        admin.nama_dokter.toLowerCase().includes(searchTerm) || 
        admin.tanggal_periksa.toLowerCase().includes(searchTerm) ||
        admin.poli.toLowerCase().includes(searchTerm)
    );
    renderadmins(filtered);
});

// Render admins to table
function renderadmins(admins) {
    adminTableBody.innerHTML = '';
    admins.forEach((admin, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="px-4 py-4 whitespace-nowrap">${index + 1}</td>
            <td class="px-4 py-4 whitespace-nowrap font-medium">${admin.no_rm}</td>
            <td class="px-4 py-4 whitespace-nowrap">${admin.nama}</td>
            <td class="px-4 py-4 whitespace-nowrap">${admin.nama_dokter}</td>
            <td class="px-4 py-4 whitespace-nowrap">${admin.tanggal_periksa}</td>
            <td class="px-4 py-4 whitespace-nowrap">${admin.poli}</td>
        `;
        adminTableBody.appendChild(row);
    });
    
    // Update counts
    document.getElementById('showingFrom').textContent = 1;
    document.getElementById('showingTo').textContent = admins.length;
    document.getElementById('totaladmins').textContent = admins.length;
}