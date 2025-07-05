<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Employee Management UI</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    form input, form button { margin: 5px; padding: 8px; }
    table { border-collapse: collapse; margin-top: 20px; width: 100%; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    th { background-color: #f4f4f4; }
    .edit-btn, .delete-btn { cursor: pointer; color: blue; text-decoration: underline; }
  </style>
</head>
<body>

<h2>Employee Management</h2>

<form id="employeeForm">
  <input type="hidden" id="emp_id">
  <input type="text" id="emp_name" placeholder="Name" required>
  <input type="text" id="emp_code" placeholder="Code" required>
  <input type="email" id="emp_email" placeholder="Email" required>
  <input type="text" id="emp_phone" placeholder="Phone" required>
  <input type="text" id="emp_address" placeholder="Address" required>
  <input type="text" id="emp_designation" placeholder="Designation" required>
  <input type="date" id="emp_joining_date" required>
  <button type="submit">Save</button>
</form>

<table>
  <thead>
    <tr>
      <th>Name</th><th>Code</th><th>Email</th><th>Phone</th><th>Address</th>
      <th>Designation</th><th>Joining Date</th><th>Actions</th>
    </tr>
  </thead>
  <tbody id="employeeTable"></tbody>
</table>

<script>
const API_URL = 'http://localhost/php/REST-API/api.php/employees';
const TOKEN = 'b93F8dj28DhxX7dfds35235gfj80dsdsfAz09NgG3Lp92slQoK4';

document.addEventListener('DOMContentLoaded', fetchEmployees);
document.getElementById('employeeForm').addEventListener('submit', handleSubmit);

function fetchEmployees() {
  fetch(API_URL, {
    headers: { 'Authorization': `Bearer ${TOKEN}` }
  })
  .then(res => res.json())
  .then(data => {
    const table = document.getElementById('employeeTable');
    table.innerHTML = '';
    data.forEach(emp => {
      const row = `<tr>
        <td>${emp.emp_name}</td>
        <td>${emp.emp_code}</td>
        <td>${emp.emp_email}</td>
        <td>${emp.emp_phone}</td>
        <td>${emp.emp_address}</td>
        <td>${emp.emp_designation}</td>
        <td>${emp.emp_joiningdate}</td>
        <td>
          <span class="edit-btn" onclick='editEmployee(${JSON.stringify(emp)})'>Edit</span> |
          <span class="delete-btn" onclick="deleteEmployee(${emp.id})">Delete</span>
        </td>
      </tr>`;
      table.innerHTML += row;
    });
  });
}

function handleSubmit(e) {
  e.preventDefault();
  const id = document.getElementById('emp_id').value;
  const employee = {
    emp_name: document.getElementById('emp_name').value,
    emp_code: document.getElementById('emp_code').value,
    emp_email: document.getElementById('emp_email').value,
    emp_phone: document.getElementById('emp_phone').value,
    emp_address: document.getElementById('emp_address').value,
    emp_designation: document.getElementById('emp_designation').value,
    emp_joining_date: document.getElementById('emp_joining_date').value,
  };

  const method = id ? 'PUT' : 'POST';
  const url = id ? `${API_URL}/${id}` : API_URL;

  fetch(url, {
    method: method,
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${TOKEN}`
    },
    body: JSON.stringify(employee)
  })
  .then(res => res.json())
  .then(() => {
    document.getElementById('employeeForm').reset();
    document.getElementById('emp_id').value = '';
    fetchEmployees();
  });
}

function editEmployee(emp) {
  document.getElementById('emp_id').value = emp.id;
  document.getElementById('emp_name').value = emp.emp_name;
  document.getElementById('emp_code').value = emp.emp_code;
  document.getElementById('emp_email').value = emp.emp_email;
  document.getElementById('emp_phone').value = emp.emp_phone;
  document.getElementById('emp_address').value = emp.emp_address;
  document.getElementById('emp_designation').value = emp.emp_designation;
  document.getElementById('emp_joining_date').value = emp.emp_joiningdate;
}

function deleteEmployee(id) {
  if (!confirm('Are you sure you want to delete this employee?')) return;

  fetch(`${API_URL}/${id}`, {
    method: 'DELETE',
    headers: { 'Authorization': `Bearer ${TOKEN}` }
  })
  .then(res => res.json())
  .then(() => fetchEmployees());
}
</script>

</body>
</html>
