let menuicn = document.querySelector(".menuicn");
let nav = document.querySelector(".navcontainer");

menuicn.addEventListener("click", () => {
    nav.classList.toggle("navclose");
});

// Search functionality
document.getElementById('searchInput').addEventListener('keyup', function () {
  const filter = this.value.toLowerCase();
  const rows = document.querySelectorAll('#myTable tbody tr');

  rows.forEach(row => {
    const text = row.textContent.toLowerCase();
    row.style.display = text.includes(filter) ? '' : 'none';
  });
});

// Sort functionality
function sortTable(colIndex) {
  const table = document.getElementById("myTable");
  const rows = Array.from(table.rows).slice(1); // exclude header
  const isNumeric = !isNaN(rows[0].cells[colIndex].textContent.trim());

  let sortedRows = rows.sort((a, b) => {
    let aVal = a.cells[colIndex].textContent.trim();
    let bVal = b.cells[colIndex].textContent.trim();

    return isNumeric
      ? Number(aVal) - Number(bVal)
      : aVal.localeCompare(bVal);
  });

  // Toggle sort direction
  if (table.dataset.sortedCol == colIndex && table.dataset.sortDir === "asc") {
    sortedRows.reverse();
    table.dataset.sortDir = "desc";
  } else {
    table.dataset.sortDir = "asc";
  }
  table.dataset.sortedCol = colIndex;

  const tbody = table.querySelector("tbody");
  tbody.innerHTML = '';
  sortedRows.forEach(row => tbody.appendChild(row));
}

function toggleDropdown(button) {
  const dropdown = button.parentElement.querySelector(".dropdown-menu");
  dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";

  // Close dropdown when clicking outside
  document.addEventListener("click", function handler(e) {
    if (!button.parentElement.contains(e.target)) {
      dropdown.style.display = "none";
      document.removeEventListener("click", handler);
    }
  });
}

function slugify(text) {
    return text
    .toString()                     // Cast to string
    .toLowerCase()                  // Convert the string to lowercase letters
    .normalize('NFD')       // The normalize() method returns the Unicode Normalization Form of a given string.
    .replace(/\s+/g, '-')           // Replace spaces with -
    .replace(/[^\w\-]+/g, '-')       // Remove all non-word chars
    .replace(/\-\-+/g, '-')        // Replace multiple - with single -
    .replace(/\&\&+/g, '-')        // Replace multiple & with single -
    .replace(/\_\_+/g, '-')        // Replace multiple & with single -
    
    .trim();                         // Remove whitespace from both sides of a string
}

function listingslug(text) {
  document.getElementById("slug").value = slugify(text); 
}

