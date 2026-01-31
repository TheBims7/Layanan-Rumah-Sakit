// DOM Elements
const sidebar = document.querySelector('.sidebar');
const content = document.querySelector('.content');
const sidebarToggle = document.getElementById('sidebarToggle');
const loginSearch = document.getElementById('loginSearch');
const loginTableBody = document.getElementById('loginTableBody');

// Initialize
renderlogins(logins);

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
    const arrow = document.getElementById('loginArrow');
    const isOpen = subMenu.style.display === 'block';
    
    subMenu.style.display = isOpen ? 'none' : 'block';
    arrow.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
}

// login search functionality
loginSearch.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const filtered = logins.filter(login => 
        login.username.toLowerCase().includes(searchTerm) || 
        login.email.toLowerCase().includes(searchTerm) ||
        login.role.toLowerCase().includes(searchTerm)
    );
    renderlogins(filtered);
});

// Render logins to table
function renderlogins(logins) {
    loginTableBody.innerHTML = '';
    logins.forEach((login, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="px-4 py-4 whitespace-nowrap">${index + 1}</td>
            <td class="px-4 py-4 whitespace-nowrap font-medium">${login.username}</td>
            <td class="px-4 py-4 whitespace-nowrap">${login.email}</td>
            <td class="px-4 py-4 whitespace-nowrap">${login.role}</td>
            <td class="px-4 py-4 whitespace-nowrap">${login.login_time}</td>
            <td class="px-4 py-4 whitespace-nowrap">
                <button class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded" onclick=\"if(confirm('Yakin ingin menghapus?')) { window.location.href='hapus_login.php?id=${login.id}'; }\">
                    <i class="fas fa-trash"></i><span class="hidden sm:inline"> Hapus</span>
                </button>
            </td>
        `;
        loginTableBody.appendChild(row);
    });
    
    // Update counts
    document.getElementById('showingFrom').textContent = 1;
    document.getElementById('showingTo').textContent = logins.length;
    document.getElementById('totallogins').textContent = logins.length;
}