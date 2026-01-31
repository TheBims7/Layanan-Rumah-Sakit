// DOM Elements
const sidebar = document.querySelector('.sidebar');
const content = document.querySelector('.content');
const sidebarToggle = document.getElementById('sidebarToggle');
const akunSearch = document.getElementById('akunSearch');
const akunTableBody = document.getElementById('akunTableBody');

// Initialize
renderakuns(akuns);

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
    const arrow = document.getElementById('akunArrow');
    const isOpen = subMenu.style.display === 'block';
    
    subMenu.style.display = isOpen ? 'none' : 'block';
    arrow.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
}

// akun search functionality
akunSearch.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const filtered = akuns.filter(akun => 
        akun.username.toLowerCase().includes(searchTerm) || 
        akun.email.toLowerCase().includes(searchTerm) ||
        akun.role.toLowerCase().includes(searchTerm)
    );
    renderakuns(filtered);
});

// Render akuns to table
function renderakuns(akuns) {
    akunTableBody.innerHTML = '';
    akuns.forEach((akun, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="px-4 py-4 whitespace-nowrap">${index + 1}</td>
            <td class="px-4 py-4 whitespace-nowrap font-medium">${akun.username}</td>
            <td class="px-4 py-4 whitespace-nowrap">${akun.email}</td>
            <td class="px-4 py-4 whitespace-nowrap">${akun.role}</td>
            <td class="px-4 py-4 whitespace-nowrap">
                <button class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded" onclick=\"if(confirm('Yakin ingin menghapus?')) { window.location.href='hapus_akun.php?id=${akun.id}'; }\">
                    <i class="fas fa-trash"></i><span class="hidden sm:inline"> Hapus</span>
                </button>
            </td>
        `;
        akunTableBody.appendChild(row);
    });
    
    // Update counts
    document.getElementById('showingFrom').textContent = 1;
    document.getElementById('showingTo').textContent = akuns.length;
    document.getElementById('totalakuns').textContent = akuns.length;
}