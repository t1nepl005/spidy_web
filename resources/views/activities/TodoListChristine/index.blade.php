<x-layout>
<style>
    .alert-success {
      background-color: rgba(255, 240, 245, 0.6);
      border: 1px solid #ffb6c1;
      color: #d63384;
      border-radius: 8px;
    }

    input[type="text"] {
      border: 1px solid #ffb6c1;
      color: #333;
      border-radius: 6px;
      transition: 0.3s;
    }

    input[type="text"]:focus {
      border-color: #grey;
      box-shadow: 0 0 0 3px rgba(255, 182, 193, 0.3);
      outline: none;
    }

    input[name="description"] {
      flex: 1.5; 
    }
  
    .action-button {
      border: 1px solid #ff66a3;
      color: #gray;
      background-color: rgba(255, 255, 255, 0.7);
      font-weight: 400;
      transition: all 0.3s ease;
    }

    button:hover {
      background-color: rgba(255, 182, 193, 0.3); /* transparent pink hover */
      color: #d63384;
      transform: scale(1.05);
    }

    li.bg-white {
      background-color: #fff;
      border-left: 4px solid #ff99c8;
      box-shadow: 0 2px 6px rgba(255, 192, 203, 0.3);
      transition: 0.3s;
    }

    li.bg-white:hover {
      background-color: #fff5f8;
      transform: translateY(-2px);
    }

    .text-gray-600 {
      color: #black !important;
      font-size: 0.9rem;
    }

    select {
      border-color: #ffb6c1;
      background-color: rgba(255, 255, 255, 0.8);
      color: #ff66a3;
      border-radius: 6px;
    }

    select:focus {
      outline: none;
      border-color: #ff66a3;
      box-shadow: 0 0 0 2px rgba(255, 182, 193, 0.3);
    }

    label {
      color: #ff66a3;
    }
  </style>
  <div class="mb-4">
    <h1 class="text-2xl font-bold mb-2">My Tasks</h1>

    @if(session('success'))
      <div class="p-2 bg-green-100 border border-green-200 mb-2">
        {{ session('success') }}
      </div>
    @endif

    <!-- Add Task form -->
    <form action="{{ route('todo.store') }}" method="POST" class="flex gap-2 mb-4">
      @csrf
      <input name="task" type="text" placeholder="New task title" class="flex-1 border rounded p-2" required>
      <input name="description" type="text" placeholder="Description (optional)" class="border rounded p-2">
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Add</button>
    </form>

    <!-- Filter -->
    <form method="GET" class="mb-4">
      <label for="status">Filter: </label>
      <select name="status" id="status" onchange="this.form.submit()" class="border p-2 rounded">
        <option value="">All</option>
        <option value="pending" {{ ($filter ?? '') === 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="in_progress" {{ ($filter ?? '') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
        <option value="completed" {{ ($filter ?? '') === 'completed' ? 'selected' : '' }}>Completed</option>
      </select>
    </form>

    <!-- List -->
    <ul class="space-y-2">
      @forelse($tasks as $task)
        <li class="bg-white p-3 rounded shadow-sm flex justify-between items-center">
          <div>
            <div class="{{ $task->status === 'Completed' ? 'line-through text-gray-400' : '' }} font-medium">
              {{ $task->title }}
            </div>
            @if($task->description)
              <div class="text-sm text-gray-600">{{ $task->description }}</div>
            @endif
          </div>

          <div class="flex items-center gap-2">
          <!-- Mark as Completed -->
          @if($task->status !== 'completed')
            <form action="{{ route('todo.updateStatus', $task) }}" method="POST">
              @csrf
              @method('PATCH')
              <input type="hidden" name="status" value="completed">
              <button type="submit" class="px-3 py-1 rounded text-sm bg-green-500 text-white">
                Mark as Completed
              </button>
            </form>
          @endif

          <!-- Move to In Progress -->
          @if($task->status !== 'in_progress')
            <form action="{{ route('todo.updateStatus', $task) }}" method="POST">
              @csrf
              @method('PATCH')
              <input type="hidden" name="status" value="in_progress">
              <button type="submit" class="px-3 py-1 rounded text-sm bg-blue-500 text-white">
                Mark as In Progress
              </button>
            </form>
          @endif

          <!-- Move to Pending -->
          @if($task->status !== 'pending')
            <form action="{{ route('todo.updateStatus', $task) }}" method="POST">
              @csrf
              @method('PATCH')
              <input type="hidden" name="status" value="pending">
              <button type="submit" class="px-3 py-1 rounded text-sm bg-yellow-500 text-white">
                Mark as Pending
              </button>
            </form>
          @endif

          <!-- Delete -->
          <form action="{{ route('todo.destroy', $task) }}" method="POST" onsubmit="return confirm('Delete this task?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-3 py-1 rounded text-sm bg-red-500 text-white">
              Delete
            </button>
          </form>
        </div>

        </li>
      @empty
        <li class="text-gray-600">No tasks yet.</li>
      @endforelse
    </ul>
  </div>
</x-layout>
