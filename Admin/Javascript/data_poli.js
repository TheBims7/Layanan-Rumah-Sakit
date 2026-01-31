// DOM Elements
const sidebar = document.querySelector('.sidebar');
const content = document.querySelector('.content');
const sidebarToggle = document.getElementById('sidebarToggle');
const poliSearch = document.getElementById('poliSearch');
const poliTableBody = document.getElementById('poliTableBody');
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
renderpoli(poli);

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
    const arrow = document.getElementById('poliArrow');
    const isOpen = subMenu.style.display === 'block';
    
    subMenu.style.display = isOpen ? 'none' : 'block';
    arrow.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
}

// poli search functionality
poliSearch.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const filtered = poli.filter(poli => 
        poli.poli.toLowerCase().includes(searchTerm) || 
        poli.gedung.toLowerCase().includes(searchTerm)
    );
    renderpoli(filtered);
});

// Render poli to table
function renderpoli(data) {
    poliTableBody.innerHTML = '';

    const start = (currentPage - 1) * entriesPerPage;
    const end = start + entriesPerPage;
    const pageData = data.slice(start, end);

    pageData.forEach((poli, index) => {
        const row = document.createElement('tr');
        row.className = index % 2 === 0 ? 'bg-gray-50' : 'bg-gray-100';
        row.innerHTML = `
            <td class="px-4 py-4 whitespace-nowrap">${start + index + 1}</td>
            <td class="px-4 py-4 whitespace-nowrap font-medium">${poli.poli}</td>
            <td class="px-4 py-4 whitespace-nowrap">${poli.gedung}</td>
            <td class="px-4 py-4 whitespace-nowrap text-center">
                <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded mr-1" onclick="window.location.href='edit_poli.php?id=${poli.id}'">
                    <i class="fas fa-edit"></i><span class="hidden sm:inline"> Edit</span>
                </button>
                <button class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded" onclick=\"if(confirm('Yakin ingin menghapus?')) { window.location.href='hapus_poli.php?id=${poli.id}'; }\">
                    <i class="fas fa-trash"></i><span class="hidden sm:inline"> Hapus</span>
                </button>
            </td>
        `;
        poliTableBody.appendChild(row);
    });
    
    // Update counts
    updatePagination(data.length);
    document.getElementById('showingFrom').textContent = start + 1;
    document.getElementById('showingTo').textContent = Math.min(end, data.length);
    document.getElementById('totalpoli').textContent = poli.length;
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
        btn.className = `px-3 py-1 rounded border border-gray-300 hover:bg-gray-100 hover:text-black ${currentPage === i ? 'bg-blue-600 text-white border-blue-600' : ''}`;
        btn.setAttribute('aria-current', currentPage === i ? 'page' : 'false');
        btn.addEventListener('click', () => {
        currentPage = i;
        renderpoli(poli);
        });
        paginationNumbers.appendChild(btn);
    }
}

entriesPerPageSelect.addEventListener('change', () => {
    entriesPerPage = parseInt(entriesPerPageSelect.value);
    currentPage = 1;
    renderpoli(poli);
});

prevPageBtn.addEventListener('click', () => {
    if (currentPage > 1) {
        currentPage--;
        renderpoli(poli);
    }
});

nextPageBtn.addEventListener('click', () => {
    if (currentPage < Math.ceil(poli.length / entriesPerPage)) {
        currentPage++;
        renderpoli(poli);
    }
});

// Export functions
function copyTable() {
    let text = "No\tNama Poliklinik\tGedung\n";
    poli.forEach((poli, index) => {
        text += `${index + 1}\t${poli.poli}\t${poli.gedung}\n`;
    });
    navigator.clipboard.writeText(text).then(() => {
        alert('Table data copied to clipboard');
    });
}

function exportCSV() {
    const rows = [
        ['No', 'Nama Poliklinik', 'Gedung'],
        ...poli.map((poli, index) => [index + 1, poli.poli, poli.gedung])
    ];

    let csvContent = "data:text/csv;charset=utf-8,";
    rows.forEach(rowArray => {
        let row = rowArray.map(e => `"${e}"`).join(",");
        csvContent += row + "\r\n";
    });

    const encodedUri = encodeURI(csvContent);
    const link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "data_poliklinik.csv");
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function exportExcel() {
    // Using simple XLSX export via data URI
    const rows = [
        ['No', 'Nama Poliklinik', 'Gedung'],
        ...poli.map((poli, index) => [index + 1, poli.poli, poli.gedung])
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
    link.download = "data_poliklinik.xls";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function printTable() {
    const printContent = document.createElement('div');
    printContent.style.fontFamily = 'Arial, sans-serif';
    printContent.style.fontSize = '12pt';
    printContent.style.padding = '20px';

    let html = '<h2 style="text-align:center;">Data Poliklinik</h2><table border="1" cellspacing="0" cellpadding="4" style="border-collapse:collapse; width:100%;">';
    html += '<thead><tr><th>No</th><th>Nama Poliklinik</th><th>Gedung</th></tr></thead><tbody>';
    poli.forEach((poli, index) => {
        html += `<tr><td style="text-align: center;">${index + 1}</td><td>${poli.poli}</td><td>${poli.gedung}</td></tr>`;
    });
    html += '</tbody></table>';

    printContent.innerHTML = html;

    const printWindow = window.open('', '', 'width=900,height=700');
    printWindow.document.write('<html><head><title>Data Poliklinik</title></head><body>');
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

renderpoli(poli);