<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Manager</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    form, table { margin-top: 20px; width: 100%; max-width: 600px; }
    table { border-collapse: collapse; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    th { background-color: #f4f4f4; }
    .form-row { margin-bottom: 10px; }
    label { display: inline-block; width: 140px; }
    input[type="text"], input[type="email"], input[type="date"] { width: 60%; }
    button { margin-right: 5px; }
  </style>
</head>
<body>

<h2>Employee Manager</h2>

<form id="employeeForm">
  <input type="hidden" id="emp_id">
  <div class="form-row">
    <label for="emp_name">Name:</label>
    <input type="text" id="emp_name" required>
  </div>
  <div class="form-row">
    <label for="emp_code">Code:</label>
    <input type="text" id="emp_code" required>
  </div>
  <div class="form-row">
    <label for="emp_email">Email:</label>
    <input type="email" id="emp_email" required>
  </div>
  <div class="form-row">
    <label for="emp_phone">Phone:</label>
    <input type="text" id="emp_phone" required>
  </div>
  <div class="form-row">
    <label for="emp_address">Address:</label>
    <input type="text" id="emp_address" required>
  </div>
  <div class="form-row">
    <label for="emp_designation">Designation:</label>
    <input type="text" id="emp_designation" required>
  </div>
  <div class="form-row">
    <label for="emp_joining_date">Joining Date:</label>
    <input type="date" id="emp_joining_date" required>
  </div>
  <button type="submit">Save</button>
  <button type="reset" onclick="resetForm()">Clear</button>
</form>

<h3>Employee List</h3>
<table id="employeeTable">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Code</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody></tbody>
</table>

<script>
const apiBase = 'http://localhost/php/REST-API/oldfiles-withouttoken/api.php/employees';

function loadEmployees() {
  fetch(apiBase)
    .then(res => res.json())
    .then(data => {
      const tbody = document.querySelector('#employeeTable tbody');
      tbody.innerHTML = '';
      data.forEach(emp => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${emp.id}</td>
          <td>${emp.emp_name}</td>
          <td>${emp.emp_code}</td>
          <td>${emp.emp_email}</td>
          <td>${emp.emp_phone}</td>
          <td>
            <button onclick="editEmployee(${emp.id})">Edit</button>
            <button onclick="deleteEmployee(${emp.id})">Delete</button>
          </td>
        `;
        tbody.appendChild(row);
      });
    });
}

function editEmployee(id) {
  fetch(`${apiBase}/${id}`)
    .then(res => res.json())
    .then(emp => {
      document.getElementById('emp_id').value = emp.id;
      document.getElementById('emp_name').value = emp.emp_name;
      document.getElementById('emp_code').value = emp.emp_code;
      document.getElementById('emp_email').value = emp.emp_email;
      document.getElementById('emp_phone').value = emp.emp_phone;
      document.getElementById('emp_address').value = emp.emp_address;
      document.getElementById('emp_designation').value = emp.emp_designation;
      document.getElementById('emp_joining_date').value = emp.emp_joining_date;
    });
}

function deleteEmployee(id) {
  if (confirm('Are you sure to delete this employee?')) {
    fetch(`${apiBase}/${id}`, { method: 'DELETE' })
      .then(res => res.json())
      .then(() => loadEmployees());
  }
}

function resetForm() {
  document.getElementById('emp_id').value = '';
}

// Handle form submit
const form = document.getElementById('employeeForm');
form.addEventListener('submit', function (e) {
  e.preventDefault();
  const empId = document.getElementById('emp_id').value;
  const method = empId ? 'PUT' : 'POST';
  const url = empId ? `${apiBase}/${empId}` : apiBase;

  const data = {
    emp_name: document.getElementById('emp_name').value,
    emp_code: document.getElementById('emp_code').value,
    emp_email: document.getElementById('emp_email').value,
    emp_phone: document.getElementById('emp_phone').value,
    emp_address: document.getElementById('emp_address').value,
    emp_designation: document.getElementById('emp_designation').value,
    emp_joining_date: document.getElementById('emp_joining_date').value,
  };

  fetch(url, {
    method,
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  })
    .then(res => res.json())
    .then(() => {
      form.reset();
      resetForm();
      loadEmployees();
    });
});

loadEmployees();
</script>
</body>
</html>
