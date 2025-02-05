<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - To-Do List</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Dashboard - To-Do List</h1>

            <div class="d-flex align-items-center">
                <button class="btn btn-primary me-2" style="background-color: #A020F0; border: none;" data-bs-toggle="modal" data-bs-target="#taskModal">
                    <i class="bi bi-plus-circle"></i> Add Task
                </button>

                <!-- User Dropdown (Email & Logout) -->
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="userDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">
                        <i class="bi bi-person-circle"></i> <!-- User Icon -->
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                        <li><span class="dropdown-item">{{ auth()->user()->email }}</span></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>



    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered" style="width:90%;margin:0 auto;">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Task</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->name }}</td>
                    <td class="text-center">
                        <!-- Edit Button -->
                        <button class="btn btn-warning btn-sm me-2" data-bs-toggle="modal" style="background-color: #fff; border: none;"
                            data-bs-target="#editTaskModal"
                            onclick="loadTaskData({{ $task->id }}, '{{ $task->name }}')">
                            <i class="bi bi-pencil-square"></i>
                        </button>

                        <!-- Delete Button -->
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" style="background-color: #fff; border: none; color: black;"
                                onclick="return confirm('Are you sure you want to delete this task?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    <!-- Add Task Modal -->
    <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">Add New Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="text" name="task" class="form-control" placeholder="Enter task" required>
                    </div>
                    <div class="modal-footer">
                        <!-- Cancel Button -->
                        <button type="button" class="btn btn-secondary" style="background-color: #fff; border: 0.3px solid rgb(162, 23, 23); color: black; outline: rgb(162, 23, 23); transition: all 0.3s ease;" data-bs-dismiss="modal" onmouseover="this.style.backgroundColor='rgb(162, 23, 23)'; this.style.color='white';" onmouseout="this.style.backgroundColor='white'; this.style.color='black';">
                            Cancel
                        </button>
                        <!-- Save Task Button -->
                        <button type="submit" class="btn btn-primary" style="background-color: #A020F0; border: none;">Save Task</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Edit Task Modal -->
    <div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editTaskForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="text" id="editTaskInput" name="task" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #fff; border: 0.3px solid rgb(162, 23, 23); color: black; outline: rgb(162, 23, 23); transition: all 0.3s ease;" data-bs-dismiss="modal" onmouseover="this.style.backgroundColor='rgb(162, 23, 23)'; this.style.color='white';" onmouseout="this.style.backgroundColor='white'; this.style.color='black';">Cancel</button>
                        <button type="submit" class="btn btn-primary" style="background-color: #A020F0; border: none;">Update Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function loadTaskData(id, taskName) {
            document.getElementById('editTaskInput').value = taskName;
            document.getElementById('editTaskForm').action = `/tasks/${id}`;

            document.addEventListener('click', function (event) {
                const dropdownMenu = document.querySelector('.dropdown-menu');
                const dropdownToggle = document.querySelector('.dropdown-toggle');

                // Check if the clicked target is not the dropdown or button
                if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    // Hide the dropdown
                    const dropdown = new bootstrap.Dropdown(dropdownToggle);
                    dropdown.hide();
                }
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>
