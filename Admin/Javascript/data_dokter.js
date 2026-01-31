// DOM Elements
const sidebar = document.querySelector('.sidebar');
const content = document.querySelector('.content');
const sidebarToggle = document.getElementById('sidebarToggle');
const doctorSearch = document.getElementById('doctorSearch');
const doctorTableBody = document.getElementById('doctorTableBody');
const entriesPerPageSelect = document.getElementById('entriesPerPage');
const prevPageBtn = document.getElementById('prevPage');
const nextPageBtn = document.getElementById('nextPage');
const paginationNumbers = document.getElementById('paginationNumbers');

const copyBtn = document.getElementById('copyButton');
const csvBtn = document.getElementById('csvButton');
const printBtn = document.getElementById('printButton');
const excelBtn = document.getElementById('excelButton');

let currentPage = 1;
let entriesPerPage = parseInt(entriesPerPageSelect.value);

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
function renderdoctors(data) {
    doctorTableBody.innerHTML = '';

    const start = (currentPage - 1) * entriesPerPage;
    const end = start + entriesPerPage;
    const pageData = data.slice(start, end);

    pageData.forEach((doctor, index) => {
        const row = document.createElement('tr');
        row.className = index % 2 === 0 ? 'bg-gray-50' : 'bg-gray-100';
        row.innerHTML = `
            <td class="px-4 py-4 whitespace-nowrap">${start + index + 1}</td>
            <td class="px-4 py-4 whitespace-nowrap font-medium">${doctor.nama_dokter}</td>
            <td class="px-4 py-4 whitespace-nowrap">${doctor.NIP}</td>
            <td class="px-4 py-4 whitespace-nowrap">${doctor.status_dokter}</td>
            <td class="px-4 py-4 whitespace-nowrap text-center">
                <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded mr-1" onclick="window.location.href='edit_dokter.php?id=${doctor.id}'">
                    <i class="fas fa-edit"></i><span class="hidden sm:inline"> Edit</span>
                </button>
                <button class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded" onclick=\"if(confirm('Yakin ingin menghapus?')) { window.location.href='hapus_dokter.php?id=${doctor.id}'; }\">
                    <i class="fas fa-trash"></i><span class="hidden sm:inline"> Hapus</span>
                </button>
            </td>
        `;
        doctorTableBody.appendChild(row);
    });
    
    // Update counts
    updatePagination(data.length);
    document.getElementById('showingFrom').textContent = start + 1;
    document.getElementById('showingTo').textContent = Math.min(end, data.length);
    document.getElementById('totaldoctors').textContent = doctors.length;
}

// Update pagination buttons and numbers
function updatePagination(totalData) {
    const totalPages = Math.ceil(totalData / entriesPerPage);

    // Disable previous/next accordingly
    prevPageBtn.disabled = currentPage === 1;
    nextPageBtn.disabled = currentPage === totalPages || totalPages === 0;

    // Clear page numbers
    paginationNumbers.innerHTML = '';

    // Generate page numbers, max 5 pages shown centered on currentPage
    let startPage = Math.max(1, currentPage - 2);
    let endPage = Math.min(totalPages, currentPage + 2);
    if (currentPage <= 2) {
        endPage = Math.min(5, totalPages);
    } else if (currentPage >= totalPages - 1) {
        startPage = Math.max(1, totalPages - 4);
    }

    for (let i = startPage; i <= endPage; i++) {
        const btn = document.createElement('button');
        btn.textContent = i;
        btn.className = `px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100 hover:text-gray-700 ${currentPage === i ? 'bg-blue-600 text-white border-blue-600' : ''}`;
        btn.setAttribute('aria-current', currentPage === i ? 'page' : 'false');
        btn.addEventListener('click', () => {
        currentPage = i;
        renderdoctors(doctors);
        });
        paginationNumbers.appendChild(btn);
    }
}

entriesPerPageSelect.addEventListener('change', () => {
    entriesPerPage = parseInt(entriesPerPageSelect.value);
    currentPage = 1;
    renderdoctors(doctors);
});

prevPageBtn.addEventListener('click', () => {
    if (currentPage > 1) {
        currentPage--;
        renderdoctors(doctors);
    }
});

nextPageBtn.addEventListener('click', () => {
    if (currentPage < Math.ceil(doctors.length / entriesPerPage)) {
        currentPage++;
        renderdoctors(doctors);
    }
});

// Export functions
function copyTable() {
    let text = "No\tNama Dokter\tNIP\tStatus Dokter\n";
    doctors.forEach((doctor, index) => {
        text += `${index + 1}\t${doctor.nama_dokter}\t${doctor.NIP}\t${doctor.status_dokter}\n`;
    });
    navigator.clipboard.writeText(text).then(() => {
        alert('Table data copied to clipboard');
    });
}

function exportCSV() {
    const rows = [
        ['No', 'Nama Dokter', 'NIP', 'Status Dokter'],
        ...doctors.map((doctor, index) => [index + 1, doctor.nama_dokter, doctor.NIP, doctor.status_dokter])
    ];

    let csvContent = "data:text/csv;charset=utf-8,";
    rows.forEach(rowArray => {
        let row = rowArray.map(e => `"${e}"`).join(",");
        csvContent += row + "\r\n";
    });

    const encodedUri = encodeURI(csvContent);
    const link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "data_dokter.csv");
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function exportExcel() {
    // Using simple XLSX export via data URI
    const rows = [
        ['No', 'Nama Dokter', 'NIP', 'Status Dokter'],
        ...doctors.map((doctor, index) => [index + 1, doctor.nama_dokter, doctor.NIP, doctor.status_dokter])
    ];

    let html = `<table><tbody>`;
    rows.forEach(row => {
        html += "<tr>";
        row.forEach(cell => {
        html += `<td>${cell}</td>`;
        });
        html += "</tr>";
    });
    html += `</tbody></table>`;

    let uri = 'data:application/vnd.ms-excel;base64,';
    let template = `<html xmlns:o="urn:schemas-microsoft-com:office:office" 
            xmlns:x="urn:schemas-microsoft-com:office:excel" 
            xmlns="http://www.w3.org/TR/REC-html40">
            <head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>Sheet1</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]-->
            </head><body>${html}</body></html>`;
    function base64(s) { return window.btoa(unescape(encodeURIComponent(s))); }
    const link = document.createElement("a");
    link.href = uri + base64(template);
    link.download = "data_dokter.xls";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function printTable() {
    const printContent = document.createElement('div');
    printContent.style.fontFamily = 'Arial, sans-serif';
    printContent.style.fontSize = '12pt';
    printContent.style.padding = '20px';

    let html = '<h2 style="text-align:center;">Data Dokter</h2><table border="1" cellspacing="0" cellpadding="4" style="border-collapse:collapse; width:100%;">';
    html += '<thead><tr><th>No</th><th>Nama Dokter</th><th>NIP</th><th>Status Dokter</th></tr></thead><tbody>';
    doctors.forEach((doctor, index) => {
        html += `<tr><td style="text-align: center;">${index + 1}</td><td>${doctor.nama_dokter}</td><td>${doctor.NIP}</td><td>${doctor.status_dokter}</td></tr>`;
    });
    html += '</tbody></table>';

    printContent.innerHTML = html;

    const printWindow = window.open('', '', 'width=900,height=700');
    printWindow.document.write('<html><head><title>Data Dokter</title></head><body>');
    printWindow.document.write(printContent.innerHTML);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    printWindow.close();
}

copyBtn.addEventListener('click', copyTable);
csvBtn.addEventListener('click', exportCSV);
excelBtn.addEventListener('click', exportExcel);
printBtn.addEventListener('click', printTable);

renderdoctors(doctors);