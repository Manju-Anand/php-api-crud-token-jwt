<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Employee Management</title>
    <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      padding: 20px;
    }
    h2 {
      color: #333;
    }
    form, table {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-top: 10px;
    }
    input[type="text"],
    input[type="email"],
    input[type="date"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    button {
      margin-top: 15px;
      padding: 10px 15px;
      background-color: #007BFF;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    button:hover {
      background-color: #0056b3;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      padding: 10px;
      border: 1px solid #ddd;
    }
    th {
      background-color: #f4f4f4;
    }
    .actions button {
      margin-right: 5px;
      background-color: #28a745;
    }
    .actions button.delete {
      background-color: #dc3545;
    }
  </style>
</head>
<body>
  <h2>JWT Auth Employee Management</h2>

  <div class="section" id="login-section">
    <h3>Login</h3>
    <input type="text" id="username" placeholder="Username" />
    <input type="password" id="password" placeholder="Password" />
    <button onclick="login()">Login</button>
    <p id="login-status"></p>
  </div>

  <div class="section" id="crud-section" style="display:none">
    <h3>Add / Edit Employee</h3>
    <input type="hidden" id="emp_id">
    <input type="text" id="emp_name" placeholder="Name">
    <input type="text" id="emp_code" placeholder="Code">
    <input type="email" id="emp_email" placeholder="Email">
    <input type="text" id="emp_phone" placeholder="Phone">
    <input type="text" id="emp_address" placeholder="Address">
    <input type="text" id="emp_designation" placeholder="Designation">
    <input type="date" id="emp_joining_date">
    <button onclick="saveEmployee()">Save Employee</button>
  </div>

  <div class="section" id="list-section" style="display:none">
    <h3>Employee List</h3>
    <table>
      <thead>
        <tr>
          <th>Name</th><th>Code</th><th>Email</th><th>Phone</th><th>Address</th><th>Designation</th><th>Joining Date</th><th>Actions</th>
        </tr>
      </thead>
      <tbody id="employee-table"></tbody>
    </table>
  </div>

<script>
let token = '';
const API_BASE = 'http://localhost/php/REST-API-JWT'; // Change if needed

function login() {
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;

  fetch(`${API_BASE}/auth.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ username, password })
  })
  .then(res => res.json())
  .then(data => {
    if (data.token) {
      token = data.token;
      document.getElementById('login-section').style.display = 'none';
      document.getElementById('crud-section').style.display = 'block';
      document.getElementById('list-section').style.display = 'block';
      loadEmployees();
    } else {
      document.getElementById('login-status').textContent = 'Invalid login';
    }
  });
}

function loadEmployees() {
  fetch(`${API_BASE}/api.php/employees`, {
    headers: { 'Authorization': 'Bearer ' + token }
  })
  .then(res => res.json())
  .then(data => {
    const table = document.getElementById('employee-table');
    table.innerHTML = '';
    data.forEach(emp => {
      table.innerHTML += `
        <tr>
          <td>${emp.emp_name}</td>
          <td>${emp.emp_code}</td>
          <td>${emp.emp_email}</td>
          <td>${emp.emp_phone}</td>
          <td>${emp.emp_address}</td>
          <td>${emp.emp_designation}</td>
          <td>${emp.emp_joiningdate}</td>
          <td>
            <button onclick='editEmployee(${JSON.stringify(emp)})'>Edit</button>
            <button onclick='deleteEmployee(${emp.id})'>Delete</button>
          </td>
        </tr>`;
    });
  });
}

function saveEmployee() {
  const id = document.getElementById('emp_id').value;
  const data = {
    emp_name: document.getElementById('emp_name').value,
    emp_code: document.getElementById('emp_code').value,
    emp_email: document.getElementById('emp_email').value,
    emp_phone: document.getElementById('emp_phone').value,
    emp_address: document.getElementById('emp_address').value,
    emp_designation: document.getElementById('emp_designation').value,
    emp_joining_date: document.getElementById('emp_joining_date').value
  };

  const method = id ? 'PUT' : 'POST';
  const url = id ? `${API_BASE}/api.php/employees/${id}` : `${API_BASE}/api.php/employees`;

  fetch(url, {
    method: method,
    headers: {
      'Authorization': 'Bearer ' + token,
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
  })
  .then(res => res.json())
  .then(() => {
    clearForm();
    loadEmployees();
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
  if (confirm('Delete this employee?')) {
    fetch(`${API_BASE}/api.php/employees/${id}`, {
      method: 'DELETE',
      headers: { 'Authorization': 'Bearer ' + token }
    })
    .then(res => res.json())
    .then(() => loadEmployees());
  }
}

function clearForm() {
  document.getElementById('emp_id').value = '';
  document.getElementById('emp_name').value = '';
  document.getElementById('emp_code').value = '';
  document.getElementById('emp_email').value = '';
  document.getElementById('emp_phone').value = '';
  document.getElementById('emp_address').value = '';
  document.getElementById('emp_designation').value = '';
  document.getElementById('emp_joining_date').value = '';
}
</script>
</body>
</html>
